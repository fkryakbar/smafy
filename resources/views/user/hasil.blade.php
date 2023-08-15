<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Hasil</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    @if (session()->has('msg'))
                        <div class="alert alert-success shadow-sm mt-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('msg') }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="text-sm breadcrumbs mt-3">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                Hasil
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Hasil
                        </h2>
                    </div>
                    <h1 class="mt-6 font-semibold text-gray-600 text-xl">Topik</h1>
                    <div class="bg-white p-3 rounded-md shadow mt-2 min-[500px]:w-full min-[200px]:w-[327px] ">
                        <div class="overflow-x-auto">
                            <table class="table w-full min-[200px]:text-xs">
                                <tbody>
                                    @forelse ($package as $index => $item)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <th>{{ $item->title }}</th>
                                            <th>{{ count($item->get_students) }} Jawaban</th>
                                            @if ($item->topic_type == 'materi')
                                                <th class="uppercase font-bold">
                                                    <div class="badge bg-green-400 border-0">
                                                        {{ $item->topic_type }}
                                                    </div>
                                                </th>
                                            @else
                                                <th class="uppercase font-bold">
                                                    <div class="badge bg-amber-400 border-0">
                                                        {{ $item->topic_type }}
                                                    </div>
                                                </th>
                                            @endif
                                            <th><a href="/dashboard/hasil/{{ $item->slug }}"
                                                    class="btn btn-xs bg-green-500 border-none hover:bg-green-700">Lihat
                                                    nilai</a></th>
                                        </tr>

                                    @empty
                                        <div class="text-center">
                                            Belum ada Hasil
                                        </div>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <h1 class="mt-6 font-semibold text-gray-600 text-xl">Aktivitas</h1>
                    <div class="bg-white p-3 rounded-md shadow mt-2 min-[500px]:w-full min-[200px]:w-[327px] ">
                        <div class="overflow-x-auto">
                            <table class="table w-full min-[200px]:text-xs">
                                <tbody>
                                    @forelse ($collection as $index => $item)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <th>{{ $item->title }}</th>
                                            <th>{{ count($item->students) }} Siswa</th>
                                            <th><a href="/dashboard/result/{{ $item->slug }}"
                                                    class="btn btn-xs bg-green-500 border-none hover:bg-green-700">Lihat
                                                    Hasil</a></th>
                                        </tr>

                                    @empty
                                        <div class="text-center">
                                            Belum ada Hasil
                                        </div>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>



                </div>
            </main>

        </div>

    </div>




</body>

</html>
