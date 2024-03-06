<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>{{ $lesson->sublessons[0]->title }} | Let's Learn</title>
</head>

<body x-data="main_data" class="relative">
    <style>
        .loader {
            opacity: 1;
            transition: all 1000ms;
            top: 0%
        }

        .hide {
            opacity: 0;

        }

        .top {
            top: -100%
        }
    </style>
    <div class="loader absolute bg-white w-full h-screen z-[500]" id="loader">
        <div class="flex justify-center items-center h-screen">
            <img src="{{ asset('image/Ripple-1s-200px.gif') }}" alt="">
        </div>
    </div>
    <script>
        window.onload = function() {
            document.getElementById('loader').classList.add('hide');
            setTimeout(() => {
                document.getElementById('loader').classList.add('top');
            }, 1000);
        }
    </script>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
    <script>
        const App = {
            page_total: {{ count($slides) }},
            quiz_total: {{ count($lesson->sublessons[0]->questions) }},
            abstract: {
                participant_id: '{{ session($lesson->slug)['participant_id'] }}',
                sublesson_slug: '{{ $lesson->sublessons[0]->slug }}',
            },
            saved_answer: []

        }
    </script>
    {{-- sidebar --}}
    <div x-cloak
        class="min-h-screen fixed  z-[101] flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        <div class="fixed flex flex-col top-0  w-64 bg-white h-full border-r transition-all shadow-xl"
            :class="show_sidebar ? 'left-0' : '-left-[300px]'">
            <div class="flex justify-between py-5 pl-3 items-center pr-5 h-14 border-b text-amber-400">
                <div class="tooltip tooltip-bottom" data-tip="{{ $lesson->sublessons[0]->title }}">
                    <p class="font-bold text-amber-400 normal-case max-w-[170px]  truncate text-left transition-all ">
                        {{ $lesson->sublessons[0]->title }}</p>
                </div>
                <div x-on:click="show_sidebar=false"
                    class="btn shadow-none bg-white hover:bg-slate-200 border-none text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="overflow-y-auto overflow-x-hidden flex-grow">
                <ul class="flex flex-col py-4 space-y-1">
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-500">Daftar Isi</div>
                        </div>
                    </li>
                    @foreach ($slides as $i => $slide)
                        <li>
                            <button x-on:click="page={{ $i + 1 }}"
                                @if (
                                    $slide->type == 'file_attachment' ||
                                        $slide->type == 'multiple_choice' ||
                                        $slide->type == 'short_answer' ||
                                        $slide->type == 'long_answer') class="relative flex flex-row items-center h-11 w-60 focus:outline-none border-l-4 border-transparent  pr-6 @if (in_array($lesson->sublessons[0]->slug, session($lesson->slug)['finished_sublessons']) &&
                                        $lesson->sublessons[0]->show_correct_answer == 1) bg-red-400 text-white @else hover:bg-gray-50  hover:text-gray-800 hover:border-amber-500 @endif
                            rounded-r-md" @else
                                class="relative flex flex-row items-center h-11 w-60 focus:outline-none border-l-4 border-transparent  pr-6 @if (in_array($lesson->sublessons[0]->slug, session($lesson->slug)['finished_sublessons']) &&
                                        $lesson->sublessons[0]->show_correct_answer == 1) bg-green-400 text-white @else hover:bg-gray-50  hover:text-gray-800 hover:border-amber-500 @endif rounded-r-md "
                                @endif
                                :class="page == {{ $i + 1 }} ? 'bg-gray-100 text-gray-800 border-amber-500' : ''">
                                <span class="inline-flex justify-center items-center ml-4">
                                    @if (
                                        $slide->type == 'file_attachment' ||
                                            $slide->type == 'multiple_choice' ||
                                            $slide->type == 'short_answer' ||
                                            $slide->type == 'long_answer')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    @endif

                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">{{ $slide->title }}</span>
                            </button>
                        </li>
                    @endforeach
                    <br>

                </ul>
            </div>
        </div>
    </div>
    {{-- navbar --}}
    <div class="fixed z-[100] w-full">
        <div id="coba" class="navbar top-0 w-full bg-amber-400 shadow-xl z-50">
            <div class="navbar-start text-white gap-2">
                <div x-on:click="show_sidebar=true"
                    class="btn shadow-none text-white bg-amber-400 hover:bg-amber-600 border-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>

                <div class="tooltip tooltip-bottom " data-tip="{{ $lesson->sublessons[0]->title }}">
                    <div class="">
                        <p
                            class="font-bold text-white normal-case lg:text-xl lg:max-w-[300px] max-w-[120px] truncate text-left ">
                            {{ $lesson->sublessons[0]->title }}</p>
                    </div>
                </div>
            </div>
            <div class="navbar-center hidden lg:flex">
            </div>
            <div class="navbar-end">
                <a class="btn shadow-none btn-ghost text-white normal-case text-lg min-[200px]:btn-sm " id="progress">
                    <p class="animate-[mantul_1s_ease-in-out]" x-text="progress()"></p>
                </a>
                <a class="btn shadow-none btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"
                    href="https://docs.smafy.my.id/siswa/menyelesaikan-aktivitas" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                </a>
                <button id="exit"
                    class="btn shadow-none btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"><i
                        class="bi bi-box-arrow-right text-2xl"></i></button>
            </div>
        </div>
        <div class="w-full h-1">
            <div class="bg-orange-400 h-1 transition-all" style="width: 0%" id="progress_bar">
            </div>
        </div>
    </div>

    {{-- endnavbar --}}
    {{-- main --}}
    <script>
        async function submit_jawaban(jawaban) {
            jawaban.lesson_slug = '{{ $lesson->slug }}'
            jawaban.sublesson_slug = '{{ $lesson->sublessons[0]->slug }}'

            let responses = await fetch(
                "/api/submit-jawaban-kuis", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(jawaban)
                }).catch(e => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal
                            .stopTimer)
                        toast.addEventListener('mouseleave', Swal
                            .resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Network Error'
                })
            });
            if (responses.status != 200) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal
                            .stopTimer)
                        toast.addEventListener('mouseleave', Swal
                            .resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Kamu sudah selesai mengerjakan'
                })
            }
        }
    </script>
    <div id="capture"
        class="bg-slate-100 mx-auto my-auto h-screen lg:w-[1000px] w-full pb-[100px] overflow-y-auto  p-3  shadow-xl">
        <div class="h-[70px]"></div>
        @if (
            $lesson->sublessons[0]->timer > 0 &&
                !isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
            <div>
                <div class="flex justify-end">
                    <div class="bg-white rounded-md px-4 py-2">
                        Sisa waktu <span id="countdown">00:00</span>
                    </div>
                </div>
                <script>
                    (function() {
                        const countdown = document.getElementById('countdown');
                        let time =
                            {{ session($lesson->slug)['start_time'][$lesson->sublessons[0]->slug]['time'] + (int) $lesson->sublessons[0]->timer * 60 - time() }};
                        let update = setInterval(() => {
                            update_countdown()
                        }, 1000);

                        function update_countdown() {
                            let minutes = Math.floor(time / 60);
                            let seconds = time % 60;
                            if (time < 300) {
                                countdown.classList.add('text-red-500')
                            }
                            if (seconds < 10) {
                                seconds = '0' + seconds
                            }
                            if (minutes < 10) {
                                minutes = '0' + minutes
                            }
                            if (time < 0) {
                                seconds = '00'
                                minutes = '00'
                            }
                            countdown.innerHTML = `${minutes} : ${seconds}`;
                            if (time < 0) {
                                clearInterval(update);
                                stop_quiz();
                            }
                            time--
                        }

                        function stop_quiz() {
                            Swal.fire({
                                title: "Kuis telah berakhir!",
                                text: "Halaman akan di tutup dalam 5 detik",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Keluar",
                                cancelButtonText: "Kembali",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    sessionStorage.clear();
                                    window.location.href =
                                        `/play/{{ $lesson->slug }}/${App.abstract.sublesson_slug}/save`;
                                }
                            });
                            setTimeout(() => {
                                sessionStorage.clear();
                                window.location.href =
                                    `/play/{{ $lesson->slug }}/${App.abstract.sublesson_slug}/save`;
                            }, 5000)
                        }
                    })()
                </script>
            </div>
        @endif
        @foreach ($slides as $i => $slide)
            <div class="main" x-show="page=={{ $i + 1 }}" x-transition.duration.150ms>
                <div id="content">
                    <div class="bg-white mb-8 mt-5 p-5 border-l-8 border-amber-400 rounded-r-lg ">
                        <h1 class="text-2xl lg:text-5xl font-bold text-slate-600">{{ $slide->title }}</h1>
                    </div>
                    @if ($slide->image_path != null)
                        <img src="/{{ $slide->image_path }}" class="lg:w-[500px] mx-auto mb-4">
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
                        <div class="min-[500px]:w-[500px] mx-auto mb-5"><iframe class="w-full aspect-video"
                                src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe></div>
                    @endif
                    <div class="p-4 bg-white rounded-lg mt-3 border border-slate-200">
                        {!! $slide->content !!}
                    </div>
                    @if ($slide->type == 'multiple_choice')
                        <div class="mt-5">
                            @if ($slide->format['choices']['a'])
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="a-{{ $slide->id }}" @disabled(isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                        name="answer-{{ $slide->id }}"
                                        class="peer/answer  hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                        @checked(count($slide->answers) > 0 ? ($slide->answers[0]->answer == 'a' ? true : false) : false) value="a">
                                    <label
                                        class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-blue-200"
                                        for="a-{{ $slide->id }}">a.
                                        {{ $slide->format['choices']['a'] }}</label><br>
                                </div>
                            @endif
                            @if ($slide->format['choices']['b'])
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="b-{{ $slide->id }}" @disabled(isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                        name="answer-{{ $slide->id }}"
                                        class="peer/answer  hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                        @checked(count($slide->answers) > 0 ? ($slide->answers[0]->answer == 'b' ? true : false) : false) value="b">
                                    <label
                                        class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-blue-200"
                                        for="b-{{ $slide->id }}">b.
                                        {{ $slide->format['choices']['b'] }}</label><br>
                                </div>
                            @endif
                            @if ($slide->format['choices']['c'])
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="c-{{ $slide->id }}" @disabled(isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                        name="answer-{{ $slide->id }}"
                                        class="peer/answer  hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                        @checked(count($slide->answers) > 0 ? ($slide->answers[0]->answer == 'c' ? true : false) : false) value="c">
                                    <label
                                        class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-blue-200"
                                        for="c-{{ $slide->id }}">c.
                                        {{ $slide->format['choices']['c'] }}</label><br>
                                </div>
                            @endif
                            @if ($slide->format['choices']['d'])
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="d-{{ $slide->id }}" @disabled(isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                        name="answer-{{ $slide->id }}"
                                        class="peer/answer  hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                        @checked(count($slide->answers) > 0 ? ($slide->answers[0]->answer == 'd' ? true : false) : false) value="d">
                                    <label
                                        class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-blue-200"
                                        for="d-{{ $slide->id }}">d.
                                        {{ $slide->format['choices']['d'] }}</label><br>
                                </div>
                            @endif
                            @if ($slide->format['choices']['e'])
                                <div class="flex items-center mb-4">
                                    <input type="radio" id="e-{{ $slide->id }}" @disabled(isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                        name="answer-{{ $slide->id }}"
                                        class="peer/answer  hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                        @checked(count($slide->answers) > 0 ? ($slide->answers[0]->answer == 'e' ? true : false) : false) value="e">
                                    <label
                                        class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked/answer:bg-blue-200"
                                        for="e-{{ $slide->id }}">e.
                                        {{ $slide->format['choices']['e'] }}</label><br>
                                </div>
                            @endif
                        </div>
                        @if (isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]) && $lesson->show_correct_answer)
                            @if (isset($slide->answers[0]))
                                @if ($slide->answers[0]->result == 1)
                                    <div class="bg-green-500 mt-5 p-5 rounded-lg">
                                        @if ($slide->format['correct_answer'])
                                            <h1 class="text-lg font-semibold text-white">Jawaban Benar</h1>
                                            <p class="text-white text-sm">
                                                {{ $slide->format['correct_answer'] }}
                                            </p>
                                            <hr class="my-3">
                                        @endif
                                        <h1 class="text-lg font-semibold text-white">Penjelasan</h1>
                                        <p class="text-white text-sm">
                                            {{ $slide->format['explanation'] }}
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-red-500 mt-5 p-5 rounded-lg">
                                        @if ($slide->format['correct_answer'])
                                            <h1 class="text-lg font-semibold text-white">Jawaban Benar</h1>
                                            <p class="text-white text-sm">
                                                {{ $slide->format['correct_answer'] }}
                                            </p>
                                            <hr class="my-3">
                                        @endif
                                        <h1 class="text-lg font-semibold text-white">Penjelasan</h1>
                                        <p class="text-white text-sm">
                                            {{ $slide->format['explanation'] }}
                                        </p>
                                    </div>
                                @endif
                            @else
                                <div class="bg-red-500 mt-5 p-5 rounded-lg">
                                    @if ($slide->format['correct_answer'])
                                        <h1 class="text-lg font-semibold text-white">Jawaban Benar</h1>
                                        <p class="text-white text-sm">
                                            {{ $slide->format['correct_answer'] }}
                                        </p>
                                        <hr class="my-3">
                                    @endif
                                    <h1 class="text-lg font-semibold text-white">Penjelasan</h1>
                                    <p class="text-white text-sm">
                                        {{ $slide->format['explanation'] }}
                                    </p>
                                </div>
                            @endif
                        @endif
                        <script>
                            (function() {
                                const radios = document.getElementsByName('answer-{{ $slide->id }}');
                                const correctAnswer = '{{ $slide->format['correct_answer'] }}'
                                const isAnswered = {{ count($slide->answers) > 0 ? 1 : 0 }}


                                radios.forEach(element => {
                                    element.addEventListener('click', checkAnswer)
                                });

                                function checkAnswer() {
                                    let selectedAnswer = null
                                    radios.forEach(element => {
                                        if (!element.checked) {
                                            return;
                                        }
                                        selectedAnswer = element
                                    });
                                    if (selectedAnswer) {
                                        const payload = {
                                            answer: selectedAnswer.value,
                                            slide_id: {{ $slide->id }},
                                            correct_answer: correctAnswer,
                                            result: selectedAnswer.value == correctAnswer ? 1 : 0
                                        }
                                        submit_jawaban(payload)
                                    }
                                }
                            })();
                        </script>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="h-[70px] lg:block hidden"></div>
    </div>
    {{-- endmain --}}
    <div class="fixed bottom-0 left-0 w-full">
        <footer class="p-4 bg-amber-400 shadow-lg w-full">
            <div class="lg:w-[1000px] mx-auto flex flex-row justify-center gap-1">
                <div id="add_prev">
                    <button id="prev_button" @click="prev"
                        class="btn shadow-none bg-amber-400 border-none hover:bg-amber-600 float-left">
                        <i class="bi text-3xl text-white float-right bi-arrow-left-circle-fill"></i>
                    </button>
                </div>
                <div class="text-white text-center">
                    <button id="next" @click="next"
                        class="btn shadow-none bg-yellow-600 border-none hover:bg-amber-600 normal-case rounded-full outline-amber-600 text-white">Berikutnya</button>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <audio id="true_sound" preload="auto">
        <source src="{{ asset('sound/true.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <audio id="false_sound" preload="auto">
        <source src="{{ asset('sound/false.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('main_data', () => ({
                page: 1,
                async next() {
                    let next_page = this.page + 1
                    if (next_page <= App.page_total) {
                        this.page = this.page + 1
                    } else {
                        let saved = await this.get_user_saved_answer();
                        if (App.quiz_total <= saved.length) {
                            @if (in_array($lesson->sublessons[0]->slug, session($lesson->slug)['finished_sublessons']))
                                Swal.fire({
                                    title: "Keluar?",
                                    text: "Tekan Keluar untuk Keluar",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Keluar",
                                    cancelButtonText: "Kembali",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            `/play/{{ $lesson->slug }}/${App.abstract.sublesson_slug}/save`;
                                    }
                                });
                            @else
                                Swal.fire({
                                    title: "Sudah Selesai!",
                                    text: "Tekan Simpan dan Keluar untuk menyimpan jawaban",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Simpan dan Keluar",
                                    cancelButtonText: "Kembali",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            `/play/{{ $lesson->slug }}/${App.abstract.sublesson_slug}/save`;
                                    }
                                });
                            @endif
                        } else {
                            @if (isset(session($lesson->slug)['finished_sublessons'][$lesson->sublessons[0]->slug]))
                                Swal.fire({
                                    title: "Keluar?",
                                    text: "Tekan Keluar untuk Keluar",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Keluar",
                                    cancelButtonText: "Kembali",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            `/play/{{ $lesson->slug }}/${App.abstract.sublesson_slug}/save`;
                                    }
                                });
                            @else
                                Swal.fire(
                                    "Mau keluar?",
                                    "Sebelum keluar, Kamu harus menjawab semua pertanyaan",
                                    "info"
                                );
                            @endif
                        }
                    }
                },
                progress() {
                    let proggress_bar = document.getElementById('progress_bar');
                    proggress_bar.style["width"] = `${Math.floor(this.page/App.page_total*100)}%`;
                    return `${this.page} / ${App.page_total}`;
                },
                async get_user_saved_answer() {
                    let responses = await fetch(
                        `/api/get-saved-answer/${App.abstract.participant_id}/${App.abstract.sublesson_slug}`, {
                            method: 'GET',
                            headers: {
                                "Content-Type": "application/json",
                            },
                        }).catch(e => {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Network Error'
                        })
                    })
                    let data = await responses.json()
                    return data;
                },
                prev() {
                    let next_page = this.page - 1
                    if (next_page >= 1) {
                        this.page = this.page - 1
                    }
                },
                show_sidebar: false,

            }))
        })
        document.getElementById("exit").addEventListener("click", function() {
            Swal.fire({
                title: "Keluar?",
                text: "Yakin anda mau keluar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Keluar",
            }).then((result) => {
                if (result.isConfirmed) {
                    sessionStorage.clear();
                    window.location.href = `/play/{{ $lesson->slug }}`;
                }
            });
        });
    </script>
</body>

</html>
