<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>{{ $package->title }} | Preview</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class=" bg-slate-100" x-data="{ sidebar_open: false }">
    @include('partials.navbar')
    <div class="px-2 lg:w-[800px] w-full lg:mx-auto">
        <div class="text-sm breadcrumbs mt-3">
            <ul>
                <li>
                    <a href="/browse">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="w-4 h-4 mr-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                            </path>
                        </svg>
                        Browse
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-4 h-4 mr-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                        </path>
                    </svg>
                    Preview
                </li>
            </ul>

        </div>
        <div class="py-5 px-3  bg-white  rounded-md mt-3 shadow ">
            <div class="flex p-4 gap-4">
                <div class="basis-[15%]">
                    <img src="{{ asset('image/logo.png') }}" alt="thumbnail" class="w-full">
                </div>
                <div class="basis-[85%]">
                    <div class="flex items-center gap-2">
                        <svg class="text-slate-500" xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                            fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                            <path
                                d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />
                        </svg>
                        <h1 class="text-slate-600 uppercase font-bold">{{ $package->topic_type }}</h1>
                    </div>
                    <h1 class="lg:text-3xl text-xl font-bold mt-2">{{ $package->title }}</h1>
                    <p class="text-slate-600">{{ $package->description }}</p>
                    <div class="mt-4 flex gap-7">
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
            </div>
            <div class="flex justify-end gap-2">
                <a href="/learn/{{ $package->slug }}" target="_blank"
                    class="btn lg:btn-md btn-xs bg-green-400 hover:bg-green-700 border-none gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                    Buka
                </a>
                <button onclick="copy_link_materi('{{ $package->slug }}')"
                    class="btn lg:btn-md btn-xs bg-blue-400 hover:bg-blue-700 border-none gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                    Salin Link
                </button>
                <a href="/preview/{{ $package->slug }}/copy"
                    class="btn lg:btn-md btn-xs bg-amber-400 hover:bg-amber-700 border-none gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                    Salin dan Edit
                </a>
            </div>
        </div>
        <div class="flex gap-3 items-center font-bold my-5 text-slate-500 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                class="bi bi-list-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
            </svg>
            {{ count($package->get_slides) }} Slide
        </div>
        <div>
            <div class="bg-white p-3 rounded-md shadow  ">
                @forelse ($package->get_slides as $i => $item)
                    <div class="my-4 bg-green-50 rounded-lg p-5">
                        <div id="content">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-slate-600">Urutan Slide ke-{{ $item->order_id }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}
                                    </p>
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
                                <div class="min-[500px]:w-[500px] mx-auto mb-5"><iframe class="w-full aspect-video"
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
                                                        <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                                        <p>{{ $item->reasons }}</p>
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
                                                    x-on:click="user_answer=this.event.target.value" value="a"
                                                    disabled="true">
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
                                                    x-on:click="user_answer=this.event.target.value" value="b"
                                                    disabled="true">
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
                                                    x-on:click="user_answer=this.event.target.value" value="c"
                                                    disabled="true">
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
                                                    x-on:click="user_answer=this.event.target.value" value="d"
                                                    disabled="true">
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
                                                    x-on:click="user_answer=this.event.target.value" value="e"
                                                    disabled="true">
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
                                                            <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                                            <p>{{ $item->reasons }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada slide yang dibuat</p>
                @endforelse
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    @include('partials.landing_footer')
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
</body>

</html>
