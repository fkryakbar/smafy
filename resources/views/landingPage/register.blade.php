<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.0.0/dist/cdn.min.js"></script>
    <title>Daftar</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="relative" x-data="{ sidebar_open: false }">
    @include('partials.navbar')
    <section class=" my-10">
        <div class="lg:w-[80%] w-[95%] mx-auto lg:flex">
            <div class="basis-[50%] flex items-center">
                <div class="bg-white shadow-lg lg:p-5 p-3 w-full rounded-lg">
                    <div class="text-center my-3">
                        <h1 class="text-amber-400 font-bold text-3xl">Daftar</h1>
                        <p class="text-slate-600 text-sm mt-2">Sebelum menggunakan Smafy Silahkan daftar terlebih dahulu
                        </p>
                    </div>
                    @if (session()->has('msg'))
                        <div class="alert alert-success my-3 ">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('msg') }}!</span>
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
                    <form action="" autocomplete="off" method="POST">
                        @csrf
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Nama?</span>
                            </label>
                            <input type="text" name="name" placeholder="Masukkan disini"
                                class="input input-bordered w-full" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="text" name="email" placeholder="Masukkan disini"
                                class="input input-bordered w-full" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <input type="password" name="password" placeholder="Masukkan disini"
                                class="input input-bordered w-full" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Konfirmasi Password</span>
                            </label>
                            <input type="password" name="password_confirmation" placeholder="Masukkan disini"
                                class="input input-bordered w-full" />
                        </div>
                        <button type="submit"
                            class="btn bg-amber-400 hover:bg-amber-600 border-0 mt-5 w-full lg:w-fit">Daftar</button>
                        <h1 class="mt-3 text-center">Sudah Daftar? <a href="/login" class="text-amber-500">
                                Klik </a> disini untuk login </h1>
                    </form>
                </div>
            </div>
            <div class="basis-[50%]">
                <img src="{{ asset('image/Filing system-rafiki.svg') }}" alt="">
            </div>
        </div>
    </section>
    @include('partials.landing_footer')
</body>

</html>
