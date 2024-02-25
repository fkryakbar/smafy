<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Slides</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
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
                                <a href="/dashboard/lessons/{{ $lesson->slug }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Subtopik
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
                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <div class="flex gap-3 p-3">
                            <div class="lg:basis-[5%] basis-[15%]">
                                @if ($lesson->sublessons[0]->sublesson_type == 'materi')
                                    <img src="/image/materi.png" alt="logo" width="100%">
                                @else
                                    <img src="/image/kuis.png" alt="logo" width="100%">
                                @endif
                            </div>
                            <div class="block lg:basis-[95%] basis-[75%]">
                                <div>
                                    @if ($lesson->sublessons[0]->sublesson_type == 'materi')
                                        <p
                                            class="text-xs font-semibold uppercase rounded-full px-2 py-1 bg-green-400 w-fit text-white">
                                            {{ $lesson->sublessons[0]->sublesson_type }}
                                        </p>
                                    @else
                                        <p
                                            class="text-xs font-semibold uppercase rounded-full px-2 py-1 bg-amber-400 w-fit text-white">
                                            {{ $lesson->sublessons[0]->sublesson_type }}
                                        </p>
                                    @endif
                                    <p class="text-lg font-semibold text-slate-600">
                                        {{ $lesson->sublessons[0]->title }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-slate-400">
                                        {{ $lesson->sublessons[0]->created_at->diffForHumans() }}
                                    </p>
                                    <div class="flex gap-2 flex-wrap justify-end">
                                        <a href="/dashboard/lessons/{{ $lesson->slug }}/{{ $lesson->sublessons[0]->slug }}/insert"
                                            class="btn rounded-md btn-sm  text-white font-weight-bol bg-green-400 hover:bg-green-600">+
                                            Buat Slide</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6 mx-auto lg:w-[500px]">
                        @forelse ($slides as $i => $slide)
                            <div class="my-4 bg-green-50 rounded-lg p-5">
                                <div id="content">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs text-gray-500">{{ $slide->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div>
                                            <div class="dropdown dropdown-end">
                                                <label tabindex="0"
                                                    class="btn btn-sm bg-green-400 border-none hover:bg-green-700 m-1 text-white">
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
                                                            href="/dashboard/topik/{{ $lesson->slug }}/{{ $slide->id }}/edit">Ubah
                                                            Slide</a></li>
                                                    <li><button
                                                            onclick="hapus_slide('{{ $lesson->slug }}','{{ $lesson->sublessons[0]->slug }}','{{ $slide->id }}')">Hapus
                                                            Slide</button></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="bg-white mb-8 mt-5 p-5 border-l-8 border-amber-400 rounded-r-lg ">
                                        <h1 class="min-[200px]:text-4xl text-5xl font-bold text-slate-600">
                                            {{ $slide->title }}</h1>
                                    </div>
                                    @if ($slide->image_path != null)
                                        <img src="/{{ $slide->image_path }}" class="lg:w-[300px] mx-auto mb-4">
                                    @endif
                                    @if ($slide->type == 'youtube_video')
                                        @php
                                            $code = $slide->youtube_link;
                                            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $code, $matches);
                                        @endphp
                                        <div class="min-[500px]:w-[500px] mx-auto mb-5"><iframe
                                                class="w-full aspect-video"
                                                src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe></div>
                                    @endif
                                    <div class="p-4 bg-white rounded-lg mt-3 border border-slate-200">
                                        {!! $slide->content !!}
                                    </div>
                                    @if ($slide->type == 'isian')
                                        <div>
                                            <textarea name="answer" id="{{ $i }}-isian" disabled="true" class="textarea textarea-bordered w-full mt-3"
                                                placeholder="Masukkan jawaban">{{ $slide->correct_answer }}</textarea>
                                            <div class="mt-3">
                                                @if ($slide->reasons)
                                                    <div x-transition>
                                                        <div class="card w-full bg-green-400">
                                                            <div class="card-body text-white">
                                                                <h2 class="card-title">Penjelasan</h2>
                                                                @if ($slide->correct_answer)
                                                                    <p>Jawaban benar : {{ $slide->correct_answer }}
                                                                    </p>
                                                                @endif
                                                                <p>{!! $slide->reasons !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        @if ($slide->type == 'pilihan_ganda')
                                            <div>
                                                <br>
                                                @if ($slide->a)
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="a"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->correct_answer == 'a') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="a" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="a">a.
                                                            {{ $slide->a }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->b)
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="b"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->correct_answer == 'b') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="b" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="b">b.
                                                            {{ $slide->b }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->c)
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="c"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->correct_answer == 'c') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="c" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="c">c.
                                                            {{ $slide->c }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->d)
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="d"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->correct_answer == 'd') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="d" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="d">d.
                                                            {{ $slide->d }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->e)
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="e"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->correct_answer == 'e') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="e" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="e">e.
                                                            {{ $slide->e }}</label>
                                                    </div>
                                                @endif
                                                <div class="mt-3">
                                                    @if ($slide->reasons)
                                                        <div x-transition>
                                                            <div id="{{ $i }}-alert"
                                                                class="card w-full bg-green-400">
                                                                <div class="card-body text-white">
                                                                    <h2 class="card-title">Penjelasan</h2>
                                                                    @if ($slide->correct_answer)
                                                                        <p>Jawaban benar : {{ $slide->correct_answer }}
                                                                        </p>
                                                                    @endif
                                                                    <p>{!! $slide->reasons !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($slide->type == 'file_attachment')
                                        @if ($slide->correct_answer)
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
                            <div class="">
                                <img src="/image/Empty-amico.svg" alt="Empty" class="mx-auto" width="300px">
                                <p class="text-center mt-5 text-slate-600 italic">
                                    Belum ada slide yang dibuat
                                </p>
                            </div>
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
    </script>

    <script>
        function hapus_slide(slug, sublesson_slug, slide_id) {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Slide yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/lessons/${slug}/${sublesson_slug}/${slide_id}/hapus`
                }
            })
        }
    </script>

</body>

</html>
