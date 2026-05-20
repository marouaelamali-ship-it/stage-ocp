<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Equipments Dashboard</title>

@vite('resources/css/app.css')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-[#F4F7FA] font-[Poppins]">

<div class="p-10">

    <h1 class="text-4xl font-bold text-[#071120] mb-10">
        Equipments Dashboard
    </h1>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-3xl p-6 shadow">
            <p class="text-gray-500">Total</p>
            <h1 class="text-4xl font-bold">
                {{ $totalEquipments }}
            </h1>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow">
            <p class="text-gray-500">Disponibles</p>
            <h1 class="text-4xl text-green-500 font-bold">
                {{ $disponibles }}
            </h1>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow">
            <p class="text-gray-500">Maintenance</p>
            <h1 class="text-4xl text-yellow-500 font-bold">
                {{ $maintenance }}
            </h1>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow">
            <p class="text-gray-500">Critiques</p>
            <h1 class="text-4xl text-red-500 font-bold">
                {{ $critiques }}
            </h1>
        </div>

    </div>

    <!-- CHART -->
    <div class="bg-white rounded-3xl p-8 shadow mb-10">

        <h2 class="text-2xl font-bold mb-6">
            Statistiques Equipments
        </h2>

        <canvas id="equipmentChart"></canvas>

    </div>

    <!-- AJOUT -->
    <div class="bg-white rounded-3xl p-8 shadow mb-10">

        <h2 class="text-2xl font-bold mb-6">
            Ajouter Equipment
        </h2>

        <form action="/equipments" method="POST" class="grid gap-5">

            @csrf

            <input
                type="text"
                name="name"
                placeholder="Nom equipment"
                class="border p-4 rounded-2xl">

            <input
                type="text"
                name="type"
                placeholder="Type"
                class="border p-4 rounded-2xl">

            <select
                name="status"
                class="border p-4 rounded-2xl">

                <option>Disponible</option>
                <option>Maintenance</option>
                <option>Critique</option>

            </select>

            <button
                class="bg-[#00C853] text-white rounded-2xl p-4">

                Ajouter

            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl p-8 shadow">

        <h2 class="text-2xl font-bold mb-6">
            Liste Equipments
        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($equipments as $equipment)

                <tr class="border-b text-center">

                    <td>{{ $equipment->id }}</td>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->type }}</td>
                    <td>{{ $equipment->status }}</td>

                    <td class="py-4 flex gap-2 justify-center">

                        <a
                            href="/equipments/{{ $equipment->id }}/edit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-xl">

                            Modifier

                        </a>

                        <form
                            action="/equipments/{{ $equipment->id }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-500 text-white px-4 py-2 rounded-xl">

                                Supprimer

                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-6">

            {{ $equipments->links() }}

        </div>

    </div>

</div>

<script>

new Chart(document.getElementById('equipmentChart'), {

    type: 'bar',

    data: {

        labels: ['Disponible','Maintenance','Critique'],

        datasets: [{

            data: [
                {{ $disponibles }},
                {{ $maintenance }},
                {{ $critiques }}
            ]

        }]

    }

});

</script>

</body>
</html>