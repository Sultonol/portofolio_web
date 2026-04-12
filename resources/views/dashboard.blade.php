<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MyDrive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
        @keyframes slideInUp {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up { animation: slideInUp 0.4s ease-out; }
    </style>
</head>
<body class="bg-white text-slate-700 h-screen overflow-hidden flex flex-col text-sm text-left">

    <nav class="container mx-auto px-6 py-8 flex justify-between items-center bg-white z-30">
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-blue-600">LOGO.</a>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-white border border-blue-600 text-blue-600 font-semibold rounded-full hover:bg-blue-50 transition shadow-sm">Dashboard</a>
            <button onclick="showDevelopmentAlert()" class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-md shadow-blue-200">Contact</button>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden border-t border-slate-100">
        <aside class="w-72 bg-white border-r border-slate-100 flex flex-col p-6 shadow-sm">
            <nav class="flex-1 space-y-8 overflow-y-auto pr-2 custom-scrollbar text-left">
                @foreach($categories as $mainCat)
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">{{ $mainCat->name }}</p>
                        <div class="space-y-1">
                            @foreach($mainCat->children as $subCat)
                            <a href="{{ route('dashboard', ['category_id' => $subCat->id]) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request('category_id') == $subCat->id ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-blue-50 text-slate-600' }}">
                                <span class="text-lg">{{ strtoupper($mainCat->name) == 'PROFILE' ? '👤' : '📂' }}</span>
                                <span class="font-semibold text-sm">{{ $subCat->name }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
            <div class="mt-auto pt-6 border-t border-slate-50 text-center">
                <p class="text-[10px] text-slate-400 font-medium italic">© 2026 Sultonol Auliya.<br>All Rights Reserved.</p>
            </div>

            @if(!$isProfileView)
            <div class="relative group mt-6">
                <button class="w-full bg-blue-600 text-white py-4 rounded-[1.5rem] font-bold shadow-xl hover:bg-blue-700 transition flex items-center justify-center gap-3 active:scale-95">
                    <span class="text-xl">+</span> New Item
                </button>
                <div class="absolute bottom-full left-0 w-full bg-white border border-slate-100 rounded-[1.5rem] shadow-2xl mb-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all p-2 z-[100] transform origin-bottom scale-95 group-hover:scale-100">
                    <button onclick="checkCategoryBeforeFolder()" class="w-full text-left px-4 py-3.5 hover:bg-blue-50 rounded-xl flex items-center gap-3 transition">
                        <span>📂</span> <span class="text-sm font-bold text-slate-600">New Folder</span>
                    </button>
                    @if($currentFolderId)
                    <button onclick="document.getElementById('fileInput').click()" class="w-full text-left px-4 py-3.5 hover:bg-blue-50 rounded-xl flex items-center gap-3 transition">
                        <span>📤</span> <span class="text-sm font-bold text-slate-600">Upload File</span>
                    </button>
                    @endif
                </div>
            </div>
            @endif
        </aside>

        <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#F8FAFC]">
            <div class="flex-1 overflow-y-auto px-12 py-10 custom-scrollbar">

                @if($isProfileView)
                    <div class="max-w-6xl mx-auto space-y-16 animate-in fade-in duration-700 text-left">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

                            <div class="lg:col-span-4">
                                <div class="bg-white p-10 rounded-[3.5rem] shadow-2xl shadow-slate-200/60 border border-slate-50 flex flex-col min-h-[620px] transition-all hover:-translate-y-1">
                                    <div class="space-y-8 text-left flex-1">
                                        <div class="aspect-square w-full rounded-[2.5rem] overflow-hidden shadow-lg border-4 border-slate-50 bg-blue-50">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($profileData->full_name ?? 'User') }}&background=0D8ABC&color=fff&size=512&bold=true"
                                                 class="w-full h-full object-cover">
                                        </div>

                                        <div class="space-y-2">
                                            <h3 class="text-3xl font-black text-slate-800 tracking-tighter leading-tight">
                                                {{ $profileData->full_name ?? 'Nama Belum Diatur' }}
                                            </h3>
                                            <p class="text-blue-600 font-bold text-sm tracking-wide uppercase italic">
                                                {{ $activeCategory->name ?? 'Kategori' }}
                                            </p>
                                        </div>

                                        <div class="flex gap-2">
                                            <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-full uppercase">Active</span>
                                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-full uppercase tracking-tighter italic">Verified</span>
                                        </div>

                                        <div class="h-px bg-slate-100 w-full my-4"></div>

                                        <div class="space-y-2">
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-1">About Me</p>
                                            <p class="text-sm text-slate-500 leading-relaxed font-medium italic">
                                                "{{ $profileData->description ?? 'Deskripsi profil belum ditambahkan.' }}"
                                            </p>
                                        </div>
                                    </div>

                                    <div class="pt-8 border-t border-slate-50 mt-6 flex justify-between items-center text-[10px] font-black text-slate-300 uppercase tracking-widest">
                                        <span>{{ $profileData->birth_place_date ?? 'Malang, 2026' }}</span>
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-8 space-y-12">
                                <div class="space-y-10 pl-2">
                                    <div class="flex items-center gap-4 text-left">
                                        <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                                        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Tentang Saya</h2>
                                    </div>
                                    <div class="space-y-10 text-left pl-2">
                                        <div class="space-y-4">
                                            <div class="flex items-center gap-4">
                                                <span class="bg-blue-100 text-blue-600 text-xs font-black px-3 py-1.5 rounded-lg tracking-tighter">01</span>
                                                <h4 class="text-lg font-bold text-slate-800 uppercase">Visi</h4>
                                            </div>
                                            <p class="text-slate-500 italic font-medium leading-relaxed pl-12 border-l-2 border-slate-100 ml-5">"{{ $profileData->vision }}"</p>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="flex items-center gap-4">
                                                <span class="bg-blue-100 text-blue-600 text-xs font-black px-3 py-1.5 rounded-lg tracking-tighter">02</span>
                                                <h4 class="text-lg font-bold text-slate-800 uppercase">Misi</h4>
                                            </div>
                                            <p class="text-slate-600 font-medium leading-loose pl-12 border-l-2 border-slate-100 ml-5">{{ $profileData->mission }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-10 space-y-6 text-left pl-2">
                                    <div class="flex justify-between items-center px-4">
                                        <h4 class="text-xl font-extrabold text-slate-800 tracking-tight">Link Shortcut</h4>
                                        <button onclick="openShortcutModal()" class="w-10 h-10 bg-slate-900 text-white rounded-2xl flex items-center justify-center hover:bg-blue-600 transition shadow-xl text-2xl font-bold">+</button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                                        @foreach($shortcuts as $sc)
                                        <div class="group flex items-center justify-between bg-white p-6 rounded-[2rem] border border-slate-50 shadow-sm hover:shadow-xl transition-all duration-300">
                                            <div class="flex items-center gap-4 overflow-hidden">
                                                <div class="w-12 h-12 flex-shrink-0 bg-emerald-600 rounded-2xl flex items-center justify-center text-white font-black shadow-lg">M</div>
                                                <div class="truncate">
                                                    <p class="font-bold text-slate-800 text-sm truncate">{{ $sc->name }}</p>
                                                    <a href="{{ $sc->url }}" target="_blank" class="text-[10px] text-blue-500 font-bold hover:underline truncate block italic tracking-tighter">{{ $sc->url }}</a>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition">
                                                <button onclick="event.stopPropagation(); openEditShortcutModal('{{ $sc->id }}', '{{ $sc->name }}', '{{ $sc->url }}')" class="p-2 text-blue-400 hover:text-blue-600 transition">✏️</button>
                                                <form action="{{ route('shortcut.delete', $sc->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <header class="flex items-center justify-between gap-6 mb-10">
                        <div class="flex-1 relative">
                            @if($currentFolderId && isset($activeFolder))
                                @php
                                    $backUrl = $activeFolder->parent_id
                                        ? route('dashboard', ['category_id' => $activeFolder->category_id, 'folder_id' => $activeFolder->parent_id])
                                        : route('dashboard', ['category_id' => $activeFolder->category_id]);
                                @endphp
                                <a href="{{ $backUrl }}" class="flex items-center gap-2 text-blue-600 font-bold hover:underline transition-all"><span>←</span> Kembali ke Sebelumnya</a>
                            @else
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
                                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-4">
                                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search items..." class="w-full bg-white border border-slate-100 py-4 pl-14 pr-6 rounded-[1.5rem] focus:outline-none shadow-sm text-sm">
                                    <div class="relative group">
                                        <select name="sort" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-100 py-4 pl-6 pr-12 rounded-[1.5rem] focus:outline-none shadow-sm text-sm font-bold text-slate-600 cursor-pointer hover:bg-slate-50 transition">
                                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                        </select>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </header>

                    <h2 class="text-xl font-bold text-slate-800 mb-8 italic text-left px-2">Items</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 text-center mb-20">
                        @forelse($folders as $folder)
                        <div class="group relative" ondblclick="window.location.href='?category_id={{ $folder->category_id }}&folder_id={{ $folder->id }}'">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition z-20 flex gap-1">
                                <button onclick="event.stopPropagation(); openEditModal('folder', '{{ $folder->id }}', '{{ $folder->name }}')" class="p-2 bg-white shadow-xl rounded-full text-[10px] border border-slate-100 hover:bg-blue-50 transition">✏️</button>
                                <button onclick="event.stopPropagation(); openDeleteModal('folder', '{{ $folder->id }}')" class="p-2 bg-white shadow-xl rounded-full text-[10px] border border-slate-100 hover:bg-red-50 text-red-500 transition">🗑️</button>
                            </div>
                            <div class="aspect-square bg-white border border-slate-50 rounded-[3rem] flex items-center justify-center shadow-sm group-hover:shadow-2xl transition-all cursor-pointer">
                                <span class="text-6xl group-hover:scale-110 transition duration-300">📂</span>
                            </div>
                            <p class="mt-4 font-bold text-slate-800 text-sm truncate px-2">{{ $folder->name }}</p>
                        </div>
                        @empty
                            @if(!request('category_id'))
                            <div class="col-span-full py-20 flex flex-col items-center opacity-40 text-center">
                                <div class="text-8xl mb-6">🖱️</div>
                                <h3 class="text-xl font-bold tracking-tighter">Silahkan pilih kategori di sidebar</h3>
                            </div>
                            @endif
                        @endforelse

                        @foreach($filesInFolder as $file)
                        <div class="group relative" ondblclick="window.open('{{ asset('storage/' . $file->file_path) }}', '_blank')">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition z-20 flex gap-1">
                                <a href="{{ asset('storage/' . $file->file_path) }}" download onclick="event.stopPropagation()" class="p-2 bg-white shadow-xl rounded-full text-[10px] border border-slate-100 hover:bg-green-50 transition">📥</a>
                                <button onclick="event.stopPropagation(); openEditModal('file', '{{ $file->id }}', '{{ $file->name }}')" class="p-2 bg-white shadow-xl rounded-full text-[10px] border border-slate-100 hover:bg-blue-50 transition">✏️</button>
                                <button onclick="event.stopPropagation(); openDeleteModal('file', '{{ $file->id }}')" class="p-2 bg-white shadow-xl rounded-full text-[10px] border border-slate-100 hover:bg-red-50 text-red-500 transition">🗑️</button>
                            </div>
                            <div class="aspect-square bg-white border border-slate-50 rounded-[3rem] flex items-center justify-center shadow-sm group-hover:shadow-2xl transition-all cursor-pointer p-10">
                                <img src="{{ $file->getIcon() }}" class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                            </div>
                            <p class="mt-4 font-bold text-slate-800 text-sm truncate px-2">{{ $file->name }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-20">
                        <h2 class="text-xl font-bold text-slate-800 mb-8 italic text-left px-2">Recent Activity</h2>
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden text-sm w-full">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                                    <tr><th class="px-10 py-6">File Name</th><th class="px-10 py-6 text-right">Last Modified</th></tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($recentFiles as $file)
                                    <tr class="hover:bg-blue-50/30 transition cursor-pointer" ondblclick="window.open('{{ asset('storage/' . $file->file_path) }}', '_blank')">
                                        <td class="px-10 py-6 flex items-center gap-4 text-left">
                                            <img src="{{ $file->getIcon() }}" class="w-6 h-6 object-contain">
                                            <b class="text-slate-700">{{ $file->name }}</b>
                                        </td>
                                        <td class="px-10 py-6 text-right text-slate-400 font-medium">{{ $file->updated_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <div id="modalDev" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[600] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center animate-slide-up">
            <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">🛠️</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2 tracking-tighter">Under Development</h3>
            <p class="text-slate-400 text-xs mb-8 leading-relaxed">Sabar ya Sulton, fitur <b>Contact</b> ini masih dalam tahap pengembangan tim kami.</p>
            <button onclick="closeDevModal()" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-xl hover:bg-slate-800 transition">Tunggu Saja</button>
        </div>
    </div>

    <div id="modalAlert" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[300] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center animate-in zoom-in duration-300">
            <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">📂</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2 tracking-tighter">Pilih Kategori Dulu</h3>
            <p class="text-slate-400 text-xs mb-8 leading-relaxed">Sulton, silakan pilih kategori di sidebar terlebih dahulu agar folder bisa disimpan dengan benar.</p>
            <button onclick="closeAlert()" class="w-full py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-xl hover:bg-blue-700 transition">Saya Mengerti</button>
        </div>
    </div>

    <div id="modalEditShortcut" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[300] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl animate-in zoom-in duration-200 text-left">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 tracking-tighter">Edit Shortcut</h3>
            <form id="formEditShortcut" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <label class="text-[10px] font-bold text-slate-400 uppercase px-2">App Name</label>
                    <input type="text" name="name" id="editShortcutName" required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none">
                    <label class="text-[10px] font-bold text-slate-400 uppercase px-2">URL</label>
                    <input type="url" name="url" id="editShortcutUrl" required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none">
                </div>
                <div class="flex gap-4 mt-8">
                    <button type="button" onclick="closeEditShortcutModal()" class="flex-1 py-4 font-bold text-slate-400 hover:bg-slate-50 rounded-2xl transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-xl hover:bg-blue-700 transition">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalFolder" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[200] hidden flex items-center justify-center p-4 text-left">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl animate-in zoom-in duration-200">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 tracking-tighter">New Folder</h3>
            <form action="{{ route('folder.store') }}" method="POST">
                @csrf
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="parent_id" value="{{ $currentFolderId }}">
                <input type="text" name="name" placeholder="Folder Name..." required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none mb-8">
                <div class="flex gap-4">
                    <button type="button" onclick="closeModalFolder()" class="flex-1 py-4 font-bold text-slate-400 hover:bg-slate-50 rounded-2xl transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-xl">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalShortcut" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[200] hidden flex items-center justify-center p-4 text-left">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl animate-in zoom-in duration-200">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 tracking-tighter">Add Shortcut</h3>
            <form action="{{ route('shortcut.store') }}" method="POST">
                @csrf
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <div class="space-y-4">
                    <input type="text" name="name" placeholder="App Name" required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none">
                    <input type="url" name="url" placeholder="https://..." required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none">
                </div>
                <div class="flex gap-4 mt-8">
                    <button type="button" onclick="closeShortcutModal()" class="flex-1 py-4 font-bold text-slate-400 hover:bg-slate-50 rounded-2xl transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-xl">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[500] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl animate-in zoom-in duration-200">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 tracking-tighter text-left">Rename Item</h3>
            <form id="formRename" method="POST">
                @csrf @method('PUT')
                <input type="text" name="name" id="editName" required class="w-full bg-slate-50 border p-5 rounded-2xl font-semibold focus:outline-none mb-8">
                <div class="flex gap-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-4 font-bold text-slate-400 hover:bg-slate-50 rounded-2xl transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-xl transition">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDelete" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[500] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center">
            <div class="text-4xl mb-4">⚠️</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Hapus Item?</h3>
            <p class="text-slate-400 text-xs mb-8 italic text-center">Data yang dihapus tidak dapat dikembalikan.</p>
            <form id="formDelete" method="POST">
                @csrf @method('DELETE')
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-red-500 text-white font-bold rounded-2xl shadow-lg hover:bg-red-600 transition">Ya, Hapus Sekarang</button>
                    <button type="button" onclick="closeDeleteModal()" class="w-full py-4 font-bold text-slate-400 hover:bg-slate-50 rounded-2xl transition">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <form id="uploadFileForm" action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="hidden">
        @csrf
        <input type="hidden" name="folder_id" value="{{ $currentFolderId }}">
        <input type="file" name="file" id="fileInput" onchange="document.getElementById('uploadFileForm').submit()">
    </form>

    <script>
        function showDevelopmentAlert() { document.getElementById('modalDev').classList.remove('hidden'); }
        function closeDevModal() { document.getElementById('modalDev').classList.add('hidden'); }
        function checkCategoryBeforeFolder() {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.get('category_id')) document.getElementById('modalAlert').classList.remove('hidden');
            else document.getElementById('modalFolder').classList.remove('hidden');
        }
        function closeAlert() { document.getElementById('modalAlert').classList.add('hidden'); }
        function closeModalFolder() { document.getElementById('modalFolder').classList.add('hidden'); }
        function openShortcutModal() { document.getElementById('modalShortcut').classList.remove('hidden'); }
        function closeShortcutModal() { document.getElementById('modalShortcut').classList.add('hidden'); }

        // FUNGSI EDIT SHORTCUT DENGAN DEBUGGING
        function openEditShortcutModal(id, name, url) {
            console.log("Membuka Edit untuk ID:", id);
            const form = document.getElementById('formEditShortcut');
            const inputName = document.getElementById('editShortcutName');
            const inputUrl = document.getElementById('editShortcutUrl');
            const modal = document.getElementById('modalEditShortcut');

            if(form && inputName && inputUrl && modal) {
                form.action = '/shortcut/update/' + id;
                inputName.value = name;
                inputUrl.value = url;
                modal.classList.remove('hidden');
            } else {
                console.error("Elemen modal edit tidak ditemukan!");
            }
        }
        function closeEditShortcutModal() { document.getElementById('modalEditShortcut').classList.add('hidden'); }

        // FUNGSI EDIT/RENAME FOLDER DAN FILE
        function openEditModal(type, id, currentName) {
            const modal = document.getElementById('modalEdit');
            const form = document.getElementById('formRename');
            const input = document.getElementById('editName');

            if(modal && form && input) {
                // Atur action form sesuai tipe (folder/file)
                form.action = (type === 'folder') ? '/folder/rename/' + id : '/file/rename/' + id;
                input.value = currentName;
                modal.classList.remove('hidden');
            }
        }
        function closeEditModal() { document.getElementById('modalEdit').classList.add('hidden'); }

        // FUNGSI DELETE FOLDER DAN FILE
        function openDeleteModal(type, id) {
            const modal = document.getElementById('modalDelete');
            const form = document.getElementById('formDelete');

            if(modal && form) {
                // Atur action form sesuai tipe (folder/file)
                form.action = (type === 'folder') ? '/folder/delete/' + id : '/file/delete/' + id;
                modal.classList.remove('hidden');
            }
        }
        function closeDeleteModal() { document.getElementById('modalDelete').classList.add('hidden'); }
    </script>
</body>
</html>
