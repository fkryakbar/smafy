<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Tidak ditemukan!</title>
</head>

<body>
    <div class="flex justify-center items-center h-screen flex-col">
        <img src="{{ asset('image/404 Error-rafiki.svg') }}" class="lg:w-[300px] w-[200px]" alt="">
        <h1 class="text-slate-600 font-bold">Halaman tidak ditemukan!</h1>
        <a href="/" class="btn btn-sm bg-green-400 border-none hover:bg-green-600 mt-3">Kembali</a>
    </div>
</body>

</html>
