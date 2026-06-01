<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Equipments - OCP Admin</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <style>
        body { font-family: Inter, sans-serif; }

        /* THEME SOMBRE PRO */
       .card-dark {
            background: linear-gradient(135deg, rgba(30,41,59,0.9) 0%, rgba(15,23,42,0.95) 100%);
            border: 1px solid rgba(148,163,184,0.1);
            backdrop-filter: blur(10px);
        }
       .gradient-border-dark {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #8b5cf6 100%);
            padding: 1px;
            border-radius: 1.5rem;
        }
       .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
       .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5); }

        table thead { background: rgba(15,23,42,0.8); }
        table tbody tr:hover { background: rgba(30,41,59,0.5); }
    </style>
</head>

<body class="font-[Inter] bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen text-slate-100">

<div class="min-h-screen p-6 lg:p-10">

    <!-- HEADER SOMBRE -->
    <div class="card-dark rounded-2xl p-6 shadow-2xl mb-8 border-slate-700/50">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">📋 Liste Equipments</h1>
                <p class="text-slate-400 mt-2">Gestion complète des équipements</p>
            </div>
            <div class="flex gap-3">

            

                <a href="/dashboard" class="h-12 px-6 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 flex items-center justify-center font-semibold transition border-slate-600">
                    ← Dashboard
                </a>
                
            </div>
        </div>
    </div>

    <!-- STATS SOMBRE -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-sky-500/20 rounded-2xl flex items-center justify-center border-sky-500/30">
                        <i data-lucide="inbox" class="w-6 h-6 text-sky-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mb-1">Total</p>
                <h1 class="text-4xl font-bold text-white">{{ $totalEquipments?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center border-emerald-500/30">
                        <i data-lucide="check-circle" class="w-6 h-6 text-emerald-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mb-1">Disponibles</p>
                <h1 class="text-4xl text-emerald-400 font-bold">{{ $disponibles?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-500/20 rounded-2xl flex items-center justify-center border-amber-500/30">
                        <i data-lucide="wrench" class="w-6 h-6 text-amber-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mb-1">Maintenance</p>
                <h1 class="text-4xl text-amber-400 font-bold">{{ $maintenance?? 0 }}</h1>
            </div>
        </div>

        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-500/20 rounded-2xl flex items-center justify-center border-red-500/30">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mb-1">Critiques</p>
                <h1 class="text-4xl text-red-400 font-bold">{{ $critiques?? 0 }}</h1>
            </div>
        </div>
    </div>

    <!-- CHART SOMBRE -->
    <div class="card-dark rounded-3xl p-8 shadow-2xl mb-8 card-hover border-slate-700/50">
        <h2 class="text-2xl font-bold mb-6 text-white">Statistiques Equipments</h2>
        <div class="h-80"><canvas id="equipmentChart"></canvas></div>
    </div>

    <!-- TABLE SOMBRE -->
    <div class="card-dark rounded-3xl p-8 shadow-2xl card-hover border-slate-700/50">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">📋 Liste Equipments</h2>
            <div class="flex items-center gap-2 text-sm text-slate-400">
                <i data-lucide="database" class="w-4 h-4"></i>
                <span>Total: {{ $equipments->total()?? ($equipments->count()?? 0) }}</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="rounded-xl">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($equipments?? [] as $equipment)
                    <tr class="transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-200">#{{ $equipment->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($equipment->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-slate-200">{{ $equipment->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-300">{{ $equipment->type }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                {{ $equipment->status=='Disponible'? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : '' }}
                                {{ $equipment->status=='Maintenance'? 'bg-amber-500/20 text-amber-400 border-amber-500/30' : '' }}
                                {{ $equipment->status=='Critique'? 'bg-red-500/20 text-red-400 border-red-500/30' : '' }}">
                                {{ $equipment->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="/equipments/{{ $equipment->id }}/edit" class="p-2 rounded-xl bg-slate-700/50 hover:bg-slate-600/50 transition border-slate-600" title="Modifier">
                                    <i data-lucide="edit-3" class="w-4 h-4 text-sky-400"></i>
                                </a>
                                <form action="/equipments/{{ $equipment->id }}" method="POST" onsubmit="return confirm('Supprimer cet équipement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2 rounded-xl bg-red-500/20 hover:bg-red-500/30 transition border-red-500/30" title="Supprimer">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-red-400"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl bg-slate-800 flex items-center justify-center border-slate-700">
                                    <i data-lucide="inbox" class="w-8 h-8 text-slate-500"></i>
                                </div>
                                <p class="text-slate-400 font-medium">Aucun équipement trouvé</p>
                                <a href="/equipments" class="mt-2 text-sky-400 hover:text-sky-300 font-semibold">Ajouter le premier équipement →</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION SOMBRE -->
        <div class="mt-6 pt-6 border-t border-slate-700/50">
            <div class="text-slate-300">
                {{ ($equipments->links()?? '') }}
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    const ctx = document.getElementById('equipmentChart');
    if(ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Disponible','Maintenance','Critique'],
                datasets: [{
                    label: 'Nombre d\'équipements',
                    data: [
                        {{ (int)($disponibles?? 0) }},
                        {{ (int)($maintenance?? 0) }},
                        {{ (int)($critiques?? 0) }}
                    ],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.6)',
                        'rgba(245, 158, 11, 0.6)',
                        'rgba(239, 68, 68, 0.6)'
                    ],
                    borderColor: ['#10b981','#f59e0b','#ef4444'],
                    borderWidth: 2,
                    borderRadius: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        borderColor: 'rgba(148, 163, 184, 0.2)',
                        borderWidth: 1,
                        titleColor: '#fff',
                        bodyColor: '#cbd5e1'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(148,163,184,0.1)' },
                        ticks: { color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    }
});
</script>

</body>
</html>