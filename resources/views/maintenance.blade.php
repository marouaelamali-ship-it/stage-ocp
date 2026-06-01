<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Maintenance</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-white dark:bg-gray-900 text-gray-900 dark:text-white">

<div class="min-h-screen p-6 lg:p-10">

    <!-- HEADER BLANC B7AL L-PAGES LKHORIN -->
    <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-lg mb-6">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold">
                    🔧 Nouvelle Maintenance
                </h1>
                <p class="text-slate-300 mt-2">
                    Ajouter une nouvelle intervention
                </p>
            </div>
            <a href="/dashboard" class="h-12 px-6 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center font-semibold transition">
                ← Retour Dashboard
            </a>
        </div>
    </div>

    <!-- FORM CARD BLANC -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border-gray-200 dark:border-gray-700 p-6 lg:p-10 max-w-4xl mx-auto">

        <form action="/maintenances" method="POST" class="space-y-6">
            @csrf

            <!-- EQUIPEMENT -->
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Equipement *
                </label>
                <select
                    name="equipment_id"
                    class="w-full h-14 rounded-xl border-gray-300 dark:border-gray-600 px-4 outline-none focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    required
                >
                    <option value="">Choisir un équipement</option>
                    @foreach($equipments as $equipment)
                        <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- TECHNICIEN -->
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Technicien *
                </label>
                <input
                    name="technician"
                    type="text"
                    placeholder="Nom technicien..."
                    class="w-full h-14 rounded-xl border-gray-300 dark:border-gray-600 px-4 outline-none focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    required
                >
            </div>

            <!-- DATE -->
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Date *
                </label>
                <input
                    name="date"
                    type="date"
                    class="w-full h-14 rounded-xl border-gray-300 dark:border-gray-600 px-4 outline-none focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    required
                >
            </div>

            <!-- STATUS -->
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Statut *
                </label>
                <select
                    name="status"
                    class="w-full h-14 rounded-xl border-gray-300 dark:border-gray-600 px-4 outline-none focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    required>
                    <option value="en attente">En attente</option>
                    <option value="en cours">En cours</option>
                    <option value="termine">Terminée</option>
                </select>
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Description *
                </label>
                <textarea
                    name="description"
                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 p-4 outline-none focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="4"
                    required
                ></textarea>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full h-14 rounded-xl bg-blue-600 hover:bg-blue-700 transition text-white text-lg font-bold">
                Ajouter Maintenance
            </button>

        </form>
    </div>

</div>

</body>
</html>