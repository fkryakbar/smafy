<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>{{ $lesson->title }} | Ayo Mulai!</title>
    <meta name="description" content="{{ $lesson->description }}">
</head>

<body>
    <div class="">
        <div class="flex justify-center min-h-screen relative bg-slate-50">
            {{-- navbar --}}
            <div id="coba" class="navbar fixed top-0 w-full bg-amber-400 shadow-xl z-[1000]">
                <div class="navbar-start">
                    <div class="tooltip tooltip-bottom" data-tip="{{ $lesson->title }}">
                        <p
                            class="font-bold text-white normal-case min-[600px]:text-xl min-[600px]:w-[400px] min-[200px]:w-[200px] min-[200px]:text-sm truncate text-left transition-all ">
                            {{ $lesson->title }}</p>
                    </div>
                </div>
                <div class="navbar-center hidden lg:flex">
                </div>

                <div class="navbar-end">
                    <a class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"
                        href="https://docs.smafy.my.id/siswa/menyelesaikan-aktivitas" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </a>
                    <button id="exit" class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"><i
                            class="bi bi-box-arrow-right text-2xl"></i></button>
                </div>
            </div>
            {{-- endnavbar --}}
            <div class="mt-20 mb-20">
                @if (
                    !session()->has($lesson->slug) ||
                        $lesson->accept_responses == 0 ||
                        ($lesson->deadline_time > 0 ? $lesson->deadline_time < time() : false))
                    <div class="p-8 shadow-lg rounded-xl text-center bg-white mx-4 max-w-[400px]">

                        @if ($lesson->accept_responses == 0)
                            <h1 class="text-3xl font-bold text-amber-500">Respons ditutup</h1>
                            <h3 class="text-1xl text-gray-500">Saat ini tidak bisa menerima respons</h3>
                            <img class="w-full" src="{{ asset('image/404 Error-rafiki.svg') }}" alt="Error">
                            <a href="/"
                                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-700 text-white">Kembali</a>
                        @endif
                        @if ($lesson->deadline_time > 0 ? $lesson->deadline_time < time() : false)
                            <h1 class="text-3xl font-bold text-amber-500">Waktu Pengerjaan Habis</h1>
                            <img class="w-full" src="{{ asset('image/Time management-rafiki.svg') }}" alt="Error">
                            <a href="/"
                                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-700 text-white">Kembali</a>
                        @endif
                    </div>
                @else
                    @php
                        $progress = $participant->progress();
                    @endphp
                    <div class="mx-4 mt-4 max-w-[400px]">
                        @if ($lesson->deadline_time > 0)
                            <div class="flex gap-2 text-slate-500 text-xs mb-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div>
                                    <p>
                                        Batas Waktu pengerjaan sampai
                                    </p>
                                    <p>
                                        {{ date('d-m-Y H:i', $lesson->deadline_time) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-col items-center justify-center mb-5 p-4 rounded-lg bg-white drop-shadow">
                            <h1 class="mb-2 font-bold text-gray-700">Halo! {{ session($lesson->slug)['name'] }}
                            </h1>
                            <p class="text-gray-600 text-sm mb-2">Progress Belajar kamu</p>
                            <div class="radial-progress text-green-500"
                                style="--value:{{ $progress }}; --size:8rem">{{ $progress }}%</div>
                            @if ($lesson->show_final_score == 1)
                                <p class="mt-2 text-gray-500 text-sm">
                                    Skor Kamu saat ini
                                </p>
                                <p class="font-bold text-amber-500">{{ $participant->score_total() }}</p>
                            @endif
                            <p class="mt-5 text-center text-sm">Klik Aktivitas di bawah untuk lanjut belajar</p>
                        </div>
                        <h3 class="text-gray-500 font-semibold ">Aktivitas</h3>
                        <div class="grid grid-cols-1 gap-2 mt-2 ">
                            @foreach ($lesson->sublessons as $sublesson)
                                <div
                                    class="bg-white w-full drop-shadow p-3 rounded-lg hover:scale-105 transition-all cursor-pointer">
                                    <div class="flex gap-2 items-center justify-between">
                                        <div class="flex gap-2 items-center">
                                            @if ($sublesson->sublesson_type == 'materi')
                                                <div
                                                    class="rounded-full bg-green-500 p-1 text-white flex justify-center items-center w-10 h-10">
                                                    @if (isset(session($lesson->slug)['finished_sublessons'][$sublesson->slug]) && $lesson->show_final_score == 1)
                                                        <p class="font-bold text-sm">
                                                            {{ $participant->sublesson_result($sublesson->slug)->score_total }}
                                                        </p>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                            @else
                                                <div
                                                    class="rounded-full bg-amber-500 p-1 text-white flex justify-center items-center w-10 h-10">
                                                    @if (isset(session($lesson->slug)['finished_sublessons'][$sublesson->slug]) && $lesson->show_final_score == 1)
                                                        <p class="font-bold text-sm">
                                                            {{ $participant->sublesson_result($sublesson->slug)->score_total }}
                                                        </p>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-w-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                                        </svg>
                                                    @endif
                                                </div>
                                            @endif
                                            <div class="">
                                                @if ($sublesson->sublesson_type == 'materi')
                                                    <div
                                                        class="bg-green-500 px-2 py-1 rounded-lg text-white text-xs w-fit font-semibold">
                                                        Materi
                                                    </div>
                                                @else
                                                    <div
                                                        class="bg-amber-500 px-2 py-1 rounded-lg text-white text-xs w-fit font-semibold">
                                                        Kuis
                                                    </div>
                                                @endif
                                                <p class="text-gray-500 font-semibold ">{{ $sublesson->title }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-center">
                                                @if (isset(session($lesson->slug)['finished_sublessons'][$sublesson->slug]))
                                                    <a href="/play/{{ $lesson->slug }}/{{ $sublesson->slug }}"
                                                        class="bg-green-500 hover:bg-green-800 p-2 rounded-full  text-xs font-semibold text-white ">Selesai</a>
                                                @else
                                                    <a href="/play/{{ $lesson->slug }}/{{ $sublesson->slug }}"
                                                        class="bg-amber-500 hover:bg-amber-800 p-2 rounded-full  text-xs font-semibold text-white ">Buka</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($progress == 100 && $lesson->allow_to_restart_lesson == 1)
                            <div class="flex justify-center items-center mt-5">
                                <button onclick="restart()"
                                    class="p-2 bg-red-500 text-white font-semibold rounded-lg text-xs flex gap-2 items-center transition-all active:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    <p>
                                        Mulai
                                        ulang
                                    </p>
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

<script>
    const exit_button = document.getElementById('exit')
    exit_button.addEventListener('click', function() {
        Swal.fire({
            title: 'Keluar?',
            text: "Yakin mau keluar sekarang?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Keluar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/";
            }
        })
    })

    function restart() {
        Swal.fire({
            title: "Mulai ulang?",
            text: "Riwayat pengerjaan saat ini akan hilang",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Mulai ulang",
            cancelButtonText: "Kembali",
        }).then((result) => {
            if (result.isConfirmed) {
                sessionStorage.clear();
                window.location.href =
                    `/play/{{ $lesson->slug }}/restart`;
            }
        });
    }
</script>

</html>
