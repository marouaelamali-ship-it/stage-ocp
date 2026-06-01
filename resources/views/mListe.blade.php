<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste Maintenances</title>
@vite('resources/css/app.css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body{
    font-family:Poppins,sans-serif;
}
</style>
</head>

<body class="bg-white dark:bg-gray-900">

<div class="min-h-screen p-6">

    <!-- HEADER - BDALTO L SLATE-900 B SLATE-800 BACH YJI N9I M3A SIDEBAR -->
    <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-lg mb-6">

        <div class="flex justify-between items-center flex-wrap gap-4">

            <div>
                <h1 class="text-3xl font-bold">
                    🔧 Liste des Maintenances
                </h1>
                <p class="text-slate-300 mt-2">
                    Gestion des opérations de maintenance
                </p>
            </div>

            <div class="flex gap-3">
                <a href="/dashboard"
                   class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-xl">
                    Dashboard
                </a>
                <a href="/export-pdf"
                   class="bg-red-600 hover:bg-red-700 px-4 py-3 rounded-xl">
                    📄 PDF
                </a>
            </div>

        </div>
    </div>

    <!-- STATS -->
    <div class="grid md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-gray-500 dark:text-gray-400">Total</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $maintenances->total() }}
            </h2>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-green-600">Terminées</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ \App\Models\Maintenance::where('status','termine')->count() }}
            </h2>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-yellow-600">En cours</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ \App\Models\Maintenance::where('status','en cours')->count() }}
            </h2>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-red-600">En attente</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ \App\Models\Maintenance::where('status','en attente')->count() }}
            </h2>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border-gray-200 dark:border-gray-700 overflow-hidden">

        <div class="p-5 border-b border-gray-200 dark:border-gray-700">
            <input
                type="text"
                id="searchInput"
                placeholder="Recherche..."
                class="w-full md:w-80 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
            >
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="p-4 text-left">#</th>
                        <th class="p-4 text-left">Equipement</th>
                        <th class="p-4 text-left">Statut</th>
                        <th class="p-4 text-left">Date</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody id="maintenanceTable">
                @foreach($maintenances as $m)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30">
                        <td class="p-4 text-gray-900 dark:text-white">
                            {{ $m->id }}
                        </td>
                        <td class="p-4 text-gray-900 dark:text-white">
                            {{ $m->equipment->name ?? 'N/A' }}
                        </td>
                        <td class="p-4">
                            @if($m->status == 'termine')
                                <span class="bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded-full text-sm">
                                    terminé
                                </span>
                            @elseif($m->status == 'en cours')
                                <span class="bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 px-3 py-1 rounded-full text-sm">
                                    en cours
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 px-3 py-1 rounded-full text-sm">
                                    en attente
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-gray-600 dark:text-gray-400">
                            {{ $m->created_at->format('d/m/Y') }}
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center gap-2">
                                <a href="/maintenances/{{ $m->id }}/edit"
                                   class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200">
                                    ✏️
                                </a>
                                <form action="/maintenances/{{ $m->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-5">
            {{ $maintenances->links() }}
        </div>
    </div>

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(){
    let value = this.value.toLowerCase();
    document.querySelectorAll('#maintenanceTable tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>

</body>
</html>