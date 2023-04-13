<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Ayo Mulai!</title>
</head>

<body>
    <div class="">
        <div class="flex items-center flex-col justify-center h-screen relative bg-slate-50">
            {{-- navbar --}}
            <div id="coba" class="navbar fixed top-0 w-full bg-amber-400 shadow-xl">
                <div class="navbar-start">
                    <div class="tooltip tooltip-bottom" data-tip="{{ $package->title }}">
                        <p
                            class="font-bold text-white normal-case min-[600px]:text-xl min-[600px]:w-[400px] min-[200px]:w-[200px] min-[200px]:text-sm truncate text-left transition-all ">
                            {{ $package->title }}</p>
                    </div>
                </div>
                <div class="navbar-center hidden lg:flex">
                </div>
                <div class="navbar-end">
                    <button id="exit" class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"><i
                            class="bi bi-box-arrow-right text-2xl"></i></button>
                </div>
            </div>
            {{-- endnavbar --}}
            <div class="m-auto">
                <div class="p-8 shadow-lg rounded-xl text-center bg-white mx-4 max-w-[400px]">

                    @if ($package->accept_responses == 0)
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
                        <h3 class="text-1xl font-semibold text-gray-500">Sebelum melanjutkan ke materi</h3>
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
                            <button type="submit" class="btn bg-amber-400 border-none hover:bg-amber-700">Mulai
                                Kerjakan!</button>
                        </form>
                    @endif
                </div>
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
                window.location.href = "/flush";
            }
        })
    })
</script>

</html>
