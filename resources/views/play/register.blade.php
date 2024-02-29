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
                <div class="p-8 shadow-lg rounded-xl text-center bg-white mx-4 max-w-[400px]">
                    @if ($lesson->accept_responses == 0)
                        <h1 class="text-3xl font-bold text-amber-500">Respons ditutup</h1>
                        <h3 class="text-1xl text-gray-500">Saat ini tidak bisa menerima respons</h3>
                        <img class="w-full" src="{{ asset('image/404 Error-rafiki.svg') }}" alt="Error">
                        <a href="/" class="btn btn-sm bg-amber-400 border-none hover:bg-amber-700">Kembali</a>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline text-amber-600 h-6 w-6 " fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h1 class="text-3xl font-bold text-amber-500">Masukkan nama kamu</h1>
                        <h3 class="text-1xl font-semibold text-gray-500">Sebelum melanjutkan ke aktivitas</h3>
                        @if ($errors->any())
                            @foreach ($errors->all() as $item)
                                <div class="alert alert-error shadow-lg mt-3">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form action="" method="post" autocomplete="none">
                            @csrf
                            <div class="text-center pt-3">
                                <input type="text" placeholder="Nama" name="name"
                                    class="input w-full  input-bordered m-3" />
                                <input type="text" placeholder="Kelas" name="kelas"
                                    class="input w-full  input-bordered m-3" />
                            </div>
                            <button type="submit"
                                class="btn bg-amber-400 border-none hover:bg-amber-700 text-white">Mulai
                                Kerjakan!</button>
                        </form>
                    @endif
                </div>
                @if ($lesson->accept_responses == 1)
                    <div class="mx-4 mt-4 max-w-[400px]">
                        <h1 class="text-gray-500 font-semibold ">Kamu akan mempelajari</h1>
                        <div class="grid grid-cols-1 gap-2 mt-2 ">
                            @foreach ($lesson->sublessons as $sublesson)
                                <div
                                    class="bg-white w-full drop-shadow p-3 rounded-lg hover:scale-105 transition-all cursor-pointer flex gap-2">
                                    @if ($sublesson->sublesson_type == 'materi')
                                        <div
                                            class="rounded-full bg-green-500 p-1 text-white flex justify-center items-center w-10 h-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                        </div>
                                    @else
                                        <div
                                            class="rounded-full bg-amber-500 p-1 text-white flex justify-center items-center w-10 h-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
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
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
