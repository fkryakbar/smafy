<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>{{ $package->title }} | Quiz</title>
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
            page_total: {{ count($soal) }},
            quiz_total: {{ count($quiz) }},
            abstract: {
                u_id: '{{ session($collection->slug)['u_id'] }}',
                package_id: '{{ $package->slug }}',
            },
            saved_answer: []

        }
    </script>
    {{-- sidebar --}}
    <div x-cloak
        class="min-h-screen fixed  z-[101] flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        <div class="fixed  flex flex-col top-0  w-64 bg-white h-full border-r transition-all shadow-xl"
            :class="show_sidebar ? 'left-0' : '-left-[300px]'">
            <div class="flex justify-between py-5 pl-3 items-center pr-5 h-14 border-b text-amber-400">
                <div class="tooltip tooltip-bottom" data-tip="{{ $package->title }}">
                    <p class="font-bold text-amber-400 normal-case max-w-[170px]  truncate text-left transition-all ">
                        {{ $package->title }}</p>
                </div>
                <div x-on:click="show_sidebar=false" class="btn bg-white hover:bg-slate-200 border-none text-amber-400">
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
                    @foreach ($soal as $i => $item)
                        <li>
                            <button x-on:click="page={{ $i + 1 }}"
                                @if ($item->result == 0) class="relative flex flex-row items-center h-11 w-60 focus:outline-none border-l-4 border-transparent  pr-6 @if (
                                    $item->result == 0 &&
                                        session($collection->slug)['activities'][$package->slug]['is_finished'] == true &&
                                        $package->show_correction_quiz == 1) bg-red-400 text-white @else hover:bg-gray-50  hover:text-gray-800 hover:border-amber-500 @endif
                            rounded-r-md" @else
                                class="relative flex flex-row items-center h-11 w-60 focus:outline-none border-l-4 border-transparent  pr-6 @if (
                                    $item->result == 1 &&
                                        session($collection->slug)['activities'][$package->slug]['is_finished'] == true &&
                                        $package->show_correction_quiz == 1) bg-green-400 text-white @else hover:bg-gray-50  hover:text-gray-800 hover:border-amber-500 @endif rounded-r-md "
                                @endif
                                :class="page == {{ $i + 1 }} ? 'bg-gray-100 text-gray-800 border-amber-400' : ''">
                                <span class="inline-flex justify-center items-center ml-4">
                                    @if ($item->type == 'isian' || $item->type == 'pilihan_ganda')
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
                                <span class="ml-2 text-sm tracking-wide truncate">{{ $item->title }}</span>
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
                <div x-on:click="show_sidebar=true" class="btn bg-amber-400 hover:bg-amber-600 border-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>

                <div class="tooltip tooltip-bottom " data-tip="{{ $package->title }}">
                    <div class="">
                        <p
                            class="font-bold text-white normal-case lg:text-xl lg:max-w-[300px] max-w-[120px] truncate text-left ">
                            {{ $package->title }}</p>
                    </div>
                </div>
            </div>
            <div class="navbar-center hidden lg:flex">
            </div>
            <div class="navbar-end">
                <a class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm " id="progress">
                    <p class="animate-[mantul_1s_ease-in-out]" x-text="progress()"></p>
                </a>
                <button id="exit" class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"><i
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
    <div id="capture"
        class="bg-slate-100 mx-auto my-auto h-screen lg:w-[1000px] min-[200px]:w-full pb-[100px] overflow-y-auto lg:p-9 p-3  shadow-xl">
        <div class="h-[70px]">

        </div>
        @if ($package->timer > 0 && session($collection->slug)['activities'][$package->slug]['is_finished'] == false)
            <div>
                <div class="flex justify-end">
                    <div class="bg-white rounded-md px-4 py-2">
                        Sisa waktu <span id="countdown">00:00</span>
                    </div>
                </div>
                <script>
                    (function() {
                        const countdown = document.getElementById('countdown');
                        let time = {{ (int) session($collection->slug)['activities'][$package->slug]['expired_time'] - time() }};
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
                                        `/play/{{ $collection->slug }}/${App.abstract.package_id}/save`;
                                }
                            });
                            setTimeout(() => {
                                sessionStorage.clear();
                                window.location.href =
                                    `/play/{{ $collection->slug }}/${App.abstract.package_id}/save`;
                            }, 5000)
                        }
                    })()
                </script>
            </div>
        @endif
        @foreach ($soal as $i => $item)
            <div class="main" x-show="page=={{ $i + 1 }}" x-transition.duration.150ms>
                <div id="content">
                    <div class="bg-white mb-8 mt-5 p-5 border-l-8 border-amber-400 rounded-r-lg ">
                        <h1 class="text-2xl lg:text-5xl font-bold text-slate-600">{{ $item->title }}</h1>
                    </div>
                    @if ($item->image_path != null)
                        <img src="/{{ $item->image_path }}" class="lg:w-[500px] mx-auto mb-4">
                    @endif

                    <div class="p-4 bg-white rounded-lg mt-3 border border-slate-200">
                        {!! $item->content !!}
                    </div>
                    <div>
                        @if ($item->type == 'pilihan_ganda')
                            <div>
                                <br>
                                @if ($item->a)
                                    <div class="choice flex items-center mb-4">
                                        <input type="radio" id="a-{{ $item->id }}"
                                            name="answer-{{ $item->id }}" data-question_id="{{ $item->id }}"
                                            @if ($item->correct_answer == 'a') data-result="true" @else data-result="false" @endif
                                            @if ($item->answer == 'a') checked @endif
                                            class="peer hidden h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            x-on:click="user_answer=this.event.target.value" value="a"
                                            @disabled(session($collection->slug)['activities'][$package->slug]['is_finished'] == true)>
                                        <label
                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked:bg-blue-200"
                                            for="a-{{ $item->id }}">a.
                                            {{ $item->a }}</label><br>
                                    </div>
                                @endif
                                @if ($item->b)
                                    <div class="choice flex items-center mb-4">
                                        <input type="radio" id="b-{{ $item->id }}"
                                            name="answer-{{ $item->id }}" data-question_id="{{ $item->id }}"
                                            @if ($item->correct_answer == 'b') data-result="true" @else data-result="false" @endif
                                            @if ($item->answer == 'b') checked @endif
                                            class="peer hidden  h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            x-on:click="user_answer=this.event.target.value" value="b"
                                            @disabled(session($collection->slug)['activities'][$package->slug]['is_finished'] == true)>
                                        <label
                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked:bg-blue-200"
                                            for="b-{{ $item->id }}">b.
                                            {{ $item->b }}</label><br>
                                    </div>
                                @endif
                                @if ($item->c)
                                    <div class="choice flex items-center mb-4">
                                        <input type="radio" id="c-{{ $item->id }}"
                                            name="answer-{{ $item->id }}" data-question_id="{{ $item->id }}"
                                            @if ($item->correct_answer == 'c') data-result="true" @else data-result="false" @endif
                                            @if ($item->answer == 'c') checked @endif
                                            class="peer hidden  h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            x-on:click="user_answer=this.event.target.value" value="c"
                                            @disabled(session($collection->slug)['activities'][$package->slug]['is_finished'] == true)>
                                        <label
                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked:bg-blue-200"
                                            for="c-{{ $item->id }}">c.
                                            {{ $item->c }}</label><br>
                                    </div>
                                @endif
                                @if ($item->d)
                                    <div class="choice flex items-center mb-4">
                                        <input type="radio" id="d-{{ $item->id }}"
                                            name="answer-{{ $item->id }}" data-question_id="{{ $item->id }}"
                                            @if ($item->correct_answer == 'd') data-result="true" @else data-result="false" @endif
                                            @if ($item->answer == 'd') checked @endif
                                            class="peer hidden  h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            x-on:click="user_answer=this.event.target.value" value="d"
                                            @disabled(session($collection->slug)['activities'][$package->slug]['is_finished'] == true)>
                                        <label
                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked:bg-blue-200"
                                            for="d-{{ $item->id }}">d.
                                            {{ $item->d }}</label><br>
                                    </div>
                                @endif
                                @if ($item->e)
                                    <div class="choice flex items-center mb-4">
                                        <input type="radio" id="e-{{ $item->id }}"
                                            name="answer-{{ $item->id }}" data-question_id="{{ $item->id }}"
                                            @if ($item->correct_answer == 'e') data-result="true" @else data-result="false" @endif
                                            @if ($item->answer == 'e') checked @endif
                                            class="peer hidden  h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                            x-on:click="user_answer=this.event.target.value" value="e"
                                            @disabled(session($collection->slug)['activities'][$package->slug]['is_finished'] == true)>
                                        <label
                                            class="text-sm font-medium text-gray-900 ml-2 block w-full py-3 px-2 rounded-md border-[1px] peer-checked:bg-blue-200"
                                            for="e-{{ $item->id }}">e.
                                            {{ $item->e }}</label>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    @if (
                                        $package->show_correction_quiz == 1 &&
                                            $package->topic_type == 'kuis' &&
                                            session($collection->slug)['activities'][$package->slug]['is_finished'] == true)
                                        @if ($item->result == true)
                                            <div>
                                                <div id="{{ $i }}-alert"
                                                    class="card w-full bg-green-400 ">
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
                                        @if ($item->result == false)
                                            <div>
                                                <div id="{{ $i }}-alert"
                                                    class="card w-full  bg-red-400  ">
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
                                    @endif

                                </div>

                            </div>
                        @endif
                    </div>
                </div>

            </div>
        @endforeach
        <div class="h-[70px] lg:block hidden">

        </div>
    </div>

    {{-- endmain --}}
    <div class="fixed bottom-0 w-full">

        <footer class="footer footer-center p-4 bg-amber-400 shadow-lg ">
            <div class="lg:w-[1000px] mx-auto flex flex-row justify-center">
                <div id="add_prev">
                    <button id="prev_button" @click="prev"
                        class="btn bg-amber-400 border-none hover:bg-amber-600 float-left">
                        <i class="bi text-3xl text-white float-right bi-arrow-left-circle-fill"></i>
                    </button>
                </div>
                <div class="text-white text-center">
                    <button id="next" @click="next"
                        class="btn bg-yellow-600 border-none hover:bg-amber-600 normal-case rounded-full outline-amber-600 ">Berikutnya</button>
                </div>
            </div>
        </footer>

    </div>
    </div>
    <script>
        async function submit_jawaban(jawaban) {
            let responses = await fetch("/api/collection/submit-jawaban-kuis/{{ $collection->slug }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(jawaban)
            }).then((res) => {

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
            }).then((json) => {

            });

        }
        let choice = document.querySelectorAll('input[type="radio"]');
        choice.forEach(el => {
            el.addEventListener('click', function(e) {
                let question_id = e.target.dataset.question_id;
                let result = e.target.dataset.result;
                if (e.target.dataset.result == 'true') {
                    result = true
                } else if (e.target.dataset.result == 'false') {
                    result = false
                }
                let user_answer = e.target.value;
                submit_jawaban({
                    result: result,
                    user_answer: user_answer,
                    soal_id: question_id,
                    ...App.abstract
                })
            })
        });
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('main_data', () => ({
                page: 1,
                async next() {
                    let next_page = this.page + 1
                    if (next_page <= App.page_total) {
                        this.page = this.page + 1
                    } else {
                        let user_answer_total = 0
                        @if (session($collection->slug)['activities'][$package->slug]['is_finished'] == false)
                            let saved = await this.get_user_saved_answer();
                            user_answer_total = saved.length
                        @else
                            user_answer_total = App.quiz_total;
                        @endif
                        if (App.quiz_total <= user_answer_total) {
                            @if (session($collection->slug)['activities'][$package->slug]['is_finished'] == true)
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
                                        sessionStorage.clear();
                                        window.location.href =
                                            `/play/{{ $collection->slug }}/${App.abstract.package_id}/save`;
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
                                        sessionStorage.clear();
                                        window.location.href =
                                            `/play/{{ $collection->slug }}/${App.abstract.package_id}/save`;
                                    }
                                });
                            @endif
                        } else {
                            Swal.fire(
                                "Mau keluar?",
                                "Sebelum keluar, Kamu harus menjawab semua pertanyaan",
                                "info"
                            );
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
                        `/api/collection/get-saved-answer/${App.abstract.u_id}/${App.abstract.package_id}`, {
                            method: 'GET',
                            headers: {
                                "Content-Type": "application/json",
                                "Content-Type": "application/json"
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
                    return data.body;
                },
                async submit_jawaban(jawaban) {
                    App.saved_answer.push(jawaban);
                    let responses = await fetch("/api/submit-jawaban", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Content-Type": "application/json"
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
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Network Error'
                        })
                    }
                },
                prev() {
                    let next_page = this.page - 1
                    if (next_page >= 1) {
                        this.page = this.page - 1
                    }
                },
                show_sidebar: false,
                play_sound(bool) {
                    @if ($package->show_correction_lesson == 1)
                        let true_sound = new Audio('{{ asset('sound/true.mp3') }}');
                        let false_sound = new Audio('{{ asset('sound/false.mp3') }}');
                        if (bool == true) {
                            true_sound.play();
                        } else if (bool == false) {
                            false_sound.play()
                        }
                    @endif
                }
            }))
        })
        document.getElementById("exit").addEventListener("click", function() {
            Swal.fire({
                title: "Keluar?",
                text: "Yakin mau keluar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Keluar",
            }).then((result) => {
                if (result.isConfirmed) {
                    sessionStorage.clear();
                    window.location.href = `/play/{{ $collection->slug }}`;
                }
            });
        });

        @if (session($collection->slug)['activities'][$package->slug]['is_finished'] == true)
            function clear_history(slug) {
                Swal.fire({
                    title: "Ulangi?",
                    text: "Riwayat Pengerjaan saat ini akan hilang",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Restart",
                }).then((result) => {
                    if (result.isConfirmed) {
                        sessionStorage.clear();
                        window.location.href = `/clear_history/${slug}`;
                    }
                });
            }
        @endif
    </script>
</body>

</html>
