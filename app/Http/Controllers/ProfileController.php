<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profile
     */
    public function edit()
    {
        $profile = Profile::first();

        // Jika belum ada profile, buat baru dengan data default
        if (!$profile) {
            $profile = Profile::create([
                'full_name' => 'Nama Belum Diatur',
                'description' => 'Deskripsi belum diisi.',
                'vision' => 'Visi belum diatur',
                'mission' => 'Misi belum diatur',
                'profile_category' => 'Profesional',
                'birth_place_date' => '-'
            ]);
        }

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update data profile (visi, misi, description, dll)
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'profile_category' => 'nullable|string|max:255',
            'birth_place_date' => 'nullable|string|max:255'
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile();
        }

        $profile->update($request->only([
            'full_name',
            'description',
            'vision',
            'mission',
            'profile_category',
            'birth_place_date'
        ]));

        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Update foto profil
     */
    public function updatePhoto(Request $request)
    {
        // 1. Validasi tetap perlu supaya server nggak keberatan
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,heic',
        ]);

        // 2. Ambil data pertama
        $profile = Profile::first();

        // Jika belum ada profile, buat baru
        if (!$profile) {
            $profile = Profile::create([
                'full_name' => 'Nama Belum Diatur',
                'description' => 'Deskripsi belum diisi.',
                'vision' => 'Visi belum diatur',
                'mission' => 'Misi belum diatur',
                'profile_category' => 'Profesional',
                'birth_place_date' => '-'
            ]);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // 4. Pastikan Folder Fisik ada
            $path = storage_path('app/public/photos');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // 5. Hapus foto lama jika ada filenya di storage
            if ($profile->photo && Storage::disk('public')->exists('photos/' . $profile->photo)) {
                Storage::disk('public')->delete('photos/' . $profile->photo);
            }

            // 6. Simpan file baru ke storage/app/public/photos
            $file->storeAs('photos', $fileName, 'public');

            // 7. Update kolom photo dan simpan ke SQLite
            $profile->photo = $fileName;
            $profile->save();

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal mengupload foto.');
    }

    /**
     * Get profile data (API endpoint)
     */
    public function show()
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }
}
