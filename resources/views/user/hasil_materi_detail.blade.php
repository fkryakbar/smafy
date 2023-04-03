<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Nilai siswa</title>
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
                                <a href="/dashboard/hasil">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Hasil
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/hasil/{{ $package->slug }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    {{ $package->title }}
                                </a>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                {{ $siswa->name }}
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Jawaban dari {{ $siswa->name }}
                        </h2>
                    </div>
                    <div class="mt-3 flex lg:justify-start justify-between px-2 gap-2">
                        <div>
                            @if ($siswa->score >= 80)
                                <p class="font-bold text-green-600 ">Skor : {{ $siswa->score }}</p>
                            @endif
                            @if ($siswa->score < 80 && $siswa->score >= 50)
                                <p class="font-bold text-yellow-600 ">Skor : {{ $siswa->score }}</p>
                            @endif
                            @if ($siswa->score < 50)
                                <p class="font-bold text-red-600 ">Skor : {{ $siswa->score }}</p>
                            @endif
                        </div>
                        @if ($package->topic_type == 'kuis')
                            @php
                                $menit = floor($siswa->time_left / 60);
                                $detik = $siswa->time_left % 60;
                                if ($menit < 10) {
                                    $menit = '0' . $menit;
                                }
                                if ($detik < 10) {
                                    $detik = '0' . $detik;
                                }
                            @endphp
                            <div class="hidden lg:block">
                                •
                            </div>

                            <div>
                                <p class="font-bold">Sisa Waktu {{ $menit }}:{{ $detik }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px] ">
                        <div class="overflow-x-auto">
                            <table class="table w-full min-[200px]:text-xs">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama slide</th>
                                        <th>Jawaban siswa</th>
                                        <th>Jawaban Jawaban benar</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <th>{{ $item->title }}</th>
                                            <th>{{ $item->answer }}</th>
                                            <th>{{ $item->correct_answer }}</th>
                                            <th>
                                                @if ($item->result == 0)
                                                    <span class="badge bg-red-400 border-none">Salah</span>
                                                @else
                                                    <span class="badge bg-green-400 border-none">Benar</span>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                        <div class="text-center">
                                            Belum ada jawaban
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
