<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Smafy</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="relative" x-data="{ sidebar_open: false }">
    @include('partials.navbar')
    <div x-show="sidebar_open" x-cloak class="absolute w-full h-screen bg-black opacity-50">

    </div>
    <section class=" mt-20 w-[90%] lg:w-[70%] mx-auto">
        <div class="lg:flex gap-4">
            <div class="basis-[50%] flex items-center">
                <div class="">
                    <h1 class="text-amber-400 text-6xl font-bold text-center lg:text-left">Smafy</h1>
                    <p class="mt-1 text-cyan-500 text-center lg:text-left">Apa itu Smafy?</p>
                    <p class="mt-3 text-slate-600 text-center lg:text-left ">Smafy digunakan sebagai alat bantu guru di
                        kelas untuk merancang
                        pembelajaran yang Interaktif, Menarik, dan Efektif berbasis web yang dapat digunakan kapan saja
                        dan dimana saja.</p>
                    <div class="mt-4 lg:block flex justify-center gap-2">
                        <a href="/register" class="btn bg-amber-400 hover:bg-amber-600 border-0 px-10">Daftar</a>
                        <a href="https://smafy.my.id/play/rsEZ-dyh-xAx"
                            class="btn bg-cyan-500 hover:bg-cyan-800 border-0 px-10">SPLDV</a>
                        {{-- <a href="https://smafy.my.id/play/rsEZ-dyh-xAx" target="_blank"
                            class="btn bg-slate-600 hover:bg-slate-800 border-0 px-10">Demo</a> --}}
                    </div>
                </div>
            </div>
            <!-- The button to open modal -->

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="try-demo" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <label for="try-demo" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    <h3 class="font-bold text-lg">Coba Demo dari Smafy!</h3>
                    <p class="mt-5 text-center">Coba smafy dari dua mode di bawah ini</p>
                    <div class="mt-3 flex justify-center gap-2">
                        <a target="_blank" href="/learn/RKuL-7Po-6JI"
                            class="btn bg-amber-400 hover:bg-amber-800 border-0 px-10">Materi</a>
                        <a target="_blank" href="/learn/ijaq-Iiz-usZ"
                            class="btn bg-green-400 hover:bg-green-800 border-0 px-10">Kuis</a>
                        <div class="modal-action">
                            <div class="modal-action">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="basis-[50%] w-full">
                <img class="w-full mt-5" src="{{ asset('image/Education-pana.svg') }}" alt="">
            </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fbbf24" fill-opacity="1"
            d="M0,128L48,144C96,160,192,192,288,202.7C384,213,480,203,576,181.3C672,160,768,128,864,101.3C960,75,1056,53,1152,42.7C1248,32,1344,32,1392,32L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    <section class="bg-amber-400">
        <div class="w-[90%] lg:w-[70%] mx-auto">
            <div class="lg:flex gap-2">
                <div class="basis-[50%] flex items-center">
                    <div>
                        <p class="text-[#313715] lg:text-left text-center">Fitur Smafy</p>
                        <h1 class="text-[#D16014] text-4xl font-bold text-center lg:text-left">Apa Saja yang bisa
                            dilakukan
                            oleh
                            Smafy?</h1>
                        <p class="mt-3 text-[#361134] text-center lg:text-left ">Smafy saat ini tersedia dalam platform
                            web yang dapat diakses kapan saja dan dimana saja. Apa saja sih fitur yang dapat digunakan
                            dalam Smafy?</p>
                    </div>
                </div>
                <div class="basis-[50%] mt-10 lg:mt-0">
                    <div class="flex flex-wrap gap-5  lg:w-[527px]">
                        <div class="lg:w-60 w-full h-fit bg-white p-5 rounded-lg shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
                                <path
                                    d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                                <path
                                    d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208zM6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z" />
                            </svg>
                            <h1 class="font-bold mt-3 text-amber-400">Dapat di Kostumisasi</h1>
                            <p>
                                Guru dapat membuat dan mengubah sendiri materi pembelajaran maupun latihan soal yang
                                diinginkan
                            </p>
                        </div>
                        <div class="lg:w-60 w-full h-fit bg-white lg:mt-8 p-5 rounded-lg shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-journal-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                <path
                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                            </svg>
                            <h1 class="font-bold mt-3 text-amber-400">Materi Pembelajaran</h1>
                            <p>
                                Guru dapat membuat sendiri materi pembelajaran yang diinginkan, dan siswa dapat
                                mempelajarinya di dalam Smafy
                            </p>
                        </div>
                        <div class="lg:w-60 w-full h-fit bg-white p-5 rounded-lg shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                                <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z" />
                            </svg>
                            <h1 class="font-bold mt-3 text-amber-400">Latihan Soal</h1>
                            <p>
                                Guru dapat membuat sendiri latihan soal berupa pilihan ganda dan isian
                            </p>
                        </div>
                        <div class="lg:w-60 w-full h-fit bg-white lg:mt-8 p-5 rounded-lg shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-list-ol" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338v.041zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635V5z" />
                            </svg>
                            <h1 class="font-bold mt-3 text-amber-400">Menskor Jawaban</h1>
                            <p>
                                Guru dapat melihat hasil tiap individu siswa secara realtime melalui dashboard
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fbbf24" fill-opacity="1"
            d="M0,64L80,96C160,128,320,192,480,197.3C640,203,800,149,960,133.3C1120,117,1280,139,1360,149.3L1440,160L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
    </svg>
    @include('partials.landing_footer')
    <script>
        @if (session()->has('msg'))
            Swal.fire(
                'Success!',
                '{{ session('msg') }}',
                'success'
            )
        @endif
    </script>
</body>

</html>
