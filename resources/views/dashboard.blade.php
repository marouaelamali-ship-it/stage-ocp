<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCP Dashboard</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#F5F7FA] font-[Poppins]">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <div class="w-72 bg-[#071120] text-white flex flex-col">

        <!-- LOGO -->
        <div class="h-24 flex items-center px-8 border-b border-gray-800">

            <h1 class="text-3xl font-bold text-[#00C853]">
                OCP
            </h1>

        </div>

        <!-- MENU -->
        <div class="flex-1 py-8">

            <a href="#" class="flex items-center gap-4 px-8 py-4 bg-[#0E1B31] border-r-4 border-[#00C853] text-[#00C853]">

                <span class="text-lg font-medium">
                    Dashboard
                </span>

            </a>

            <a href="#" class="flex items-center gap-4 px-8 py-4 hover:bg-[#0E1B31] transition">

                <span class="text-lg">
                    Maintenances
                </span>

            </a>

            <a href="#" class="flex items-center gap-4 px-8 py-4 hover:bg-[#0E1B31] transition">

                <span class="text-lg">
                    Equipments
                </span>

            </a>

            <a href="#" class="flex items-center gap-4 px-8 py-4 hover:bg-[#0E1B31] transition">

                <span class="text-lg">
                    Categories
                </span>

            </a>

            <a href="#" class="flex items-center gap-4 px-8 py-4 hover:bg-[#0E1B31] transition">

                <span class="text-lg">
                    Technicians
                </span>

            </a>

        </div>

    </div>

    <!-- MAIN -->
    <div class="flex-1 overflow-y-auto">

        <!-- TOPBAR -->
        <div class="h-24 bg-white flex items-center justify-between px-10 shadow-sm">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500">
                    Welcome back Admin 👋
                </p>
            </div>

            <div class="flex items-center gap-5">

                <div class="text-right">
                    <h2 class="font-semibold text-gray-800">
                        Admin OCP
                    </h2>

                    <p class="text-sm text-gray-500">
                        Administrator
                    </p>
                </div>

                <div class="w-14 h-14 rounded-full bg-[#00C853]"></div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-10">

            <!-- CARDS -->
            <div class="grid grid-cols-4 gap-8 mb-10">

                <!-- CARD -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">

                    <p class="text-gray-500 mb-4">
                        Total Maintenances
                    </p>

                    <h1 class="text-5xl font-bold text-[#071120]">
                        124
                    </h1>

                </div>

                <!-- CARD -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">

                    <p class="text-gray-500 mb-4">
                        Equipments
                    </p>

                    <h1 class="text-5xl font-bold text-[#071120]">
                        58
                    </h1>

                </div>

                <!-- CARD -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">

                    <p class="text-gray-500 mb-4">
                        Technicians
                    </p>

                    <h1 class="text-5xl font-bold text-[#071120]">
                        16
                    </h1>

                </div>

                <!-- CARD -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">

                    <p class="text-gray-500 mb-4">
                        Pending Tasks
                    </p>

                    <h1 class="text-5xl font-bold text-red-500">
                        9
                    </h1>

                </div>

            </div>

            <!-- TABLE -->
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <div class="p-8 border-b">

                    <h2 class="text-2xl font-bold text-gray-800">
                        Recent Maintenances
                    </h2>

                </div>

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left py-5 px-8 text-gray-600">
                                Equipment
                            </th>

                            <th class="text-left py-5 px-8 text-gray-600">
                                Technician
                            </th>

                            <th class="text-left py-5 px-8 text-gray-600">
                                Status
                            </th>

                            <th class="text-left py-5 px-8 text-gray-600">
                                Date
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr class="border-t">

                            <td class="py-6 px-8">
                                Conveyor Belt
                            </td>

                            <td class="py-6 px-8">
                                Ahmed
                            </td>

                            <td class="py-6 px-8">

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                    Completed
                                </span>

                            </td>

                            <td class="py-6 px-8">
                                13 May 2026
                            </td>

                        </tr>

                        <tr class="border-t">

                            <td class="py-6 px-8">
                                Hydraulic Pump
                            </td>

                            <td class="py-6 px-8">
                                Youssef
                            </td>

                            <td class="py-6 px-8">

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">
                                    Pending
                                </span>

                            </td>

                            <td class="py-6 px-8">
                                12 May 2026
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>