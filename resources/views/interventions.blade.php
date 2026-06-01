<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interventions - OCP Admin</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <style>
        body { font-family: Inter, sans-serif; }
       .card-dark {
            background: linear-gradient(135deg, rgba(30,41,59,0.9) 0%, rgba(15,23,42,0.95) 100%);
            border: 1px solid rgba(148,163,184,0.1);
            backdrop-filter: blur(10px);
        }
       .gradient-border-dark {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #8b5cf6 100%);
            padding: 1px;
            border-radius: 1.5rem;
        }
       .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
       .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5); }
    </style>
</head>

<body class="font-[Inter] bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen text-slate-100">

<div class="min-h-screen p-6 lg:p-10">

    <!-- HEADER -->
    <div class="card-dark rounded-2xl p-6 shadow-2xl mb-8 border-slate-700/50">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">🔧 Interventions</h1>
                <p class="text-slate-400 mt-2">Gestion des interventions de maintenance</p>
            </div>
            <a href="/dashboard" class="h-12 px-6 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 flex items-center justify-center font-semibold transition border-slate-600">
                ← Dashboard
            </a>
        </div>
    </div>

    <!-- FORM AJOUT -->
    <div class="card-dark rounded-3xl p-8 shadow-2xl mb-8 card-hover border-slate-700/50">
        <h2 class="text-2xl font-bold mb-6 text-white flex items-center gap-3">
            <i data-lucide="plus-circle" class="w-7 h-7 text-sky-400"></i>
            Ajouter Intervention
        </h2>

        <form method="POST" action="/interventions" class="grid gap-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Maintenance</label>
                <select name="maintenance_id" class="w-full bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition" required>
                    <option value="" disabled selected>Choisir une maintenance...</option>
                    @foreach($maintenances as $m)
                    <option value="{{ $m->id }}">
                        Maintenance #{{ $m->id }} - {{ $m->equipment->name?? 'N/A' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Technicien</label>
                <input type="text" name="technicien" placeholder="Nom du technicien"
                    class="w-full bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Date d'intervention</label>
                <input type="date" name="date_intervention"
                    class="w-full bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">État</label>
                <select name="etat" class="w-full bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition" required>
                    <option value="planifiee">Planifiée</option>
                    <option value="en cours">En cours</option>
                    <option value="terminee">Terminée</option>
                </select>
            </div>

            <button class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white rounded-2xl p-4 font-bold transition shadow-lg flex items-center justify-center gap-2 mt-4">
                <i data-lucide="save" class="w-5 h-5"></i>
                Ajouter Intervention
            </button>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();
});
</script>

</body>
</html>