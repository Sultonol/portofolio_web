<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Folder, File, Profile, Shortcut};
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function home(){
        $profile = Profile::first();
        return view('home', compact('profile'));
    }
    public function index(Request $request)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $isFiltering = $request->filled('category_id');
        $currentFolderId = $request->get('folder_id');
        $sort = $request->get('sort', 'name_asc');

        $activeCategory = $isFiltering ? Category::find($request->category_id) : null;
        $isProfileView = $activeCategory && strtoupper($activeCategory->parent->name ?? '') == 'PROFILE';

        $activeFolder = null;
        $query = Folder::query();

        if ($currentFolderId) {
            $activeFolder = Folder::find($currentFolderId);
            $query->where('parent_id', $currentFolderId);
        } elseif ($isFiltering) {
            $query->where('category_id', $request->category_id)->whereNull('parent_id');
        }

        // Logika Sorting
        if ($sort == 'name_asc') $query->orderBy('name', 'asc');
        elseif ($sort == 'name_desc') $query->orderBy('name', 'desc');
        elseif ($sort == 'latest') $query->orderBy('created_at', 'desc');
        elseif ($sort == 'oldest') $query->orderBy('created_at', 'asc');

        $folders = $query->get();

        // Sorting untuk Files
        $fileQuery = File::where('folder_id', $currentFolderId);
        if ($sort == 'name_asc') $fileQuery->orderBy('name', 'asc');
        elseif ($sort == 'name_desc') $fileQuery->orderBy('name', 'desc');
        elseif ($sort == 'latest') $fileQuery->orderBy('created_at', 'desc');

        $filesInFolder = $currentFolderId ? $fileQuery->get() : collect();
        $recentFiles = File::orderBy('updated_at', 'desc')->take(5)->get();

        $profileData = Profile::first();
        $shortcuts = $isProfileView ? Shortcut::where('category_id', $request->category_id)->get() : collect();

        return view('dashboard', compact(
            'categories', 'folders', 'recentFiles', 'isFiltering',
            'currentFolderId', 'filesInFolder', 'isProfileView', 'profileData', 'shortcuts', 'activeCategory', 'activeFolder'
        ));
    }

    // --- CRUD Folder ---
    public function storeFolder(Request $request) {
        $request->validate(['name' => 'required', 'category_id' => 'required']);
        Folder::create($request->all());
        return redirect()->back();
    }
    public function renameFolder(Request $request, $id) {
        Folder::findOrFail($id)->update(['name' => $request->name]);
        return redirect()->back();
    }
    public function deleteFolder($id) {
        Folder::findOrFail($id)->delete();
        return redirect()->back();
    }

    // --- CRUD File ---
    public function storeFile(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public');
            File::create([
                'name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'folder_id' => $request->folder_id,
            ]);
        }
        return redirect()->back();
    }
    public function renameFile(Request $request, $id) {
        File::findOrFail($id)->update(['name' => $request->name]);
        return redirect()->back();
    }
    public function deleteFile($id) {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return redirect()->back();
    }

    // --- CRUD Shortcut ---
    public function storeShortcut(Request $request) {
        Shortcut::create($request->only(['name', 'url', 'category_id']));
        return redirect()->back();
    }
    public function deleteShortcut($id) {
        Shortcut::findOrFail($id)->delete();
        return redirect()->back();
    }
    public function updateShortcut(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'url' => 'required|url'
        ]);

        $shortcut = Shortcut::findOrfail($id);
        $shortcut->update($request->only(['name', 'url']));
        return redirect()->back();
    }
}
