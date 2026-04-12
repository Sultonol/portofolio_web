<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - {{ $profile->full_name ?? 'Sultonol Auliya' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="bg-white text-slate-800">

    <header class="gradient-bg min-h-screen flex flex-col">
        <nav class="container mx-auto px-6 py-8 flex justify-between items-center">
            <div class="text-2xl font-bold tracking-tighter text-blue-600">LOGO.</div>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-white border border-blue-600 text-blue-600 font-semibold rounded-full hover:bg-blue-50 transition-all shadow-sm">Dashboard</a>
                <button onclick="showDevelopmentAlert()" class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition shadow-md shadow-blue-200">Contact</button>
            </div>
        </nav>

        <div id="modalDev" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[600] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-[2.5rem] p-10 shadow-2xl text-center animate-slide-up">
            <div class="w-20 h-20 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">🛠️</div>
            <h3 class="text-xl font-bold text-slate-800 mb-2 tracking-tighter">Under Development</h3>
            <p class="text-slate-400 text-xs mb-8 leading-relaxed">Sabar ya Sulton, fitur <b>Contact</b> ini masih dalam tahap pengembangan tim kami.</p>
            <button onclick="closeDevModal()" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-xl hover:bg-slate-800 transition">Tunggu Saja</button>
        </div>
    </div>

        <div class="container mx-auto px-6 flex-1 flex flex-col md:flex-row items-center justify-between gap-12 py-12">
            <div class="w-full md:w-1/2 space-y-6 text-center md:text-left">
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

            <div class="w-full md:w-1/2 flex justify-center">
                <div class="relative w-full max-w-md">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 right-4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <img src="{{ asset('images/hero.svg') }}" alt="Hero Illustration" class="relative z-10 w-full drop-shadow-2xl">
                </div>
            </div>
        </div>
    </header>

    <section id="about" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-16 items-start">

                <div class="w-full md:w-1/3 group">
                    <div class="bg-white rounded-3xl p-8 shadow-[0_20px_50px_rgba(8,_112,_184,_0.07)] border border-slate-100 transition-all group-hover:-translate-y-2">
                        <div class="w-full aspect-square bg-slate-200 rounded-2xl mb-6 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Ari+Kusumastuti&size=512&background=random" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $profile->full_name ?? 'Ari Kusumastuti M.Pd M.Si' }}</h3>
                        <p class="text-blue-600 font-medium mb-4">{{ $profile->profile_category ?? 'Dosen & Peneliti' }}</p>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            {{ $profile->description ?? 'Gorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.' }}
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-2/3 space-y-12">
                    <div class="border-l-4 border-blue-600 pl-6">
                        <h2 class="text-3xl font-bold text-slate-900">Tentang Saya</h2>
                    </div>

                    <div class="grid gap-8">
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-3 flex items-center">
                                <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">01</span>
                                Visi
                            </h4>
                            <p class="text-slate-600 leading-relaxed italic">
                                "{{ $profile->vision ?? 'Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus.' }}"
                            </p>
                        </div>

                        <div>
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

    <footer class="bg-slate-900 py-12 text-center">
        <p class="text-slate-500 text-sm">Copyright © 2026. All Rights Reserved.</p>
    </footer>

    <script>
        function showDevelopmentAlert() { document.getElementById('modalDev').classList.remove('hidden'); }
        function closeDevModal() { document.getElementById('modalDev').classList.add('hidden'); }
    </script>

</body>
</html>
