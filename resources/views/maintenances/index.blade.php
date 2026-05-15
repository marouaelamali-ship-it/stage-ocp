<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenances</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-[#F4F7FA]">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-[280px] bg-[#071120] text-white flex flex-col">

        <div class="h-24 flex items-center px-8 border-b border-white/10">

            <div class="w-14 h-14 rounded-2xl bg-[#00C853] flex items-center justify-center text-2xl font-bold">
                O
            </div>

            <div class="ml-4">
                <h1 class="text-2xl font-bold">OCP Admin</h1>
                <p class="text-sm text-gray-400">
                    Maintenance System
                </p>
            </div>

        </div>

        <div class="flex-1 py-10 px-6 space-y-4">

            <a href="/dashboard"
               class="flex items-center gap-4 hover:bg-white/5 h-14 px-5 rounded-2xl transition">

                📊 Dashboard

            </a>

            <a href="/maintenances"
               class="flex items-center gap-4 bg-[#00C853] h-14 px-5 rounded-2xl text-lg font-semibold">

                🛠️ Maintenances

            </a>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-10">

            <div>
                <h1 class="text-4xl font-bold text-[#071120]">
                    Maintenances
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestion des interventions de maintenance
                </p>
            </div>

            <button class="h-14 px-8 rounded-2xl bg-[#00C853] hover:bg-[#00b84c] transition text-white font-semibold">

                + Ajouter maintenance

            </button>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-3xl p-8 shadow-sm">

            <table class="w-full">

                <thead>

                <tr class="border-b border-gray-100 text-left text-gray-500">

                    <th class="pb-5">ID</th>
                    <th class="pb-5">Équipement</th>
                    <th class="pb-5">Technicien</th>
                    <th class="pb-5">Statut</th>
                    <th class="pb-5">Date</th>
                    <th class="pb-5">Actions</th>

                </tr>

                </thead>

                <tbody class="text-[#071120]">

                <tr class="border-b border-gray-100">

                    <td class="py-6 font-semibold">
                        #001
                    </td>

                    <td>
                        Machine Industrielle
                    </td>

                    <td>
                        Ahmed Benali
                    </td>

                    <td>
                        <span class="bg-green-100 text-green-600 px-4 py-2 rounded-xl text-sm font-semibold">
                            Terminée
                        </span>
                    </td>

                    <td>
                        12 Mai 2026
                    </td>

                    <td class="space-x-3">

                        <button class="px-4 py-2 rounded-xl bg-blue-100 text-blue-600 font-semibold">
                            Modifier
                        </button>

                        <button class="px-4 py-2 rounded-xl bg-red-100 text-red-600 font-semibold">
                            Supprimer
                        </button>

                    </td>

                </tr>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>