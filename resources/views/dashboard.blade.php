<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCP Admin Dashboard</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="body"
class="font-[Poppins] bg-[#F4F7FA] transition duration-300">

<!-- LOADER -->
<div id="loader"
     class="fixed inset-0 bg-white z-[9999] flex items-center justify-center">

    <div class="w-20 h-20 border-[6px] border-[#00C853] border-t-transparent rounded-full animate-spin"></div>

</div>

<!-- TOAST -->
@if(session('success'))

<script>

Swal.fire({

    icon: 'success',
    title: 'Succès',
    text: '{{ session('success') }}',
    confirmButtonColor: '#00C853'

})

</script>

@endif

@if(session('delete'))

<script>

Swal.fire({

    icon: 'error',
    title: 'Supprimé',
    text: '{{ session('delete') }}',
    confirmButtonColor: '#FF5252'

})

</script>

@endif

@if(session('update'))

<script>

Swal.fire({

    icon: 'info',
    title: 'Modification',
    text: '{{ session('update') }}',
    confirmButtonColor: '#2196F3'

})

</script>

@endif

<div class="flex h-screen overflow-hidden relative">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed lg:relative z-50 lg:z-auto
        w-[280px] h-screen
        bg-[#071120] text-white flex flex-col
        transform -translate-x-full lg:translate-x-0
        transition-all duration-500 ease-in-out">

        <!-- LOGO -->
        <div class="h-24 flex items-center px-8 border-b border-white/10">

            <div class="w-14 h-14 rounded-2xl bg-[#00C853] flex items-center justify-center text-2xl font-bold">
                O
            </div>

            <div class="ml-4">

                <h1 class="text-2xl font-bold">
                    OCP Admin
                </h1>

                <p class="text-sm text-gray-400">
                    Maintenance System
                </p>

            </div>

        </div>

        <!-- MENU -->
        <div class="flex-1 py-10 px-6 space-y-4">

            <a href="/dashboard"
               class="flex items-center gap-4 bg-[#00C853] h-14 px-5 rounded-2xl text-lg font-semibold">

                📊 Dashboard

            </a>

            <a href="/maintenances"
               class="flex items-center gap-4 hover:bg-white/5 h-14 px-5 rounded-2xl transition">

                🛠️ Maintenances

            </a>

        </div>

        <!-- FOOTER -->
        <div class="p-6 border-t border-white/10">

                <form action="/signout" method="POST">
                @csrf

                <button
                    type="submit"
                    class="hover:scale-105 active:scale-95 duration-200 w-full h-14 rounded-2xl bg-red-500 hover:bg-red-600 transition font-semibold">

                    Déconnexion

                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="h-24 bg-white px-6 lg:px-10 flex items-center justify-between border-b border-gray-200">

            <div class="flex items-center">

                <!-- MOBILE BUTTON -->
                <button
                    onclick="toggleSidebar()"
                    class="hover:scale-105 active:scale-95 duration-200 lg:hidden mr-5 bg-[#071120] text-white w-12 h-12 rounded-xl">

                    ☰

                </button>

                <div>

                    <h1 class="text-3xl font-bold text-[#071120]">
                        Dashboard
                    </h1>

                    <p class="text-gray-500 mt-1">
                        {{ auth()->check() ? auth()->user()->role : 'Admin' }}
                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- DARK MODE -->
                <button
                    onclick="toggleDarkMode()"
                    class="hover:scale-105 active:scale-95 duration-200 bg-[#071120] text-white px-5 h-12 rounded-2xl font-semibold">

                    🌙 Mode

                </button>

                <!-- NOTIFICATION -->
                <div class="relative">

                    <button class="w-14 h-14 rounded-2xl bg-[#F4F7FA] flex items-center justify-center text-2xl">

                        🔔

                    </button>

                    <div class="absolute top-2 right-2 w-3 h-3 bg-red-500 rounded-full animate-ping"></div>

                </div>

                <!-- SEARCH -->
                <div class="w-[320px] h-14 bg-[#F4F7FA] rounded-2xl px-5 flex items-center">

                    <input
                        id="searchInput"
                        type="text"
                        placeholder="Rechercher..."
                        class="bg-transparent outline-none w-full"
                    >

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-5 lg:p-10">

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-10">

                <div class="bg-white rounded-3xl p-7 shadow-sm hover:scale-105 hover:shadow-2xl transition duration-300">

                    <p class="text-gray-500 mb-3">
                        Total Maintenances
                    </p>

                    <h1 class="text-5xl font-bold text-[#071120]">
                        {{ $maintenances->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm hover:scale-105 hover:shadow-2xl transition duration-300">

                    <p class="text-gray-500 mb-3">
                        Terminées
                    </p>

                    <h1 class="text-5xl font-bold text-green-500">
                        {{ $maintenances->where('status', 'Terminée')->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm hover:scale-105 hover:shadow-2xl transition duration-300">

                    <p class="text-gray-500 mb-3">
                        En cours
                    </p>

                    <h1 class="text-5xl font-bold text-yellow-500">
                        {{ $maintenances->where('status', 'En cours')->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm hover:scale-105 hover:shadow-2xl transition duration-300">

                    <p class="text-gray-500 mb-3">
                        Critiques
                    </p>

                    <h1 class="text-5xl font-bold text-red-500">
                        {{ $maintenances->where('status', 'Critique')->count() }}
                    </h1>

                </div>

            </div>

            <!-- CHARTS -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-10">

                <!-- CHART -->
                <div class="bg-white rounded-3xl p-7 shadow-sm hover:scale-105 hover:shadow-2xl transition duration-300">

                    <h2 class="text-2xl font-bold text-[#071120] mb-6">
                        Statistiques Maintenances
                    </h2>

                    <canvas id="maintenanceChart"></canvas>

                </div>

                <!-- ACTIVITY -->
                <div class="bg-[#071120] rounded-3xl p-8 text-white">

                    <h2 class="text-2xl font-bold mb-8">
                        Activité récente
                    </h2>

                    <div class="space-y-6">

                        <div class="flex items-center justify-between">

                            <span>Maintenances terminées</span>

                            <span class="text-[#00C853] font-bold">
                                {{ $maintenances->where('status', 'Terminée')->count() }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span>Maintenances en cours</span>

                            <span class="text-yellow-400 font-bold">
                                {{ $maintenances->where('status', 'En cours')->count() }}
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span>Pannes critiques</span>

                            <span class="text-red-400 font-bold">
                                {{ $maintenances->where('status', 'Critique')->count() }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="bg-white rounded-3xl shadow-sm p-5 lg:p-8 overflow-x-auto">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-5">

                    <div>

                        <h2 class="text-2xl font-bold text-[#071120]">
                            Dernières maintenances
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Liste récente des interventions
                        </p>

                    </div>

                    <div class="flex gap-4">

                        @if(auth()->check() && auth()->user()->role == 'admin')

                        <a href="/maintenances"
                        class="h-14 px-8 rounded-2xl bg-[#00C853] hover:bg-[#00b84c] transition text-white font-semibold flex items-center justify-center">

                            + Ajouter

                        </a>

                        @endif

                        <a href="/export-pdf"
                        class="h-14 px-8 rounded-2xl bg-[#071120] hover:bg-black transition text-white font-semibold flex items-center justify-center">

                            📄 Export PDF

                        </a>

                    </div>

                </div>

                <table class="w-full text-left min-w-[700px]">

                    <thead>

                        <tr class="border-b border-gray-200 text-gray-500">

                            <th class="py-4">ID</th>
                            <th>Équipement</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody id="maintenanceTable" class="text-[#071120]">

                        @foreach($maintenances as $maintenance)

                        <tr class="border-b border-gray-100">

                            <td class="py-6 font-semibold">
                                #{{ $maintenance->id }}
                            </td>

                            <td>
                                Equipment {{ $maintenance->equipment_id }}
                            </td>

                            <td>

                                <span class="px-4 py-2 rounded-xl text-sm font-semibold

                                {{ $maintenance->status == 'Terminée' ? 'bg-green-100 text-green-600' : '' }}
                                {{ $maintenance->status == 'En cours' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                {{ $maintenance->status == 'Critique' ? 'bg-red-100 text-red-600' : '' }}

                                ">

                                    {{ $maintenance->status }}

                                </span>

                            </td>

                            <td>
                                {{ $maintenance->created_at }}
                            </td>

                            <td class="flex items-center gap-3 py-4">

                                <a href="/maintenances/{{ $maintenance->id }}/edit"
                                   class="hover:scale-105 active:scale-95 duration-200 bg-blue-500 hover:bg-blue-600 transition text-white px-4 py-2 rounded-xl">

                                    Modifier

                                </a>

                                <form action="/maintenances/{{ $maintenance->id }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="hover:scale-105 active:scale-95 duration-200 bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl">

                                        Supprimer

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="mt-8">

                    {{ $maintenances->links() }}

                </div>

            </div>

        </div>

    </main>

</div>

<script>

const ctx = document.getElementById('maintenanceChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: ['Terminée', 'En cours', 'Critique'],

        datasets: [{

            data: [
                {{ $maintenances->where('status', 'Terminée')->count() }},
                {{ $maintenances->where('status', 'En cours')->count() }},
                {{ $maintenances->where('status', 'Critique')->count() }}
            ],

            backgroundColor: [
                '#00C853',
                '#FFC107',
                '#FF5252'
            ],

            borderWidth: 0

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                labels: {

                    color: '#071120',

                    font: {
                        size: 14
                    }

                }

            }

        }

    }

});

function toggleSidebar() {

    const sidebar = document.getElementById('sidebar');

    sidebar.classList.toggle('-translate-x-full');

}

function toggleDarkMode() {

    const body = document.getElementById('body');

    body.classList.toggle('bg-[#111827]');
    body.classList.toggle('bg-[#F4F7FA]');

}

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function() {

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll('#maintenanceTable tr');

    rows.forEach(row => {

        let rowText = row.innerText.toLowerCase();

        if(rowText.includes(value)) {

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });

});

window.addEventListener('load', () => {

    document.getElementById('loader').style.display = 'none';

});

</script>

</body>
</html>