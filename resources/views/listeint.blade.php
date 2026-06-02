<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Interventions - OCP Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-[Poppins] bg-slate-950 text-slate-100 min-h-screen">

<div class="flex h-screen">

    
    <!-- CONTENT -->
    <main class="ml-64 flex-1 overflow-y-auto">

    
        <div class="p-6 lg:p-10">
            <div>

                <a href="/dashboard"
                    class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-xl">
                        Dashboard
                    </a>
            </div>

            <!-- HEADER -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Liste des interventions</h1>
                <p class="text-slate-400 mt-2">Toutes les interventions enregistrées</p>
            </div>

            

            <!-- TABLEAU NAFSS DESIGN DYAL DASHBOARD -->
            <div class="bg-slate-900 rounded-2xl border-slate-800 p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-700">
                                <th class="p-4 text-left text-sm font-semibold text-slate-400">Maintenance</th>
                                <th class="p-4 text-left text-sm font-semibold text-slate-400">Date début</th>
                                <th class="p-4 text-left text-sm font-semibold text-slate-400">Date fin</th>
                                <th class="p-4 text-left text-sm font-semibold text-slate-400">Rapport</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($interventions as $intervention)
                            <tr class="border-b border-slate-800 hover:bg-slate-800/50 transition">
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-lg bg-blue-500/20 text-blue-400 text-sm font-medium">
                                        #{{ $intervention->maintenance_id }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y H:i') }}
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $intervention->date_fin? \Carbon\Carbon::parse($intervention->date_fin)->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="p-4 text-slate-300 max-w-xs truncate">
                                    {{ $intervention->rapport?? 'Aucun rapport' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($interventions->isEmpty())
                <div class="text-center py-8 text-slate-500">
                    <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                    <p>Aucune intervention trouvée</p>
                </div>
                @endif
            </div>

        </div>
    </main>
</div>

<script>
lucide.createIcons();
</script>

</body>
</html>