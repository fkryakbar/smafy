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
                                <a href="/dashboard/topik">
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
                                Slide

                            </li>
                        </ul>

                    </div>

                    <div
                        class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]  flex justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-700 inline">
                                {{ $package->title }}
                            </h2>
                            <p class="italic text-slate-500 text-xs">Tipe Topik : {{ $package->topic_type }} •
                                {{ count($package->get_slides) }} Slide</p>
                        </div>
                        <div class="lg:flex flex-wrap justify-end gap-2 hidden">
                            <a href="/dashboard/topik/{{ $package->slug }}/input"
                                class="btn border-none rounded-md min-[500px]:btn-sm min-[200px]:btn-xs  text-white bg-amber-400 hover:bg-amber-600 float-right">+
                                Tambah
                                Slide</a>
                            <a href="/dashboard/topik/{{ $package->slug }}/edit"
                                class="btn border-none rounded-md min-[500px]:btn-sm min-[200px]:btn-xs  text-white bg-gray-400 hover:bg-gray-600 float-right">
                                Pengaturan Topik</a>
                            <a href="/dashboard/hasil/{{ $package->slug }}"
                                class="btn border-none rounded-md min-[500px]:btn-sm min-[200px]:btn-xs  text-white bg-cyan-400 hover:bg-cyan-600 float-right">
                                Lihat Responden</a>
                            <a href="/learn/{{ $package->slug }}" target="_blank"
                                class="btn border-none rounded-md min-[500px]:btn-sm min-[200px]:btn-xs   text-white bg-green-400 hover:bg-green-600 float-right">
                                Buka Topik</a>
                            <button onclick="copy_link_materi('{{ $package->slug }}')"
                                class="btn border-none rounded-md min-[500px]:btn-sm min-[200px]:btn-xs   text-white bg-blue-400 hover:bg-blue-600 float-right ">
                                Salin Link</button>
                        </div>
                        <div class="dropdown dropdown-end lg:hidden">
                            <label tabindex="0" class="btn btn-sm bg-amber-400 border-none hover:bg-amber-700 m-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li> <a href="/dashboard/topik/{{ $package->slug }}/input">
                                        Tambah
                                        Slide</a></li>
                                <li> <a href="/dashboard/topik/{{ $package->slug }}/edit">
                                        Pengaturan Topik</a></li>
                                <li> <a href="/dashboard/hasil/{{ $package->slug }}">
                                        Lihat Responden</a></li>
                                <li><a href="/learn/{{ $package->slug }}" target="_blank">
                                        Buka Topik</a></li>
                                <li> <button onclick="copy_link_materi('{{ $package->slug }}')">
                                        Salin Link</button></li>
                            </ul>
                        </div>

                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6 min-[500px]:w-full min-[200px]:w-[327px] ">
                        @forelse ($data as $i => $item)
                            <div class="my-4 bg-green-50 rounded-lg p-5">
                                <div id="content">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-bold text-slate-600">Urutan Slide ke-{{ $item->order_id }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div>
                                            <div class="dropdown dropdown-end">
                                                <label tabindex="0"
                                                    class="btn btn-sm bg-green-400 border-none hover:bg-green-700 m-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                    </svg>
                                                </label>
                                                <ul tabindex="0"
                                                    class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                                    <li><a
                                                            href="/dashboard/topik/{{ $package->slug }}/{{ $item->id }}/edit">Ubah
                                                            Slide</a></li>
                                                    <li><button
                                                            onclick="hapus_slide('{{ $package->slug }}','{{ $item->id }}')">Hapus
                                                            Slide</button></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="bg-white mb-8 mt-5 p-5 border-l-8 border-amber-400 rounded-r-lg ">
                                        <h1 class="min-[200px]:text-4xl text-5xl font-bold text-slate-600">
                                            {{ $item->title }}</h1>
                                    </div>
                                    @if ($item->image_path != null)
                                        <img src="/{{ $item->image_path }}" class="lg:w-[300px] mx-auto mb-4">
                                    @endif
                                    @if ($item->type == 'youtube_video')
                                        @php
                                            $code = $item->youtube_link;
                                            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $code, $matches);
                                        @endphp
                                        <div class="min-[500px]:w-[500px] mx-auto mb-5"><iframe
                                                class="w-full aspect-video"
                                                src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe></div>
                                    @endif
                                    <div class="p-4 bg-white rounded-lg mt-3 border border-slate-200">
                                        {!! $item->content !!}
                                    </div>
                                    @if ($item->type == 'isian')
                                        <div>
                                            <textarea name="answer" id="{{ $i }}-isian" disabled="true"
                                                class="textarea textarea-bordered w-full mt-3" placeholder="Masukkan jawaban">{{ $item->correct_answer }}</textarea>
                                            <div class="mt-3">
                                                @if ($item->reasons)
                                                    <div x-transition>
                                                        <div class="card w-full bg-green-400">
                                                            <div class="card-body text-white">
                                                                <h2 class="card-title">Penjelasan</h2>
                                                                @if ($item->correct_answer)
                                                                    <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                                                @endif
                                                                <p>{!! $item->reasons !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        @if ($item->type == 'pilihan_ganda')
                                            <div>
                                                <br>
                                                @if ($item->a)
                                                    <div class="flex items-center mb-4">
                                                        <input type="radio" id="a"
                                                            name="answer-{{ $item->id }}"
                                                            @if ($item->correct_answer == 'a') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="a" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="a">a.
                                                            {{ $item->a }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($item->b)
                                                    <div class="flex items-center mb-4">
                                                        <input type="radio" id="b"
                                                            name="answer-{{ $item->id }}"
                                                            @if ($item->correct_answer == 'b') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="b" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="b">b.
                                                            {{ $item->b }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($item->c)
                                                    <div class="flex items-center mb-4">
                                                        <input type="radio" id="c"
                                                            name="answer-{{ $item->id }}"
                                                            @if ($item->correct_answer == 'c') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="c" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="c">c.
                                                            {{ $item->c }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($item->d)
                                                    <div class="flex items-center mb-4">
                                                        <input type="radio" id="d"
                                                            name="answer-{{ $item->id }}"
                                                            @if ($item->correct_answer == 'd') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="d" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="d">d.
                                                            {{ $item->d }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($item->e)
                                                    <div class="flex items-center mb-4">
                                                        <input type="radio" id="e"
                                                            name="answer-{{ $item->id }}"
                                                            @if ($item->correct_answer == 'e') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="e" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="e">e.
                                                            {{ $item->e }}</label>
                                                    </div>
                                                @endif
                                                <div class="mt-3">
                                                    @if ($item->reasons)
                                                        <div x-transition>
                                                            <div id="{{ $i }}-alert"
                                                                class="card w-full bg-green-400">
                                                                <div class="card-body text-white">
                                                                    <h2 class="card-title">Penjelasan</h2>
                                                                    @if ($item->correct_answer)
                                                                        <p>Jawaban benar : {{ $item->correct_answer }}
                                                                        </p>
                                                                    @endif
                                                                    <p>{!! $item->reasons !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($item->type == 'file_attachment')
                                        @if ($item->correct_answer)
                                            <p class="mt-3 ">File Penjelasan</p>
                                            <div
                                                class="w-full max-w-xs bg-gray-100 rounded-lg p-2 flex justify-between items-center">
                                                <div class="flex items-center gap-2">
                                                    <img src="{{ asset('/image/documents.png') }}" class="w-12">
                                                    <p class="text-sm font-semibold">Attachment file</p>
                                                </div>
                                                <a href="/{{ $item->correct_answer }}" target="_blank">
                                                    <div class="p-3 rounded-lg text-white bg-amber-400 font-semibold ">
                                                        Buka
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="form-control w-full max-w-xs mt-3">
                                            <label class="label">
                                                <span class="label-text">Upload Jawaban mu</span>
                                            </label>
                                            <input type="file" name="file_attachment" @disabled(true)
                                                class="file-input file-input-bordered w-full max-w-xs" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada slide yang dibuat</p>
                        @endforelse
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

    <script>
        function hapus_slide(slug, id) {
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
                    window.location.href = `/dashboard/topik/${slug}/${id}/hapus`
                }
            })
        }
    </script>

</body>

</html>
