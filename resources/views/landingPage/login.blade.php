<!doctype html>
<html>

<head>
    @include('partials.head')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.0.0/dist/cdn.min.js"></script>
    <title>Masuk</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="relative" x-data="{ sidebar_open: false }">
    {{-- navbar --}}
    @include('partials.navbar')
    <div x-show="sidebar_open" x-cloak class="absolute w-full h-screen bg-black opacity-50">

    </div>
    {{-- page --}}
    <div class="container mx-auto">
        <section class="">
            <div class="container px-6 py-12 h-full">
                <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                    <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                        <img src="{{ asset('image/login.svg') }}" class="w-full" alt="Phone image" />
                    </div>
                    <div class="md:w-8/12 lg:w-5/12 lg:ml-20 min-[200px]:w-11/12 rounded-lg shadow-lg p-5 mb-5">
                        <h1 class="font-bold text-slate-500 text-3xl mb-5">Masuk</h1>
                        @if (session()->has('failed'))
                            <div class="alert alert-error mb-5">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ session('failed') }}</span>
                                </div>
                            </div>
                        @endif
                        @foreach ($errors->all() as $item)
                            <div class="alert alert-error mb-5">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $item }}</span>
                                </div>
                            </div>
                        @endforeach
                        <form action="" method="POST">
                            @csrf
                            <!-- Email input -->
                            <div class="mb-6">
                                <input name="email" value="{{ old('email') }}"
                                    class="form-control block w-full px-4 py-2 font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-amber-600 focus:outline-none"
                                    placeholder="Alamat email" />
                            </div>

                            <!-- Password input -->
                            <div class="mb-6">
                                <input name="password" type="password"
                                    class="form-control block w-full px-4 py-2  font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-amber-600 focus:outline-none"
                                    placeholder="Kata sandi" />
                            </div>




                            <!-- Submit button -->
                            <button type="submit"
                                class="inline-block px-7 py-3 bg-amber-400 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-amber-700 hover:shadow-lg focus:bg-amber-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                                data-mdb-ripple="true" data-mdb-ripple-color="light">Masuk</button>
                            <h1 class="mt-3 text-center">Belum daftar? <a href="/register" class="text-amber-500">
                                    Klik </a> disini untuk daftar </h1>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.landing_footer')
    </div>

</html>
