<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCP Login</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] overflow-hidden">

<div class="w-full h-screen flex flex-col">

    <!-- NAVBAR -->
    <div class="h-[85px] bg-white flex items-center justify-between px-10 border-b border-gray-100">

        <!-- LEFT -->
        <div class="flex items-center gap-14">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <div class="w-14 h-14 rounded-full border-2 border-[#18A558] flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-[#18A558]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 2l2.4 4.8L20 8l-4 3.9L17 18l-5-2.7L7 18l1-6.1L4 8l5.6-1.2L12 2z"/>

                    </svg>

                </div>

                <div>
                    <h1 class="text-[#18A558] font-bold text-3xl">
                        OCP
                    </h1>
                </div>

            </div>

            <!-- MENU -->
        <div class="hidden xl:flex items-center gap-10 text-[#18A558] font-semibold">

            <!-- A PROPOS -->
            <div class="relative group">

                <a href="#" class="hover:text-[#00C853] transition">
                    À propos
                </a>

                <div class="absolute top-full left-0 mt-4 hidden group-hover:block w-80 bg-white rounded-2xl shadow-2xl p-6 z-50">

                    <h3 class="text-[#18A558] font-bold text-lg mb-4">
                        À propos du Groupe OCP
                    </h3>

                    <ul class="space-y-3 text-gray-700">

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Notre raison d'être
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Notre vision
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Notre stratégie
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Notre leadership
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Notre parcours
                        </li>

                    </ul>

                </div>

            </div>

            <!-- NOS ACTIVITES -->
            <div class="relative group">

                <a href="#" class="hover:text-[#00C853] transition">
                    Nos activités
                </a>

                <div class="absolute top-full left-0 mt-4 hidden group-hover:block w-80 bg-white rounded-2xl shadow-2xl p-6 z-50">

                    <h3 class="text-[#18A558] font-bold text-lg mb-4">
                        Nos activités
                    </h3>

                    <ul class="space-y-3 text-gray-700">

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Extraction minière
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Production d'engrais
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Innovation et développement
                        </li>

                        <li class="hover:text-[#18A558] cursor-pointer">
                            Logistique et distribution
                        </li>

                    </ul>

                </div>

            </div>

            <!-- DEVELOPPEMENT DURABLE -->
            <div class="relative group">

                <a href="#" class="hover:text-[#00C853] transition">
                    Développement durable
                </a>

                <div class="absolute top-full left-0 mt-4 hidden group-hover:block w-80 bg-white rounded-2xl shadow-2xl p-6 z-50">

                    <ul class="space-y-3 text-gray-700">

                        <li>Énergie verte</li>
                        <li>Gestion de l'eau</li>
                        <li>Agriculture durable</li>
                        <li>Impact social</li>

                    </ul>

                </div>

            </div>

            <!-- INVESTISSEURS -->
            <div class="relative group">

                <a href="#" class="hover:text-[#00C853] transition">
                    Investisseurs
                </a>

                <div class="absolute top-full left-0 mt-4 hidden group-hover:block w-80 bg-white rounded-2xl shadow-2xl p-6 z-50">

                    <ul class="space-y-3 text-gray-700">

                        <li>Rapports financiers</li>
                        <li>Résultats annuels</li>
                        <li>Gouvernance</li>
                        <li>Publications</li>

                    </ul>

                </div>

            </div>

    <!-- MEDIAS -->
    <div class="relative group">

        <a href="#" class="hover:text-[#00C853] transition">
            Médias
        </a>

        <div class="absolute top-full left-0 mt-4 hidden group-hover:block w-80 bg-white rounded-2xl shadow-2xl p-6 z-50">

            <ul class="space-y-3 text-gray-700">

                <li>Actualités</li>
                <li>Communiqués</li>
                <li>Événements</li>
                <li>Galerie photos</li>

            </ul>

        </div>

    </div>

</div>
</div>


        <!-- RIGHT -->
        <div class="flex items-center gap-8">

            <div class="relative group">

                <a href="#" class="text-[#18A558] font-semibold">
                    Contact
                </a>

                <div class="hidden group-hover:block absolute top-10 right-0 w-72 bg-white rounded-2xl shadow-2xl p-5 z-50">

                    <h3 class="font-bold text-[#18A558] text-lg mb-3">
                        Contact OCP
                    </h3>

                    <p class="text-gray-700 mb-2">
                        📞 +212 5 23 53 53 53
                    </p>

                    <p class="text-gray-700 mb-2">
                        ✉️ contact@ocpgroup.ma
                    </p>

                    <p class="text-gray-700">
                        📍 Casablanca, Maroc
                    </p>

                </div>

            </div>

            <div class="relative group">

                <div class="w-12 h-12 rounded-full border-2 border-[#18A558] flex items-center justify-center text-[#18A558] font-bold cursor-pointer">
                    FR
                </div>

                <div class="hidden group-hover:block absolute top-14 right-0 bg-white rounded-2xl shadow-xl p-4 w-40 z-50">

                    <p class="py-2 hover:text-[#18A558] cursor-pointer">
                        🇫🇷 Français
                    </p>

                    <p class="py-2 hover:text-[#18A558] cursor-pointer">
                        🇬🇧 English
                    </p>

                    <p class="py-2 hover:text-[#18A558] cursor-pointer">
                        🇲🇦 العربية
                    </p>

                </div>

            </div>

            <!-- SEARCH -->
            <div class="relative group">

                <button class="text-[#18A558]">

                    🔍

                </button>

                <div class="hidden group-hover:block absolute top-12 right-0 bg-white p-4 rounded-2xl shadow-2xl w-80 z-50">

                    <input
                        type="text"
                        placeholder="Rechercher..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none"
                    >

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="flex flex-1">

        <!-- IMAGE SIDE -->
        <div class="w-[68%] relative">

            <img
                src="{{ asset('images/login-bg.png') }}"
                class="w-full h-full object-cover"
            >

            <!-- OVERLAY -->
            <div class="absolute inset-0 bg-black/55"></div>

            <!-- TEXT -->
            <div class="absolute inset-0 flex flex-col justify-center px-28 text-white">

                <p class="uppercase tracking-[5px] text-[#00D26A] font-semibold mb-6">
                    ESPACE COLLABORATEURS
                </p>

                <h1 class="text-7xl font-extrabold leading-tight mb-8">
                    Excellence & Confort
                    <br>
                    au cœur de l'OCP
                </h1>

                <p class="text-2xl text-gray-200 max-w-3xl leading-10">
                    Bienvenue à nouveau sur votre interface premium.
                    Une expérience hôtelière d’exception vous attend.
                </p>

            </div>

        </div>

        <!-- LOGIN SIDE -->
        <div class="w-[32%] bg-[#040B1B] flex items-center justify-center px-14">

            <div class="w-full max-w-md">

                <h1 class="text-white text-6xl font-bold mb-4">
                    Bienvenue
                </h1>

                <p class="text-gray-400 text-lg mb-16">
                    Identifiez-vous pour accéder à votre espace.
                </p>

                <!-- FORM -->
                @if ($errors->any())

                    <div class="bg-red-500/20 border border-red-500 text-red-300 p-4 rounded-2xl mb-6">

                        {{ $errors->first() }}

                    </div>

                @endif

    
            <form action="/login"
                    method="POST"
                    class="space-y-8">

                    @csrf
                    
                    <!-- EMAIL -->
                    <div>

                        <label class="text-gray-300 uppercase text-sm tracking-[3px] block mb-4">
                            Email professionnel
                        </label>

                        <div class="h-16 rounded-2xl bg-[#0E1628] border border-[#1D2940] px-5 flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-500 mr-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 12H8m8 0H8m8 4H8m8-8H8m-2 12h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                            </svg>

                            <input
                                type="email"
                                name="email"
                                placeholder="prenom.nom@ocpgroup.ma"
                                class="bg-transparent outline-none text-white w-full"
                            >

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <label class="text-gray-300 uppercase text-sm tracking-[3px] block mb-4">
                            Mot de passe
                        </label>

                        <div class="h-16 rounded-2xl bg-[#0E1628] border border-[#1D2940] px-5 flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-500 mr-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zm0 0v2m-6 6h12a2 2 0 002-2v-3a6 6 0 10-12 0v3a2 2 0 002 2z"/>

                            </svg>

                            <input
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                class="bg-transparent outline-none text-white w-full"
                            >

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full h-16 rounded-2xl bg-[#00C853] hover:bg-[#00b84c] transition text-white text-2xl font-semibold shadow-lg shadow-green-500/30">

                        Se connecter

                    </button>

                    <!-- REGISTER -->
                    <div class="text-center pt-4">

                        <span class="text-gray-500">
                            Première fois ?
                        </span>

                        <a href="#" class="text-[#00D26A] font-semibold ml-2">
                            Créer un compte
                        </a>

                    </div>

                </form>

            


                <!-- FOOTER -->
                <div class="mt-20 text-center text-gray-600 text-sm">
                    © 2026 OCP Group - Tous droits réservés
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>