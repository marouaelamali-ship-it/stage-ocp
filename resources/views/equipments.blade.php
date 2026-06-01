<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
<meta charset="UTF-8">
<title>Ajouter Equipment</title>
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

    <div class="card-dark rounded-2xl p-6 shadow-2xl mb-8 border-slate-700/50">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">➕ Ajouter Equipment</h1>
                <p class="text-slate-400 mt-2">Ajout rapide d'équipement</p>
            </div>
            <a href="/eListe" class="h-12 px-6 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white flex items-center gap-2 font-semibold transition shadow-lg">
                <i data-lucide="list" class="w-5 h-5"></i>
                Voir Liste
            </a>

            <a href="/dashboard" class="h-12 px-6 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 flex items-center justify-center font-semibold transition border-slate-600">
                    ← Dashboard
            </a>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <p class="text-sm text-slate-400 mb-1">Total</p>
                <h1 class="text-4xl font-bold text-white">{{ $totalEquipments?? 0 }}</h1>
            </div>
        </div>
        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <p class="text-sm text-slate-400 mb-1">Disponibles</p>
                <h1 class="text-4xl text-emerald-400 font-bold">{{ $disponibles?? 0 }}</h1>
            </div>
        </div>
        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <p class="text-sm text-slate-400 mb-1">Maintenance</p>
                <h1 class="text-4xl text-amber-400 font-bold">{{ $maintenance?? 0 }}</h1>
            </div>
        </div>
        <div class="gradient-border-dark">
            <div class="card-dark rounded-2xl p-6 card-hover">
                <p class="text-sm text-slate-400 mb-1">Critiques</p>
                <h1 class="text-4xl text-red-400 font-bold">{{ $critiques?? 0 }}</h1>
            </div>
        </div>
    </div>

    @if(auth()->user()->role == 'admin')
    <div class="card-dark rounded-3xl p-8 shadow-2xl card-hover border-slate-700/50">
        <h2 class="text-2xl font-bold mb-6 text-white">Nouvel Equipment</h2>
        <form action="/equipments" method="POST" class="grid gap-5">
            @csrf
            <input type="text" name="name" placeholder="Nom equipment" class="bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500" required>
            <input type="text" name="type" placeholder="Type" class="bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500" required>
            <select name="status" class="bg-slate-800 border-slate-700 p-4 rounded-2xl text-white outline-none focus:border-sky-500" required>
                <option value="Disponible">Disponible</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Critique">Critique</option>
            </select>
            <button class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white rounded-2xl p-4 font-bold transition">Ajouter</button>
        </form>
    </div>
    @endif

</div>
<script>lucide.createIcons();</script>
</body>
</html>