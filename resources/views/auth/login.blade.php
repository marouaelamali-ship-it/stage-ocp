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

                <a href="#">À propos</a>
                <a href="#">Nos activités</a>
                <a href="#">Développement durable</a>
                <a href="#">Investisseurs</a>
                <a href="#">Médias</a>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-8">

            <a href="#" class="text-[#18A558] font-semibold">
                Contact
            </a>

            <div class="w-12 h-12 rounded-full border-2 border-[#18A558] flex items-center justify-center text-[#18A558] font-bold">
                FR
            </div>

            <!-- SEARCH -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-7 h-7 text-[#18A558]"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>

            </svg>

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
                <form action="/dashboard" method="GET" class="space-y-8">

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