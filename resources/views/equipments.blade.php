<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
<meta charset="UTF-8">
<title>Equipments Dashboard</title>
@vite('resources/css/app.css')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>tailwind.config = { darkMode: 'class' }</script>
<style>
    body { font-family: Inter, sans-serif; }
  .glass { backdrop-filter: blur(12px); background: rgba(255,255,255,0.8); }
  .dark.glass { background: rgba(17,24,39,0.8); }
  .gradient-border { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1px; border-radius: 1.5rem; }
  .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
  .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1); }
</style>
</head>

<body class="font-[Inter] bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">

<div class="min-h-screen p-6 lg:p-10">

    <!-- HEADER ENTERPRISE -->
    <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-lg mb-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold">🏭 Equipments Dashboard</h1>
                <p class="text-slate-300 mt-2">Gestion des équipements Enterprise</p>
            </div>
            <a href="/dashboard" class="h-12 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center font-semibold transition">
                ← Retour Dashboard
            </a>
        </div>
    </div>

    <!-- STATS PRO - ZDT?? BACH MAYW9A3CH ERROR -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="gradient-border">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center">
                        <i data-lucide="inbox" class="w-6 h-6 text-indigo-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total</p>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $totalEquipments?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Disponibles</p>
                <h1 class="text-4xl text-green-600 font-bold">{{ $disponibles?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl flex items-center justify-center">
                        <i data-lucide="wrench" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Maintenance</p>
                <h1 class="text-4xl text-yellow-600 font-bold">{{ $maintenance?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-2xl flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Critiques</p>
                <h1 class="text-4xl text-red-600 font-bold">{{ $critiques?? 0 }}</h1>
            </div>
        </div>
    </div>

    <!-- CHART GLASS -->
    <div class="glass rounded-3xl p-8 border-white/20 shadow mb-8 card-hover">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Statistiques Equipments</h2>
        <div class="h-80"><canvas id="equipmentChart"></canvas></div>
    </div>

    @if(auth()->user()->role == 'admin')

    <!-- AJOUT GLASS -->
    <div class="glass rounded-3xl p-8 border-white/20 shadow mb-8 card-hover">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Ajouter Equipment</h2>
        <form action="/equipments" method="POST" class="grid gap-5">
            @csrf
            <input
                type="text"
                name="name"
                placeholder="Nom equipment"
                class="border-gray-300 dark:border-gray-600 p-4 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:border-indigo-500"
                required>

            <input
                type="text"
                name="type"
                placeholder="Type"
                class="border-gray-300 dark:border-gray-600 p-4 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:border-indigo-500"
                required>

            <select
                name="status"
                class="border-gray-300 dark:border-gray-600 p-4 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white outline-none focus:border-indigo-500"
                required>
                <option value="Disponible">Disponible</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Critique">Critique</option>
            </select>

            <button class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-2xl p-4 font-bold transition">
                Ajouter
            </button>
        </form>
    </div>

    <!-- TABLE GLASS -->
    <div class="glass rounded-3xl p-8 border-white/20 shadow card-hover">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Liste Equipments</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Nom</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                    @forelse($equipments?? [] as $equipment)
                    <tr class="hover:bg-white/50 dark:hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $equipment->id }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $equipment->name }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $equipment->type }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                {{ $equipment->status=='Disponible'? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                {{ $equipment->status=='Maintenance'? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                {{ $equipment->status=='Critique'? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                                {{ $equipment->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="/equipments/{{ $equipment->id }}/edit" class="p-2 glass rounded-lg hover:bg-white/50">
                                    <i data-lucide="edit-3" class="w-4 h-4 text-blue-600"></i>
                                </a>
                                <form action="/equipments/{{ $equipment->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 glass rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Aucun équipement trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ ($equipments->links()?? '') }}
        </div>
    </div>
    @endif

</div>

<script>
lucide.createIcons();

new Chart(document.getElementById('equipmentChart'), {
    type: 'bar',
    data: {
        labels: ['Disponible','Maintenance','Critique'],
        datasets: [{
            label: 'Nombre d\'équipements',
            data: [
                {{ $disponibles?? 0 }},
                {{ $maintenance?? 0 }},
                {{ $critiques?? 0 }}
            ],
            backgroundColor: [
                'rgba(16, 185, 129, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(239, 68, 68, 0.8)'
            ],
            borderColor: [
                '#10b981',
                '#f59e0b',
                '#ef4444'
            ],
            borderWidth: 2,
            borderRadius: 12
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
            x: { grid: { display: false } }
        }
    }
});
</script>

</body>
</html>