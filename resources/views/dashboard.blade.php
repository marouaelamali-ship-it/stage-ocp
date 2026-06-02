<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCP Admin Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
</head>

<body id="body" class="font-[Poppins] h-full bg-white dark:bg-gray-900 text-gray-900 dark:text-white">

<!-- LOADER -->
<div id="loader" class="fixed inset-0 bg-white dark:bg-gray-900 z- flex items-center justify-center">
    <div class="w-16 h-16 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
</div>

<!-- TOAST -->
@if(session('success')) <script>Swal.fire({icon:'success',title:'Succès',text:'{{ session('success') }}',confirmButtonColor:'#2563eb'})</script> @endif
@if(session('delete')) <script>Swal.fire({icon:'error',title:'Supprimé',text:'{{ session('delete') }}',confirmButtonColor:'#dc2626'})</script> @endif
@if(session('update')) <script>Swal.fire({icon:'info',title:'Modification',text:'{{ session('update') }}',confirmButtonColor:'#2563eb'})</script> @endif

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white flex-col transform lg:translate-x-0 -translate-x-full transition-transform duration-300">
        <div class="h-16 flex items-center px-4 border-b border-slate-800">
            <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-xl font-bold">O</div>
            <div class="ml-3">
                <h1 class="text-lg font-bold">OCP Admin</h1>
                <p class="text-xs text-slate-400">Maintenance</p>
            </div>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="/dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-blue-600 text-white"><i data-lucide="layout-dashboard" class="w-5 h-5"></i><span class="text-sm font-medium">Dashboard</span></a>


            <a href="/eListe" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="inbox" class="w-5 h-5"></i>
                <span class="text-sm font-medium">Equipements</span>
            </a>
            
            <a href="/mListe" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <i data-lucide="wrench" class="w-5 h-5"></i>
                <span class="text-sm font-medium">Maintenances</span>

            </a>

            <a href="/calendrier" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition"><i data-lucide="calendar" class="w-5 h-5"></i><span class="text-sm font-medium">Calendrier</span></a>
            <a href="/listeint" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition"><i data-lucide="clipboard-list" class="w-5 h-5"></i><span class="text-sm font-medium">Interventions</span></a>
            <a href="/rapport" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition"><i data-lucide="file-text" class="w-5 h-5"></i><span class="text-sm font-medium">Rapports</span></a>
            <a href="/parametres" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition"><i data-lucide="settings" class="w-5 h-5"></i><span class="text-sm font-medium">Paramètres</span></a>
        </nav>
        <div class="p-3 border-t border-slate-800">
            <form action="/signout" method="POST">@csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">
                    <i data-lucide="log-out" class="w-5 h-5"></i> Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex-col overflow-hidden">

        <!-- HEADER -->
        <header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-4 lg:px-6">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"><i data-lucide="menu" class="w-5 h-5"></i></button>
                <div>
                    <h1 class="text-lg font-semibold">Dashboard</h1>
                    <p class="text-sm text-gray-500">
                        Bienvenue {{ auth()->user()->name }}
                    </p>


                    <p class="hidden lg:block text-sm text-gray-500 dark:text-gray-400">Vue d'ensemble du système de maintenance</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <input id="searchInput" type="text" placeholder="Recher..." class="hidden md:block w-64 px-4 py-2 text-sm border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="darkToggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"><i data-lucide="moon" class="w-5 h-5 dark:hidden"></i><i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i></button>
                <img src="https://ui-avatars.com/api/?name=Admin+OCP&background=3b82f6&color=fff" class="w-9 h-9 rounded-full">
            </div>
        </header>

        <!-- CONTENT -->
        <main class="h-screen overflow-y-auto p-4 lg:p-6 bg-white dark:bg-gray-900">            <div class="space-y-6">
            
                <div class="grid grid-cols-2 gap-4 mb-6">

                
    
    <!-- JIH LISSAR: ALERT -->
    <div>
        @if($attente > 0)
        <div class="bg-red-100 border-red-300 text-red-700 px-4 py-3 rounded-lg h-full flex items-center">
            ⚠️ Il y a {{ $attente }} maintenance(s) en attente.
        </div>
        @else
        <div class="bg-green-100 border-green-300 text-green-700 px-4 py-3 rounded-lg h-full flex items-center">
            ✅ Aucune maintenance en attente
        </div>
        @endif
    </div>

    

    <!-- JIH LYMEN: PROGRESS BAR -->
    <div class="bg-slate-800 rounded-lg p-4">
        <p class="text-sm text-slate-300 mb-2">Taux de maintenance terminée</p>
        <div class="w-full bg-gray-700 rounded-full h-3">
            <div
                class="bg-green-500 h-3 rounded-full transition-all duration-500"
                style="width: {{ $totalMaintenances > 0 ? ($terminees/$totalMaintenances)*100 : 0 }}%">
            </div>
        </div>
        <p class="text-xs text-slate-400 mt-1">
            {{ $totalMaintenances > 0 ? round(($terminees/$totalMaintenances)*100, 1) : 0 }}%
        </p>
    </div>

</div>

                <!-- STATS CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Maintenances</p>
                                <p class="text-2xl font-bold mt-1">{{ $totalMaintenances }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center"><i data-lucide="wrench" class="w-5 h-5 text-blue-600"></i></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Terminées</p>
<p class="text-2xl font-bold mt-1 text-green-600">{{ $terminees }}</p>                            </div>
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center"><i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">En cours</p>
                                <p class="text-2xl font-bold mt-1 text-yellow-600">{{ $encours           }}</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center"><i data-lucide="clock" class="w-5 h-5 text-yellow-600"></i></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">En attente</p>
                                <p class="text-2xl font-bold mt-1 text-red-600">{{ $attente }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center"><i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i></div>
                        </div>
                    </div>  
                    

                    <!-- EQP -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Total Equipements
                                </p>
                                <p class="text-2xl font-bold mt-1 text-blue-600">
                                    {{ $equipments }}
                                </p>
                            </div>

                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="cpu" class="w-5 h-5 text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Utilisateurs
                                </p>

                                <p class="text-2xl font-bold mt-1 text-purple-600">
                                    {{ $users }}
                                </p>
                            </div>

                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i data-lucide="users" class="w-5 h-5 text-purple-600"></i>
                            </div>
                        </div>
                        
                    </div>

                    <div class="mt-4"> </div>

                </div>

                


                <!-- BOUTONS LFO9 -->
                <div class="flex flex-wrap gap-2">
                    <a href="/maintenances" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium flex items-center gap-2 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i> Ajouter maintenance
                    </a>
                    <a href="/equipments" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium flex items-center gap-2 transition">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Ajouter équipement
                    </a>
                    
                    
                    <a href="/interventions" class="px-10 py-10 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium flex items-center gap-2 transition">
                        <i data-lucide="alert-circle" class="w-4 h-4"></i>
                            Intervention urgente
                    </a>
                </div>



                <!-- CHARTS -->
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold mb-4">Evolution des maintenances (par mois)</h3>
                        <div class="h-72"><canvas id="lineChart"></canvas></div>
                    </div>
                    
                    <!-- REPARATION PAR STATUT - DONUT -->

                    <!--<div class="mt-4">
                        <p class="text-sm mb-2">
                            Taux de maintenance terminée
                        </p>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div
                                class="bg-green-500 h-3 rounded-full"
                                style="width: {{ $totalMaintenances > 0 ? ($terminees/$totalMaintenances)*100 : 0 }}%">
                            </div>
                        </div>
                    </div>-->

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-gray-200 dark:border-gray-700">
    <h3 class="font-semibold mb-4">Réparation par statut</h3>
    <div class="h-48 mb-4"><canvas id="donutChart"></canvas></div>
    <div class="space-y-3 text-sm">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                <span>Terminées</span>
            </div>
            <div class="text-right">
                <span class="font-bold">{{ $terminees }}</span>
                <span class="text-gray-500 text-xs ml-1">
                    ({{ $totalMaintenances > 0 ? round(($terminees/$totalMaintenances)*100) : 0 }}%)
                </span>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                <span>En cours</span>
            </div>
            <div class="text-right">
                <span class="font-bold">{{ $encours }}</span>
                <span class="text-gray-500 text-xs ml-1">
                    ({{ $totalMaintenances > 0 ? round(($encours/$totalMaintenances)*100) : 0 }}%)
                </span>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                <span>En attente</span>
            </div>
            <div class="text-right">
                <span class="font-bold">{{ $attente }}</span>
                <span class="text-gray-500 text-xs ml-1">
                    ({{ $totalMaintenances > 0 ? round(($attente/$totalMaintenances)*100) : 0 }}%)
                </span>
            </div>
        </div>
    </div>
</div>

                <!-- TABLE -->
                <!--<div class="mt-32 bg-white dark:bg-gray-800 rounded-xl shadow-sm border-gray-200 dark:border-gray-700 overflow-hidden">                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-semibold">Liste des maintenances récentes</h3>
                        <input id="searchTable" type="text" placeholder="Recher (équipement, ID...)" class="px-3 py-1.5 text-sm border rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">ID</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Equipement</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Status</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Date</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="maintenanceTable" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($maintenances as $m)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                    <td class="px-4 py-3 font-semibold">#{{ $m->id }}</td>
                                    <!--<td class="px-4 py-3">Equipment {{ $m->equipment_id }}</td>-->

                                    <!--<td class="px-4 py-3">{{ $m->equipment->name ?? 'N/A' }}</td>

                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $m->status=='termine'? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                            {{ $m->status=='en cours'? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                            {{ $m->status=='en attente'? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                                            {{ $m->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 flex gap-2">
                                        <a href="/maintenances/{{ $m->id }}/edit" class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200"><i data-lucide="edit" class="w-4 h-4"></i></a>
                                        <form action="/maintenances/{{ $m->id }}" method="POST">@csrf @method('DELETE')
                                            <button class="p-1.5 bg-red-100 text-red-600 rounded hover:bg-red-200"><i data-lucide="trash" class="w-4 h-4"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table-->

                    </div>
                </div>

            </div>
        </main>
    </div>
</div>



<script>
lucide.createIcons();
window.addEventListener('load', () => document.getElementById('loader').style.display = 'none');
function toggleSidebar(){document.getElementById('sidebar').classList.toggle('-translate-x-full')}

// DARK MODE - blanc by default
const darkToggle = document.getElementById('darkToggle');
if(localStorage.theme === 'dark') document.documentElement.classList.add('dark');
darkToggle?.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    localStorage.theme = document.documentElement.classList.contains('dark')? 'dark' : 'light';
});

// SEARCH
document.getElementById('searchTable')?.addEventListener('keyup', function(){
    let val = this.value.toLowerCase();
    document.querySelectorAll('#maintenanceTable tr').forEach(r => r.style.display = r.innerText.toLowerCase().includes(val)? '' : 'none');
});

// LINE CHART
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: 'Maintenances',
            data: @json($monthlyMaintenances),
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {responsive:true, maintainAspectRatio:false}
});

// DONUT CHART - REPARATION PAR STATUT
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Terminées','En cours','En attente'],
        datasets: [{
            data: [
                {{ $maintenances->where('status','termine')->count() }},
                {{ $maintenances->where('status','en cours')->count() }},
                {{ $maintenances->where('status','en attente')->count() }}
            ],
            backgroundColor: ['#10b981','#f59e0b','#ef4444'],
            borderWidth: 0
        }]
    },
    options: {responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right'}}}
});
</script>
</body>
</html>