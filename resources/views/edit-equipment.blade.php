<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier Equipment</title>

@vite('resources/css/app.css')

</head>

<body class="bg-[#F4F7FA] min-h-screen flex items-center justify-center font-[Poppins]">

<div class="bg-white rounded-3xl shadow-xl p-10 w-full max-w-2xl">

    <h1 class="text-3xl font-bold text-[#071120] mb-8">

        Modifier Équipement

    </h1>

    <form
        action="/equipments/{{ $equipment->id }}"
        method="POST"
        class="space-y-5">

        @csrf
        @method('PUT')

        <div>

            <label class="block mb-2 font-semibold">
                Nom
            </label>

            <input
                type="text"
                name="name"
                value="{{ $equipment->name }}"
                class="w-full border rounded-2xl p-4">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Type
            </label>

            <input
                type="text"
                name="type"
                value="{{ $equipment->type }}"
                class="w-full border rounded-2xl p-4">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-2xl p-4">

                <option
                    {{ $equipment->status=='Disponible' ? 'selected' : '' }}>
                    Disponible
                </option>

                <option
                    {{ $equipment->status=='Maintenance' ? 'selected' : '' }}>
                    Maintenance
                </option>

                <option
                    {{ $equipment->status=='Critique' ? 'selected' : '' }}>
                    Critique
                </option>

            </select>

        </div>

        <div class="flex gap-4 pt-5">

            <button
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl">

                Enregistrer

            </button>

            <a
                href="/equipments"
                class="bg-gray-300 px-6 py-3 rounded-2xl">

                Retour

            </a>

        </div>

    </form>

</div>

</body>
</html>