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

<div class="flex flex-col lg:flex-row h-screen overflow-hidden">
    
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

            <a href="/logout"
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

    <form action="/dashboard"
          method="GET"
          class="w-[320px] h-14 bg-[#F4F7FA] rounded-2xl px-5 flex items-center">

        <input
            name="search"
            type="text"
            placeholder="Rechercher..."
            class="bg-transparent outline-none w-full"
        >

    </form>

</div>

        <!-- CONTENT -->
        <div class="p-10">

            <!-- STATS -->
                <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8 mb-10">

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

                <div class="bg-white p-8 rounded-3xl shadow-sm mb-10">

    <h2 class="text-2xl font-bold mb-6">
        Statistiques
    </h2>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-green-100 h-40 rounded-3xl flex flex-col items-center justify-center">
            <h1 class="text-5xl font-bold text-green-600">
                {{ $termines }}
            </h1>

            <p class="mt-3 font-semibold text-green-700">
                Terminées
            </p>
        </div>

        <div class="bg-yellow-100 h-40 rounded-3xl flex flex-col items-center justify-center">
            <h1 class="text-5xl font-bold text-yellow-600">
                {{ $encours }}
            </h1>

            <p class="mt-3 font-semibold text-yellow-700">
                En cours
            </p>
        </div>

        <div class="bg-red-100 h-40 rounded-3xl flex flex-col items-center justify-center">
            <h1 class="text-5xl font-bold text-red-600">
                {{ $critiques }}
            </h1>

            <p class="mt-3 font-semibold text-red-700">
                Critiques
            </p>
        </div>

    </div>

</div>

                <table class="w-full text-left">

                    <thead>

                        <tbody class="text-[#071120]">

                @foreach($maintenances as $maintenance)

                <tr class="border-b border-gray-100">

                    <td class="py-6 font-semibold">
                        #{{ $maintenance->id }}
                    </td>

                    <td>
                        Equipment {{ $maintenance->equipment_id }}
                    </td>

                    <td>
                        ---
                    </td>

                    <td>

                        <span class="bg-yellow-100 text-yellow-600 px-4 py-2 rounded-xl text-sm font-semibold">

                            {{ $maintenance->status }}

                        </span>

                    </td>

                    <td>
                        {{ $maintenance->created_at }}
                    </td>

                </tr>

                @endforeach

                </tbody>
                
                    </thead>

                    

                </table>

                <div class="mt-8">
                    {{ $maintenances->links() }}
                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>