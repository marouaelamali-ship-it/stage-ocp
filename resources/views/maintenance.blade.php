<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Maintenance</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-[#F4F7FA]">

<div class="min-h-screen p-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-10">

        <div>

            <h1 class="text-5xl font-bold text-[#071120]">
                Nouvelle Maintenance
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Ajouter une nouvelle intervention
            </p>

        </div>

        <a href="/dashboard"
            class="h-14 px-8 rounded-2xl bg-[#071120] text-white flex items-center justify-center font-semibold">

            Retour

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm p-10 max-w-4xl">

        <form action="/maintenances" method="POST" class="space-y-8">

            @csrf

            <!-- EQUIPEMENT -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Equipement
                </label>

                <select
                    name="equipment_id"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                    required
                >

                    <option value="">
                        Choisir un équipement
                    </option>

                    @foreach($equipments as $equipment)

                        <option value="{{ $equipment->id }}">
                            {{ $equipment->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- TECHNICIEN -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Technicien
                </label>

                <input
                    name="technician"
                    type="text"
                    placeholder="Nom technicien..."
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                    required
                >

            </div>

            <!-- DATE -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Date
                </label>

                <input
                    name="date"
                    type="date"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                    required
                >

            </div>

            <!-- STATUS -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Statut
                </label>

                <select
                    name="status"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                    required>

                    <option value="en attente">En attente</option>
                    <option value="en cours">En cours</option>
                    <option value="termine">Terminée</option>

                </select>

            </div>
            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full h-16 rounded-2xl bg-[#00C853] hover:bg-[#00b84c] transition text-white text-xl font-bold">

                Ajouter Maintenance

            </button>

            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Description
                </label>

                <textarea
                    name="description"
                    class="w-full rounded-2xl border border-gray-200 p-4"
                    rows="4"
                    required
                ></textarea>

            </div>

        </form>

    </div>

</div>

</body>
</html>