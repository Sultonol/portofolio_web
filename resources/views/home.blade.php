<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - {{ $profile->full_name ?? 'Sultonol Auliya' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%); }
        @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }

        /* Animasi fade-in */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        .animate-delay-200 { animation-delay: 0.2s; }
        .animate-delay-400 { animation-delay: 0.4s; }
        .animate-delay-600 { animation-delay: 0.6s; }
        .animate-delay-800 { animation-delay: 0.8s; }

        /* Animasi slide-in dari kiri */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .animate-slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        /* Animasi slide-in dari kanan */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .animate-slide-in-right {
            animation: slideInRight 1s ease-out;
        }

        /* Animasi bounce-in untuk cards */
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-bounce-in {
            animation: bounceIn 1s ease-out;
        }
    </style>
</head>
<body class="bg-white text-slate-800">

    <header class="gradient-bg min-h-screen flex flex-col">
        <nav class="container mx-auto px-6 py-8 flex justify-between items-center bg-white/80 backdrop-blur-md z-30 rounded-b-3xl shadow-sm border-b border-slate-100/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-lg">M</div>
                <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">MyDrive</a>
            </div>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-white border-2 border-blue-600 text-blue-600 font-bold rounded-full hover:bg-blue-50 transition shadow-sm">Dashboard</a>
                <button onclick="showDevelopmentAlert()" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-full hover:shadow-lg hover:shadow-blue-300 transition shadow-md">Contact</button>
            </div>
        </nav>

        <div id="modalDev" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-600 hidden flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center animate-slide-up">
                <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">🛠️</div>
                <h3 class="text-xl font-bold text-slate-800 mb-2 tracking-tighter">Under Development</h3>
                <p class="text-slate-400 text-xs mb-8 leading-relaxed">Sabar ya Sulton, fitur <b>Contact</b> ini masih dalam tahap pengembangan tim kami.</p>
                <button onclick="closeDevModal()" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-xl hover:bg-slate-800 transition">Tunggu Saja</button>
            </div>
        </div>

        <div class="container mx-auto px-6 flex-1 flex flex-col md:flex-row items-center justify-between gap-12 py-12 animate-fade-in-up">
            <div class="w-full md:w-1/2 space-y-6 text-center md:text-left animate-slide-in-left">
                <span class="px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full">Laboratory & Science</span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-slate-900">
                    Science is Nothing <br> <span class="text-blue-600">But Perception</span>
                </h1>
                <p class="text-slate-500 text-lg max-w-lg mx-auto md:mx-0">
                    {{ $profile->description ?? 'Corem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.' }}
                </p>
                <div class="pt-4">
                    <a href="#about" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:scale-105 transition-transform inline-block shadow-lg shadow-blue-200">
                        View Profile
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center animate-slide-in-right">
                <div class="relative w-full max-w-md">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <img src="{{ asset('images/hero.svg') }}" alt="Hero Illustration" class="relative z-10 w-full drop-shadow-2xl">
                </div>
            </div>
        </div>
    </header>

    <section id="about" class="py-24 bg-white animate-fade-in-up">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-16 items-start">

                <div class="w-full md:w-1/3 group animate-slide-in-left">
                    <div class="bg-white rounded-3xl p-8 shadow-[0_20px_50px_rgba(8,112,184,0.07)] border border-slate-100 transition-all group-hover:-translate-y-2">
                        <div class="w-full aspect-square bg-slate-200 rounded-2xl mb-6 overflow-hidden">
                            <img src="{{ asset ('images/image.png') }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $profile->full_name ?? 'Ari Kusumastuti M.Pd M.Si' }}</h3>
                        <p class="text-blue-600 font-medium mb-4">{{ $profile->profile_category ?? 'Dosen & Peneliti' }}</p>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            {{ $profile->description ?? 'Gorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.' }}
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-2/3 space-y-12 animate-slide-in-right">
                    <div class="border-l-4 border-blue-600 pl-6">
                        <h2 class="text-3xl font-bold text-slate-900">Tentang Saya</h2>
                    </div>

                    <div class="grid gap-8">
                        <div class="animate-fade-in-up animate-delay-200">
                            <h4 class="text-xl font-bold text-slate-900 mb-3 flex items-center">
                                <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">01</span>
                                Visi
                            </h4>
                            <p class="text-slate-600 leading-relaxed italic">
                                "{{ $profile->vision ?? 'Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus.' }}"
                            </p>
                        </div>

                        <div class="animate-fade-in-up animate-delay-400">
                            <h4 class="text-xl font-bold text-slate-900 mb-3 flex items-center">
                                <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">02</span>
                                Misi
                            </h4>
                            <p class="text-slate-600 leading-relaxed">
                                {{ $profile->mission ?? 'Curabitur tempor quis eros tempus lacinia. Nam bibendum pellentesque quam a convallis. Sed ut vulputate nisi. Integer in felis sed leo vestibulum venenatis.' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="statistics" class="py-24 bg-gradient-to-br from-slate-50 to-blue-50 animate-fade-in-up">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Statistik Dashboard</h2>
                <p class="text-slate-600 text-lg">Lihat jumlah file, folder, dan lainnya yang telah dibuat di dashboard.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center animate-bounce-in">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">📁</div>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalFolders }}</h3>
                    <p class="text-slate-600">Folder</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center animate-bounce-in animate-delay-200">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">📄</div>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalFiles }}</h3>
                    <p class="text-slate-600">File</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center animate-bounce-in animate-delay-400">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🏷️</div>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalCategories }}</h3>
                    <p class="text-slate-600">Kategori</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center animate-bounce-in animate-delay-600">
                    <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🔗</div>
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalShortcuts }}</h3>
                    <p class="text-slate-600">Shortcut</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-lg border border-slate-100 max-w-4xl mx-auto animate-fade-in-up animate-delay-800">
                <h3 class="text-xl font-bold text-slate-900 mb-4 text-center">Aktivitas Bulanan</h3>
                <canvas id="lineChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </section>

    <section id="achievements" class="py-24 bg-gradient-to-br from-blue-50 to-white animate-fade-in-up">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Pencapaian & Kontribusi</h2>
                <p class="text-slate-600 text-lg">Beberapa pencapaian utama dalam karir saya di bidang pendidikan dan penelitian.</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 text-center animate-bounce-in">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">📚</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Penelitian</h3>
                        <p class="text-slate-600 leading-relaxed">Telah menerbitkan lebih dari 20 artikel di jurnal internasional dan nasional, berkontribusi pada pengembangan ilmu pengetahuan di bidang laboratorium.</p>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 text-center animate-bounce-in animate-delay-200">
                        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">👨‍🏫</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Pengajaran</h3>
                        <p class="text-slate-600 leading-relaxed">Mengajar lebih dari 500 mahasiswa dengan metode inovatif, membantu mereka mencapai prestasi akademik yang tinggi.</p>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 text-center animate-bounce-in animate-delay-400">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🤝</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Kolaborasi</h3>
                        <p class="text-slate-600 leading-relaxed">Berkolaborasi dengan universitas dan industri untuk proyek-proyek penelitian yang berdampak pada masyarakat.</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 text-center animate-fade-in-up animate-delay-600">
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Mari Terhubung</h3>
                    <p class="text-slate-600 text-lg mb-6">Saya selalu terbuka untuk diskusi, kolaborasi, atau pertanyaan. Jangan ragu untuk menghubungi saya!</p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:scale-105 transition-transform shadow-lg shadow-blue-200">Lihat Dashboard</a>
                        {{-- <button onclick="showDevelopmentAlert()" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:scale-105 transition-transform shadow-lg">Hubungi Saya</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 py-12 text-center animate-fade-in-up">
        <p class="text-slate-500 text-sm">Copyright © 2026. All Rights Reserved.</p>
    </footer>

    <script>
        function showDevelopmentAlert() { document.getElementById('modalDev').classList.remove('hidden'); }
        function closeDevModal() { document.getElementById('modalDev').classList.add('hidden'); }

        // Data untuk line chart
        const months = ['Apr 2026', 'May 2026', 'Jun 2026', 'Jul 2026', 'Aug 2026', 'Sep 2026'];
        const fileData = [{{ $monthlyFiles->where('month', '04')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFiles->where('month', '05')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFiles->where('month', '06')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFiles->where('month', '07')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFiles->where('month', '08')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFiles->where('month', '09')->where('year', '2026')->first()->count ?? 0 }}];
        const folderData = [{{ $monthlyFolders->where('month', '04')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFolders->where('month', '05')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFolders->where('month', '06')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFolders->where('month', '07')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFolders->where('month', '08')->where('year', '2026')->first()->count ?? 0 }}, {{ $monthlyFolders->where('month', '09')->where('year', '2026')->first()->count ?? 0 }}];
        const viewData = [150, 200, 180, 220, 250, 300]; // Dummy data untuk web views

        // Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Upload File',
                    data: fileData,
                    borderColor: 'rgba(34, 197, 94, 1)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Buat Folder',
                    data: folderData,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Buka Web',
                    data: viewData,
                    borderColor: 'rgba(249, 115, 22, 1)',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>

</body>
</html>
