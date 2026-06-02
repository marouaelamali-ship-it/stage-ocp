<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Paramètres</title>

@vite('resources/css/app.css')
</head>

<body class="bg-slate-900 text-white min-h-screen p-6">

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between mb-8">

        <h1 class="text-4xl font-bold">
            ⚙️ Paramètres
        </h1>

        <a href="/dashboard"
           class="bg-blue-600 px-5 py-3 rounded-xl">
            Retour Dashboard
        </a>

    </div>

    <div class="bg-slate-800 rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-6">
            Informations Système
        </h2>

        <div class="space-y-4">

            <div>
                <span class="text-gray-400">
                    Application :
                </span>

                OCP Maintenance Manager
            </div>

            <div>
                <span class="text-gray-400">
                    Version :
                </span>

                1.0
            </div>

            <div>
                <span class="text-gray-400">
                    Framework :
                </span>

                Laravel 13
            </div>

            <div>
                <span class="text-gray-400">
                    Base de données :
                </span>

                MySQL
            </div>

        </div>

    </div>

    <div class="bg-slate-800 rounded-2xl p-8 mt-6">

        <h2 class="text-2xl font-bold mb-6">
            Préférences
        </h2>

        <div class="space-y-4">

            <label class="flex gap-3">
                <input type="checkbox" checked>
                Afficher Dashboard
            </label>

            <label class="flex gap-3">
                <input type="checkbox" checked>
                Afficher Calendrier
            </label>

            <label class="flex gap-3">
                <input type="checkbox" checked>
                Afficher Rapports
            </label>

        </div>

    </div>

</div>

</body>
</html>