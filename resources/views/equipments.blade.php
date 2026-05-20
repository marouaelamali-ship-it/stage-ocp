<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipments</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body class="bg-[#F4F7FA] font-[Poppins]">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-[280px] bg-[#071120] text-white flex flex-col">

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

        <div class="flex-1 py-10 px-6 space-y-4">

            <a href="/dashboard"
               class="flex items-center gap-4 hover:bg-white/5 h-14 px-5 rounded-2xl transition">

                📊 Dashboard

            </a>

            <a href="/equipments"
               class="flex items-center gap-4 bg-[#00C853] h-14 px-5 rounded-2xl text-lg font-semibold">

                🖥️ Equipments

            </a>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-10">

        <!-- TOP -->
        <div class="flex items-center justify-between mb-10">

            <div>

                <h1 class="text-4xl font-bold text-[#071120]">
                    Equipments
                </h1>

                <p class="text-gray-500 mt-2">
                    Gestion des équipements industriels
                </p>

            </div>

            <button
                class="bg-[#00C853] hover:bg-[#00b84c] transition text-white px-8 h-14 rounded-2xl font-semibold">

                + Ajouter équipement

            </button>

        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm hover:shadow-2xl hover:scale-105 transition duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">

                        ⚙️

                    </div>

                    <span class="bg-green-100 text-green-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Actif
                    </span>

                </div>

                <h2 class="text-2xl font-bold text-[#071120] mb-3">
                    Machine OCP #1
                </h2>

                <p class="text-gray-500 mb-6">
                    Equipement industriel de production.
                </p>

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-400">
                        Dernière maintenance:
                        12/05/2026
                    </span>

                    <button class="bg-[#071120] text-white px-5 h-11 rounded-xl hover:bg-black transition">

                        Voir

                    </button>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm hover:shadow-2xl hover:scale-105 transition duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center text-3xl">

                        🔧

                    </div>

                    <span class="bg-yellow-100 text-yellow-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Maintenance
                    </span>

                </div>

                <h2 class="text-2xl font-bold text-[#071120] mb-3">
                    Turbine #4
                </h2>

                <p class="text-gray-500 mb-6">
                    Système de contrôle industriel.
                </p>

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-400">
                        Dernière maintenance:
                        18/05/2026
                    </span>

                    <button class="bg-[#071120] text-white px-5 h-11 rounded-xl hover:bg-black transition">

                        Voir

                    </button>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-3xl p-7 shadow-sm hover:shadow-2xl hover:scale-105 transition duration-300">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl">

                        🚨

                    </div>

                    <span class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-semibold">
                        Critique
                    </span>

                </div>

                <h2 class="text-2xl font-bold text-[#071120] mb-3">
                    Générateur #2
                </h2>

                <p class="text-gray-500 mb-6">
                    Générateur électrique principal.
                </p>

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-400">
                        Dernière maintenance:
                        20/05/2026
                    </span>

                    <button class="bg-[#071120] text-white px-5 h-11 rounded-xl hover:bg-black transition">

                        Voir

                    </button>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>