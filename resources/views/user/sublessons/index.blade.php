<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Sub Topik</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-2 mx-auto grid">
                    @if (session()->has('success'))
                        <script>
                            Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            }).fire({
                                icon: "success",
                                title: "{{ session('success') }}"
                            });
                        </script>
                    @endif
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-error mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $item }}</span>
                        </div>
                    @endforeach
                    <div class="text-sm breadcrumbs mt-3">
                        <ul>
                            <li>
                                <a href="/dashboard/lessons">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Topik
                                </a>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                Sub Topik
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-3 w-full">
                        <div class="flex gap-3 p-3">
                            <div class="lg:basis-[5%] basis-[15%]">
                                <img src="/image/documents.png" alt="logo" width="100%">
                            </div>
                            <div class="block lg:basis-[95%] basis-[75%]">
                                <div>
                                    <p class="text-lg font-semibold text-slate-600">
                                        {{ $topic->title }}
                                    </p>
                                    <p class="text-sm text-slate-600">
                                        {{ $topic->description }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-slate-400">
                                        {{ $topic->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-semibold text-gray-700  inline m-2">
                                Sub Topik
                            </h2>
                            <div class="flex gap-2 flex-wrap justify-end">
                                <button onclick="pengaturan.showModal()"
                                    class="btn rounded-md btn-sm text-slate-600 font-weight-bol "><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pengaturan
                                </button>
                                <button onclick="buat.showModal()"
                                    class="btn rounded-md btn-sm  text-white font-weight-bol bg-green-400 hover:bg-green-600">+
                                    Buat</button>
                                <button onclick="copy_link('{{ $topic->slug }}')" class="btn btn-sm text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Copy Link
                                </button>
                                <a href="/play/{{ $topic->slug }}" target="_blank"
                                    class="btn btn-sm bg-amber-400 text-white hover:bg-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Buka
                                </a>
                            </div>
                        </div>
                    </div>
                    @include('user.sublessons.components.createform')
                    @include('user.sublessons.components.settings')
                    <div class="bg-white p-3 rounded-md shadow mt-3 w-full space-y-5">
                        @forelse ($topic->sublessons as $i => $sublesson)
                            <div class="flex gap-3 border-[1px] p-3 rounded-lg hover:bg-slate-50">
                                <div class="lg:basis-[5%] basis-[15%]">
                                    @if ($sublesson->sublesson_type == 'materi')
                                        <img src="/image/materi.png" alt="logo" width="100%">
                                    @else
                                        <img src="/image/kuis.png" alt="logo" width="100%">
                                    @endif
                                </div>
                                <div class="block lg:basis-[95%] basis-[75%]">
                                    <a href="/dashboard/lessons/{{ $topic->slug }}/{{ $sublesson->slug }}">
                                        @if ($sublesson->sublesson_type == 'materi')
                                            <p
                                                class="text-xs font-semibold uppercase rounded-full px-2 py-1 bg-green-400 w-fit text-white">
                                                {{ $sublesson->sublesson_type }}
                                            </p>
                                        @else
                                            <p
                                                class="text-xs font-semibold uppercase rounded-full px-2 py-1 bg-amber-400 w-fit text-white">
                                                {{ $sublesson->sublesson_type }}
                                            </p>
                                        @endif
                                        <p class="text-lg font-semibold text-slate-600">
                                            {{ $sublesson->title }}
                                        </p>
                                    </a>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-slate-400">
                                            {{ $sublesson->created_at->diffForHumans() }}
                                        </p>
                                        <div class="flex gap-3">
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button"
                                                    class="btn lg:btn-sm btn-xs bg-slate-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <ul tabindex="0"
                                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                                    <li>
                                                        <button
                                                            onclick="delete_sublesson('{{ $topic->slug }}', '{{ $sublesson->slug }}')"
                                                            class="text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24" fill="currentColor"
                                                                class="w-6 h-6">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="">
                                <img src="/image/Empty-amico.svg" alt="Empty" class="mx-auto" width="300px">
                                <p class="text-center mt-5 text-slate-600 italic">
                                    Belum ada subtopik yang dibuat
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>

        </div>

    </div>


    <script>
        function copy_link(slug) {
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
            navigator.clipboard.writeText(`{{ env('APP_URL') }}/play/${slug}`);
        }

        function delete_sublesson(slug, sublesson_slug) {
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
                    window.location.href = `/dashboard/lessons/${slug}/${sublesson_slug}/hapus`
                }
            })
        }

        function copy_link_koleksi(slug) {
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
            navigator.clipboard.writeText(`{{ env('APP_URL') }}/play/${slug}`);
        }

        function hapus_koleksi(slug) {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Koleksi yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/koleksi/${slug}/hapus`
                }
            })
        }
    </script>

</body>

</html>
