<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Construction - PT. Berkah Cipta Persada</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/seclone/bcp-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/seclone/bcp-logo.png') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            green: '#3dcd58',
                            dark: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-700 min-h-screen flex flex-col items-center justify-between p-6 md:p-12 relative overflow-hidden font-sans">
    <!-- Background glow elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-brand-green/5 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-blue-500/5 blur-[120px] pointer-events-none"></div>

    <!-- Header Logo -->
    <header class="w-full max-w-6xl flex justify-center md:justify-start z-10">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/seclone/bcp-logo.png') }}" alt="PT. Berkah Cipta Persada Logo" class="h-12 w-auto object-contain">
            <span class="text-xl font-bold text-gray-900 tracking-wider">PT. BERKAH CIPTA PERSADA</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-2xl text-center flex flex-col items-center my-auto z-10 px-4">
        <!-- Animated / Glowing Icon -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-brand-green/10 rounded-full blur-md animate-pulse"></div>
            <div class="relative bg-white border border-gray-200 shadow-md rounded-full p-6 text-brand-green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 animate-spin" style="animation-duration: 8s;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.936 6.936 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>
        </div>

        <!-- Announcement Texts -->
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight leading-tight">
            WEBSITE UNDER CONSTRUCTION
        </h1>
        <div class="h-1 w-20 bg-brand-green mb-6 rounded-full"></div>
        <p class="text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
            Kami sedang melakukan peningkatan sistem dan pemeliharaan rutin untuk meningkatkan performa dan layanan website kami. Kami akan segera kembali online untuk menyajikan solusi sistem kelistrikan industri terbaik untuk Anda.
        </p>

        <!-- Status badge -->
        <div class="inline-flex items-center gap-2 bg-brand-green/10 border border-brand-green/20 rounded-full px-4 py-1.5 text-xs md:text-sm font-semibold text-brand-green mb-10">
            <span class="w-2.5 h-2.5 bg-brand-green rounded-full animate-ping"></span>
            Status: Sistem sedang diperbarui
        </div>
    </main>

    <!-- Footer Information -->
    <footer class="w-full max-w-6xl flex flex-col md:flex-row items-center justify-between gap-6 border-t border-gray-200 pt-8 z-10 text-xs md:text-sm text-gray-500">
        <div>
            &copy; {{ date('Y') }} PT. Berkah Cipta Persada. All rights reserved.
        </div>
        <div class="flex flex-wrap justify-center gap-6">
            <span class="flex items-center gap-1 text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-brand-green">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                info@berkahcipta.co.id
            </span>
            <span class="flex items-center gap-1 text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-brand-green">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.387a12.017 12.017 0 0 1-4.81-4.81c-.155-.441.011-.928.387-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                +62 21-5088-0130
            </span>
        </div>
    </footer>
</body>
</html>
