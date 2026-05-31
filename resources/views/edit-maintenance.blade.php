<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Maintenance</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-[#F4F7FA]">

<div class="min-h-screen p-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-10">

        <div>

            <h1 class="text-5xl font-bold text-[#071120]">
                Modifier Maintenance
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Modifier les informations
            </p>

        </div>

        <a href="/dashboard"
           class="h-14 px-8 rounded-2xl bg-[#071120] text-white flex items-center justify-center font-semibold">

            Retour

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-sm p-10 max-w-4xl">

        <form action="/maintenances/{{ $maintenance->id }}" method="POST" class="space-y-8">

            @csrf
            @method('PUT')

            <!-- EQUIPEMENT -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Nom équipement
                </label>

                <input
                    name="equipment"
                    type="text"
                    value="{{ $maintenance->equipment }}"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                >

            </div>

            <!-- TECHNICIEN -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Technicien
                </label>

                <input
                    name="technician"
                    type="text"
                    value="{{ $maintenance->technicien }}"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
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
                    value="{{ $maintenance->date }}"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]"
                >

            </div>

            <!-- STATUS -->
            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Statut
                </label>

                <select
                    name="status"
                    class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]">

                    <option value="Terminee" {{ $maintenance->status == 'Terminee' ? 'selected' : '' }}>
                        Terminée
                    </option>

                    <option value="En cours" {{ $maintenance->status == 'En cours' ? 'selected' : '' }}>
                        En cours
                    </option>

                    <option value="Critique" {{ $maintenance->status == 'Critique' ? 'selected' : '' }}>
                        Critique
                    </option>

                </select>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full h-16 rounded-2xl bg-blue-500 hover:bg-blue-600 transition text-white text-xl font-bold">

                Modifier Maintenance

            </button>

        </form>

    </div>

</div>

</body>
</html>