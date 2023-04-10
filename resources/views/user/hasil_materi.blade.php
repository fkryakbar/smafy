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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                {{ $package->title }}
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-semibold text-gray-700  inline">
                                Daftar siswa, {{ $package->title }}
                            </h2>
                            <a href="/dashboard/hasil/{{ $package->slug }}/export"
                                class="btn btn-sm bg-green-400 hover:bg-green-700 border-0">Export</a>
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6 min-[500px]:w-full min-[200px]:w-[327px] mb-10 ">
                        <div class="overflow-x-auto">
                            <table class="table w-full min-[200px]:text-xs">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Skor</th>
                                        @if ($package->topic_type == 'kuis')
                                            <th>Sisa waktu</th>
                                        @endif
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = count($siswa);
                                        $score_total = 0;
                                    @endphp
                                    @forelse ($siswa as $index => $item)
                                        <tr>
                                            <th>{{ $index + 1 }}</th>
                                            <th>{{ $item->name }}</th>
                                            <th>{{ $item->score }}</th>
                                            @if ($package->topic_type == 'kuis')
                                                @php
                                                    $menit = floor($item->time_left / 60);
                                                    $detik = $item->time_left % 60;
                                                    if ($menit < 10) {
                                                        $menit = '0' . $menit;
                                                    }
                                                    if ($detik < 10) {
                                                        $detik = '0' . $detik;
                                                    }
                                                @endphp
                                                <th>{{ $menit }}:{{ $detik }}</th>
                                            @endif
                                            <th>{{ $item->created_at }}</th>
                                            <th>{{ $item->updated_at }}</th>
                                            @php
                                                $score_total = $score_total + (int) $item->score;
                                            @endphp
                                            <th><a href="/dashboard/hasil/{{ $item->package_id }}/{{ $item->u_id }}"
                                                    class="btn btn-xs bg-green-500 border-none hover:bg-green-700">Lihat
                                                    Jawaban</a>
                                                <button onclick="hapus_jawaban('{{ $item->u_id }}')"
                                                    class="btn btn-xs bg-red-500 border-none hover:bg-red-700">Hapus
                                                    Jawaban</button>
                                            </th>
                                        </tr>
                                    @empty
                                        <div class="text-center">
                                            Belum ada nilai
                                        </div>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        @php
                            
                        @endphp
                        @if ($total > 0)
                            <h1 class="font-bold text-slate-600 mt-4">Skor Rata-rata :
                                {{ round($score_total / $total, 2) }} </h1>
                        @endif
                    </div>



                </div>
            </main>

        </div>

    </div>


    <script>
        function hapus_jawaban(u_id) {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Jawaban yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/hasil/${u_id}/hapus`
                }
            })
        }
    </script>

</body>

</html>
