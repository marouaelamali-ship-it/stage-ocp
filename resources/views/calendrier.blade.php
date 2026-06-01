<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <style>
        body { font-family: Poppins, sans-serif; }
        /* Style FullCalendar bach yji m3a design dyalna */
        .fc-toolbar-title { font-size: 1.5rem !important; font-weight: 700 !important; color: #1e293b; }
        .fc-button { background: #2563eb !important; border: none !important; border-radius: 0.5rem !important; padding: 0.5rem 1rem !important; }
        .fc-button:hover { background: #1d4ed8 !important; }
        .fc-daygrid-day:hover { background: #f8fafc !important; }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">

<div class="min-h-screen p-6">

    <!-- HEADER N9I BLANC B7AL LISTE MAINTENANCES -->
    <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-lg mb-6">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold">
                    📅 Calendrier des maintenances
                </h1>
                <p class="text-slate-300 mt-2">
                    Vue mensuelle des interventions programmées
                </p>
            </div>
            <div class="flex gap-3">
                <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-xl font-medium transition">
                    Dashboard
                </a>
                <a href="/mListe" class="bg-green-600 hover:bg-green-700 px-4 py-3 rounded-xl font-medium transition">
                    Liste
                </a>
            </div>
        </div>
    </div>

    <!-- STATS SGHAR LFO9 -->
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-gray-500 dark:text-gray-400">Total événements</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $maintenances->count() }}</h2>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-green-600">Terminées</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $maintenances->where('status','termine')->count() }}</h2>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow border-gray-200 dark:border-gray-700">
            <p class="text-yellow-600">En cours</p>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $maintenances->where('status','en cours')->count() }}</h2>
        </div>
    </div>

    <!-- CALENDAR CARD -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border-gray-200 dark:border-gray-700 p-6">
        <div id="calendar"></div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        height: 'auto',
        eventColor: '#2563eb',
        eventTextColor: '#fff',
        dayMaxEvents: 3,
        events: [
            @foreach($maintenances as $m)
            {
                title: '{{ $m->equipment->name ?? "Equipement" }} - {{ ucfirst($m->status) }}',
                start: '{{ $m->created_at->format("Y-m-d") }}',
                backgroundColor: '{{ $m->status == "termine"? "#10b981" : ($m->status == "en cours"? "#f59e0b" : "#ef4444") }}',
                borderColor: '{{ $m->status == "termine"? "#10b981" : ($m->status == "en cours"? "#f59e0b" : "#ef4444") }}'
            },
            @endforeach
        ]
    });

    calendar.render();
});
</script>

</body>
</html>