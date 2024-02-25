<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Dashboard</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <div class="bg-white p-3 rounded-md shadow mt-6 mb-3">
                        <h2 class="text-2xl font-semibold text-gray-700 ">
                            Dashboard
                        </h2>
                    </div>
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full  ">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-400 ">
                                    Topik
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    0
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
                            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full ">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-400 ">
                                    Total siswa
                                </p>
                                <p class="text-lg font-semibold text-gray-700 ">
                                    0
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
