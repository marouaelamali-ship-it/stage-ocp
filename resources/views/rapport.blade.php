<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Rapports - OCP Admin</title>
@vite('resources/css/app.css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-slate-900 text-white min-h-screen p-6">

<div class="max-w-7xl mx-auto">

<!-- BUTTONS -->
    <div class="flex gap-4 mt-6">
        <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-xl font-semibold transition">
            ← Retour Dashboard
        </a>

        <a href="/export-pdf" class="bg-red-600 hover:bg-red-700 px-5 py-3 rounded-xl font-semibold transition">
            📄 Exporter PDF
        </a>

        
    </div>


    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold">📊 Rapports & Statistiques</h1>
        <p class="text-slate-400 mt-2">Vue globale dyal système dyal maintenance</p>
    </div>

    <!-- STATS CARDS LFO9 -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-800 p-6 rounded-2xl border-slate-700">
            <h2 class="text-slate-400 text-sm mb-2">Equipements</h2>
            <p class="text-4xl font-bold text-blue-500">{{ $totalEquipments }}</p>
        </div>

        <div class="bg-slate-800 p-6 rounded-2xl border-slate-700">
            <h2 class="text-slate-400 text-sm mb-2">Maintenances</h2>
            <p class="text-4xl font-bold text-green-500">{{ $totalMaintenances }}</p>
        </div>

        <div class="bg-slate-800 p-6 rounded-2xl border-slate-700">
            <h2 class="text-slate-400 text-sm mb-2">Interventions</h2>
            <p class="text-4xl font-bold text-orange-500">{{ $totalInterventions }}</p>
        </div>
    </div>

    <!-- GRAPH GLOBAL BAR -->
    <div class="bg-slate-800 rounded-2xl p-6 mb-8 border-slate-700">
        <h2 class="text-2xl font-bold mb-6">📈 Statistiques Globales</h2>
        <div style="height:500px;">
            <canvas id="globalChart"></canvas>
        </div>
    </div>

    <!-- GRAPH DOUGHNUT WA7D -->
    <div class="bg-slate-800 rounded-2xl p-6 mb-8 border-slate-700">
        <h2 class="text-2xl font-bold mb-6">🔧 Répartition des Maintenances</h2>
        <div class="h-96">
            <canvas id="chart"></canvas>
        </div>
    </div>

</div>

<!-- CHART GLOBAL BAR -->
<script>
new Chart(document.getElementById('globalChart'), {
    type: 'bar',
    data: {
        labels: ['Equipements', 'Maintenances', 'Interventions'],
        datasets: [{
            label: 'Total',
            data: [{{ $totalEquipments }}, {{ $totalMaintenances }}, {{ $totalInterventions }}],
            backgroundColor: ['#2563eb', '#10b981', '#f59e0b'],
            borderRadius: 12
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.1)' } },
            x: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.1)' } }
        }
    }
});
</script>

<!-- CHART DOUGHNUT WA7D -->
<script>
new Chart(document.getElementById('chart'), {
    type: 'doughnut',
    data: {
        labels: ['Terminées', 'En cours', 'En attente'],
        datasets: [{
            data: [{{ $terminees }}, {{ $encours }}, {{ $attente }}],
            backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { 
                position: 'bottom',
                labels: { color: '#cbd5e1', padding: 20 }
            }
        }
    }
});
</script>

</body>
</html>