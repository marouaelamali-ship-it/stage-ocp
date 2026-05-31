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

            <div>

                <label class="block text-[#071120] font-semibold mb-3">
                    Statut
                </label>

            <select
                name="status"
                class="w-full h-16 rounded-2xl border border-gray-200 px-6 outline-none focus:border-[#00C853]">

                <option value="en attente"
                    {{ $maintenance->status == 'en attente' ? 'selected' : '' }}>
                    En attente
                </option>

                <option value="en cours"
                    {{ $maintenance->status == 'en cours' ? 'selected' : '' }}>
                    En cours
                </option>

                <option value="termine"
                    {{ $maintenance->status == 'termine' ? 'selected' : '' }}>
                    Terminée
                </option>

            </select>

            </div>

            <button
                type="submit"
                class="w-full h-16 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white text-xl font-bold">

                Modifier Maintenance

            </button>

            <select name="equipment_id" class="w-full h-16 rounded-2xl border px-6">

                @foreach($equipments as $equipment)

                    <option
                        value="{{ $equipment->id }}"
                        {{ $maintenance->equipment_id == $equipment->id ? 'selected' : '' }}>

                        {{ $equipment->name }}

                    </option>

                @endforeach

                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-2xl border border-gray-200 p-4">{{ $maintenance->description }}</textarea>

            </select>

        </form>

    </div>

</div>

</body>
</html>