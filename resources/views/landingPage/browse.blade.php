<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Smafy Library</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class=" bg-slate-100" x-data="{ sidebar_open: false }">
    @include('partials.navbar')
    <div class="px-2 lg:w-[800px] w-full lg:mx-auto">
        <div class="py-5 px-3  bg-white  rounded-md mt-5 shadow-md">
            <h1 class="text-center lg:text-5xl text-2xl text-amber-400 font-bold">Smafy Library</h1>
            <p class="text-center text-slate-600 mt-2">Apa yang ingin anda ajarkan hari ini?</p>
            <div class="flex justify-center">
                <div class="form-control mt-3">
                    <form action="" method="GET" autocomplete="off">
                        <div class="input-group">
                            <input type="text" name="s" placeholder="Cari topik"
                                class="input input-bordered lg:w-[500px]" value="{{ Request::get('s') }}" />
                            <button type="submit" class="btn btn-square bg-amber-400 border-none hover:bg-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-4">
            @if (Request::get('s'))
                <div class="flex gap-5 font-bold text-slate-600 mb-4 flex-wrap lg:text-base text-xs">
                    <div>Pencarian : {{ Request::get('s') }} </div>
                    <div>•</div>
                    <div>Hasil : {{ $packages->total() }}</div>
                </div>
            @endif

            @forelse ($packages as $package)
                <a href="/preview/{{ $package->slug }}" data-slug="{{ $package->slug }}"
                    class="rounded-md mb-3  px-3 py-5 hover:shadow-xl flex gap-5 bg-white">
                    <div class="">
                        <img src="{{ asset('image/logo.png') }}" alt="thumbnail" class="w-[50px]">
                    </div>
                    <div class="w-full">
                        <div class="flex gap-2 items-center flex-wrap">
                            <p class="font-semibold text-xl text-slate-700">{{ $package->title }}</p>
                            @if ($package->topic_type == 'materi')
                                <div class="uppercase bg-green-400 px-4 py-1 rounded-lg font-bold text-white text-sm ">
                                    {{ $package->topic_type }}
                                </div>
                            @else
                                <div class="uppercase bg-amber-400 px-4 py-1 rounded-lg font-bold text-white text-sm ">
                                    {{ $package->topic_type }}
                                </div>
                            @endif
                        </div>
                        <p class="text-sm text-slate-500 mt-2 ">{{ $package->description }}</p>
                        <hr class="my-1">
                        <div class="flex gap-7">
                            <div class="text-xs text-slate-600 flex gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                {{ $package->get_user->name }}
                            </div>
                            <div class="text-xs text-slate-600 flex gap-1">
                                {{ count($package->get_slides) }} Slide
                            </div>
                            <div class="text-xs text-slate-600">
                                {{ count($package->get_students) }} Plays
                            </div>
                        </div>
                    </div>
                </a>

            @empty
                <div class="flex justify-center items-center">
                    <img src="{{ asset('image/Empty-amico.svg') }}" alt="not found" class="lg:w-[300px] w-[70%]">
                </div>
                <p class="text-center text-slate-500 text-xs">Item tidak ditemukan</p>
            @endforelse
            @if ($packages->hasPages())
                <div class=" p-4 flex items-center flex-wrap mx-auto justify-center text-xs">
                    <nav aria-label="Page navigation">
                        <ul class="inline-flex">
                            @if ($packages->onFirstPage() == false)
                                <li>
                                    <a
                                        href="{{ route('browse', ['page' => $packages->currentPage() - 1, 's' => Request::get('s')]) }}">
                                        <button
                                            class="h-10 px-5 text-amber-600 transition-colors duration-150 rounded-l-lg focus:shadow-outline hover:bg-amber-100">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </svg></button>
                                    </a>
                                </li>
                            @endif
                            @for ($i = 1; $i <= $packages->lastPage(); $i++)
                                <li>
                                    <a href="{{ route('browse', ['page' => $i, 's' => Request::get('s')]) }}">
                                        <button
                                            class="h-10 px-5  transition-colors duration-150 focus:shadow-outline hover:bg-amber-100 @if ($packages->currentPage() == $i) bg-amber-200  @else text-amber-600 @endif">{{ $i }}</button>
                                    </a>
                                </li>
                            @endfor
                            @if ($packages->lastPage() != $packages->currentPage())
                                <li>
                                    <a
                                        href="{{ route('browse', ['page' => $packages->currentPage() + 1, 's' => Request::get('s')]) }}">
                                        <button
                                            class="h-10 px-5 text-amber-600 transition-colors duration-150  rounded-r-lg focus:shadow-outline hover:bg-amber-100">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </svg></button>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

            @endif
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    @include('partials.landing_footer')
</body>

</html>
