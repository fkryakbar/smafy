<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Topik</title>
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                Topik
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Topik
                        </h2>
                        <a href="/dashboard/topik/tambah"
                            class="btn border-none rounded-md btn-sm  text-white font-weight-bol bg-amber-400 hover:bg-amber-600 float-right">+
                            Tambah
                            Topik</a>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6 min-[500px]:w-full min-[200px]:w-[327px] ">
                        <div class="">
                            @forelse ($materi as $i => $item)
                                <div class="flex w-full my-3 ml-3">
                                    <div class="basis-[5%] ">
                                        <div class="flex-start">
                                            {{ $i + 1 }}
                                        </div>
                                    </div>
                                    <a href="/dashboard/topik/{{ $item->slug }}" class="basis-[75%] ">
                                        <p class="font-bold">
                                            {{ $item->title }}
                                            @if ($item->topic_type == 'materi')
                                                <span class="badge bg-green-400 border-0 uppercase">
                                                    {{ $item->topic_type }}
                                                </span>
                                            @else
                                                <span class="badge bg-amber-400 border-0 uppercase">
                                                    {{ $item->topic_type }}
                                                </span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $item->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                    <div class="basis-[20%] flex justify-end px-3 ">
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0"
                                                class="btn btn-sm bg-green-400 border-none hover:bg-green-600 m-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                </svg>
                                            </label>
                                            <ul tabindex="0"
                                                class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                                <li><a href="/dashboard/topik/{{ $item->slug }}/edit">Pengaturan</a>
                                                </li>
                                                <li><a href="/dashboard/topik/{{ $item->slug }}">Lihat Slide</a>
                                                </li>
                                                <li><a href="/learn/{{ $item->slug }}" target="_blank">Buka Topik</a>
                                                </li>
                                                <li><button onclick="copy_link_materi('{{ $item->slug }}')">Salin
                                                        link</button></li>
                                                <li><button
                                                        onclick="hapus_materi('{{ $item->slug }}')">Hapus</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <p class="text-center text-gray-500">Belum ada Topik yang dibuat</p>
                            @endforelse

                        </div>
                    </div>



                </div>
            </main>

        </div>

    </div>


    <script>
        function copy_link_materi(slug) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Link berhasil disalin'
            })
            navigator.clipboard.writeText(`{{ env('APP_URL') }}/learn/${slug}`);
        }

        function hapus_materi(slug) {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Topik yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/topik/${slug}/hapus`
                }
            })
        }
    </script>

</body>

</html>
