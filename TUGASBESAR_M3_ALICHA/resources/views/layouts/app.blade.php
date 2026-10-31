<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Manager</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
    <div class="flex min-h-screen">
        
        <!-- sidebar -->
        <aside class="w-60 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0">
            <div>
                <!-- Judul -->
                <div class="h-14 px-5 border-b border-slate-100 flex items-center gap-2">
                    <span class="font-semibold text-slate-900 text-sm">Sistem Venue Lapangan</span>
                </div>

                <!-- Navigasi -->
                <nav class="p-3 space-y-1">
                    <a href="{{ route('venues.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('venues.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span>Lapangan</span>
                    </a>

                    <a href="{{ route('rentals.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('rentals.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span>Rental Alat</span>
                    </a>

                    <a href="{{ route('members.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('members.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span>Member</span>
                    </a>

                    <a href="{{ route('coaches.index') }}"
                       class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('coaches.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span>Instruktur</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <!-- Message Feedback -->
            @if(session('success'))
                <div class="mx-6 mt-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Dynamic Blade View -->
            <main class="flex-1 p-6 max-w-8xl w-full">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>