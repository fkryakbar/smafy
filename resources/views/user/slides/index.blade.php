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
                                        <button onclick="pengaturan.showModal()"
                                            class="btn rounded-md btn-sm text-slate-600 font-weight-bol "><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd"
                                                    d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pengaturan
                                        </button>
                                        @include('user.slides.components.slidesettings')
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
                                            @if (in_array($slide->type, ['short_answer', 'long_answer']))
                                                @if ($slide->format['manual_correction'])
                                                    <p
                                                        class="text-xs text-white bg-blue-500 rounded-full font-semibold w-fit px-2 py-1 mb-2 flex gap-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd"
                                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Periksa Manual
                                                    </p>
                                                @endif
                                            @endif
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
                                                            href="/dashboard/lessons/{{ $lesson->slug }}/{{ $lesson->sublessons[0]->slug }}/{{ $slide->id }}/edit">Ubah
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
                                            $code = $slide->format['youtube_link'];
                                            preg_match(
                                                "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/",
                                                $code,
                                                $matches,
                                            );
                                        @endphp
                                        <div class="w-full mx-auto mb-5"><iframe class="w-full aspect-video"
                                                src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe></div>
                                    @endif
                                    <div class="p-4 bg-white rounded-lg mt-3 border border-slate-200">
                                        {!! $slide->content !!}
                                    </div>
                                    @if ($slide->type == 'short_answer')
                                        <div>
                                            <input type="text" disabled placeholder="Masukkan jawaban benar"
                                                class="input input-bordered w-full mt-3"
                                                value="{{ $slide->format['correct_answer'] }}" />
                                            <div class="mt-3">
                                                @if ($slide->format['explanation'])
                                                    <div x-transition>
                                                        <div class="card w-full bg-green-400">
                                                            <div class="card-body text-white">
                                                                <h2 class="card-title">Penjelasan</h2>
                                                                @if ($slide->format['correct_answer'])
                                                                    <p>Jawaban benar :
                                                                        {{ $slide->format['correct_answer'] }}
                                                                    </p>
                                                                @endif
                                                                <p>{!! $slide->format['explanation'] !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                    @if ($slide->type == 'long_answer')
                                        <div>
                                            <textarea name="answer" id="{{ $i }}-isian" disabled="true"
                                                class="textarea textarea-bordered w-full mt-3" placeholder="Masukkan jawaban">{{ $slide->format['correct_answer'] }}</textarea>
                                            <div class="mt-3">
                                                @if ($slide->format['explanation'])
                                                    <div x-transition>
                                                        <div class="card w-full bg-green-400">
                                                            <div class="card-body text-white">
                                                                <h2 class="card-title">Penjelasan</h2>
                                                                @if ($slide->format['correct_answer'])
                                                                    <p>Jawaban benar :
                                                                        {{ $slide->format['correct_answer'] }}
                                                                    </p>
                                                                @endif
                                                                <p>{!! $slide->format['explanation'] !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        @if ($slide->type == 'multiple_choice')
                                            <div>
                                                <br>
                                                @if ($slide->format['choices']['a'])
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="a"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->format['correct_answer'] == 'a') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="a" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="a">a.
                                                            {{ $slide->format['choices']['a'] }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->format['choices']['b'])
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="b"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->format['correct_answer'] == 'b') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="b" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="b">b.
                                                            {{ $slide->format['choices']['b'] }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->format['choices']['c'])
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="c"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->format['correct_answer'] == 'c') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="c" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="c">c.
                                                            {{ $slide->format['choices']['c'] }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->format['choices']['d'])
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="d"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->format['correct_answer'] == 'd') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="d" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="d">d.
                                                            {{ $slide->format['choices']['d'] }}</label><br>
                                                    </div>
                                                @endif
                                                @if ($slide->format['choices']['e'])
                                                    <div class="flex slides-center mb-4">
                                                        <input type="radio" id="e"
                                                            name="answer-{{ $slide->id }}"
                                                            @if ($slide->format['correct_answer'] == 'e') checked @endif
                                                            class="peer/answer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                                            x-on:click="user_answer=this.event.target.value"
                                                            value="e" disabled="true">
                                                        <label
                                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-green-200"
                                                            for="e">e.
                                                            {{ $slide->format['choices']['e'] }}</label>
                                                    </div>
                                                @endif
                                                <div class="mt-3">
                                                    @if ($slide->format['explanation'])
                                                        <div x-transition>
                                                            <div id="{{ $i }}-alert"
                                                                class="card w-full bg-green-400">
                                                                <div class="card-body text-white">
                                                                    <h2 class="card-title">Penjelasan</h2>
                                                                    @if ($slide->format['correct_answer'])
                                                                        <p>Jawaban benar :
                                                                            {{ $slide->format['correct_answer'] }}
                                                                        </p>
                                                                    @endif
                                                                    <p>{!! $slide->format['explanation'] !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($slide->type == 'file_attachment')
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
