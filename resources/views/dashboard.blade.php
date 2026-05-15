<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCP Admin Dashboard</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-[#F4F7FA]">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-[280px] bg-[#071120] text-white flex flex-col">

        <!-- LOGO -->
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

        <!-- MENU -->
        <div class="flex-1 py-10 px-6 space-y-4">

            <a href="/dashboard" class="flex items-center gap-4 bg-[#00C853] h-14 px-5 rounded-2xl text-lg font-semibold">
                📊 Dashboard
            </a>

            <a href="/maintenances" class="flex items-center gap-4 hover:bg-white/5 h-14 px-5 rounded-2xl transition">
                🛠️ Maintenances
            </a>

        </div>

        <!-- FOOTER -->
        <div class="p-6 border-t border-white/10">

            <a href="/login"
               class="w-full h-14 rounded-2xl bg-red-500 hover:bg-red-600 transition font-semibold flex items-center justify-center">

                Déconnexion

            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="h-24 bg-white px-10 flex items-center justify-between border-b border-gray-200">

            <div>
                <h1 class="text-3xl font-bold text-[#071120]">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-1">
                    Bienvenue dans votre espace administrateur
                </p>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-10">

            <!-- STATS -->
            <div class="grid grid-cols-4 gap-8 mb-10">

                <div class="bg-white rounded-3xl p-7 shadow-sm">

                    <p class="text-gray-500 mb-3">
                        Total Maintenances
                    </p>

                    <h1 class="text-5xl font-bold text-[#071120]">
                        {{ $maintenances->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm">

                    <p class="text-gray-500 mb-3">
                        Terminées
                    </p>

                    <h1 class="text-5xl font-bold text-green-500">
                        {{ $maintenances->where('status', 'Terminée')->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm">

                    <p class="text-gray-500 mb-3">
                        En cours
                    </p>

                    <h1 class="text-5xl font-bold text-yellow-500">
                        {{ $maintenances->where('status', 'En cours')->count() }}
                    </h1>

                </div>

                <div class="bg-white rounded-3xl p-7 shadow-sm">

                    <p class="text-gray-500 mb-3">
                        Critiques
                    </p>

                    <h1 class="text-5xl font-bold text-red-500">
                        {{ $maintenances->where('status', 'Critique')->count() }}
                    </h1>

                </div>

            </div>

            <!-- TABLE -->
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <div class="flex items-center justify-between mb-8">

                    <div>
                        <h2 class="text-2xl font-bold text-[#071120]">
                            Dernières maintenances
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Liste récente des interventions
                        </p>
                    </div>

                    <a href="/maintenances"
                       class="h-14 px-8 rounded-2xl bg-[#00C853] hover:bg-[#00b84c] transition text-white font-semibold flex items-center justify-center">

                        + Ajouter

                    </a>

                </div>

                <table class="w-full text-left">

                    <thead>

                        <tr class="border-b border-gray-200 text-gray-500">

                            <th class="py-4">ID</th>
                            <th>Équipement</th>
                            <th>Technicien</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($maintenances as $m)

                        <tr class="border-b border-gray-100">

                            <td class="py-6 font-semibold">
                                #{{ $m->id }}
                            </td>

                            <td>
                                {{ $m->equipment }}
                            </td>

                            <td>
                                {{ $m->technicien }}
                            </td>

                            <td>

                                <span class="px-4 py-2 rounded-xl text-sm font-semibold

                                {{ $m->status == 'Terminée' ? 'bg-green-100 text-green-600' : '' }}
                                {{ $m->status == 'En cours' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                {{ $m->status == 'Critique' ? 'bg-red-100 text-red-600' : '' }}

                                ">

                                    {{ $m->status }}

                                </span>

                            </td>

                            <td>
                                {{ $m->date }}
                            </td>

                            <td class="flex items-center gap-3 py-4">

                                <!-- EDIT -->
                                <a href="/maintenances/{{ $m->id }}/edit"
                                   class="bg-blue-500 hover:bg-blue-600 transition text-white px-4 py-2 rounded-xl">

                                    Modifier

                                </a>

                                <!-- DELETE -->
                                <form action="/maintenances/{{ $m->id }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl">

                                        Supprimer

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>