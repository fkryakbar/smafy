<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Learn</title>
</head>

<body class="relative" x-data="main_data">
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
            quiz_total: {{ count($quiz_total) }},
            abstract: {
                u_id: '{{ session('siswa')['u_id'] }}',
                package_id: '{{ $package->slug }}',
            },
            saved_answer: []

        }
    </script>
    {{-- sidebar --}}
    <div x-show="show_sidebar" x-transition.opacity x-cloak x-on:click.outside="show_sidebar=false"
        class="min-h-screen absolute z-[100] flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full border-r">
            <div class="flex justify-between py-5 pl-3 items-center pr-5 h-14 border-b text-amber-400">
                <div class="tooltip tooltip-bottom" data-tip="{{ $package->title }}">
                    <p class="font-bold text-amber-400 normal-case max-w-[200px]  truncate text-left transition-all ">
                        {{ $package->title }}</p>
                </div>
                <div x-on:click="show_sidebar=false">
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
                                class="relative flex flex-row items-center h-11 w-60 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-amber-500 pr-6 "
                                :class="page == {{ $i + 1 }} ? 'bg-gray-50 text-gray-800 border-amber-500' : ''">
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

                </ul>
            </div>
        </div>
    </div>
    {{-- navbar --}}
    <div id="coba" class="navbar fixed top-0 w-full bg-amber-400 shadow-xl z-50">
        <div class="navbar-start text-white gap-2">
            <div x-on:click="show_sidebar=true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>

            <div class="tooltip tooltip-bottom" data-tip="{{ $package->title }}">
                <p
                    class="font-bold text-white normal-case min-[600px]:text-xl min-[600px]:w-[400px] min-[200px]:w-[200px] min-[200px]:text-sm truncate text-left transition-all ">
                    {{ $package->title }}</p>
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

    {{-- endnavbar --}}
    {{-- main --}}
    <div id="capture"
        class="bg-slate-100 mx-auto my-auto h-screen lg:w-[1000px] min-[200px]:w-full pt-[100px] py-9 pb-[100px] overflow-y-auto p-9 shadow-xl">
        @foreach ($soal as $i => $item)
            <div class="main" x-show="page=={{ $i + 1 }}" x-transition>
                <div id="content">
                    <div class="bg-white mb-8 mt-5 p-5 border-l-8 border-amber-400 rounded-r-lg ">
                        <h1 class="min-[200px]:text-4xl text-5xl font-bold text-slate-600">{{ $item->title }}</h1>
                    </div>
                    @if ($item->image_path != null)
                        <img src="/{{ $item->image_path }}" class="lg:w-[500px] mx-auto mb-4">
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
                        <div x-data="{
                            answered: false,
                            soal_id: `{{ $item->id }}`,
                            key: '{{ $item->correct_answer }}',
                            answer_status: '',
                            user_answer: '',
                            warning: false,
                            warning_text: 'Jawaban tidak boleh kosong',
                            submit() {
                                this.warning = false;
                                if (this.user_answer == '') {
                                    this.warning = true;
                                } else if (this.user_answer == this.key) {
                                    this.answered = true;
                                    this.answer_status = true;
                                    App.saved_answer.push({ result: true, user_answer: this.user_answer, soal_id: this.soal_id, ...App.abstract });
                                    play_sound(true);
                                } else if (this.user_answer != this.key) {
                                    this.answered = true;
                                    this.answer_status = false;
                                    App.saved_answer.push({ result: false, user_answer: this.user_answer, soal_id: this.soal_id, ...App.abstract });
                                    play_sound(false);
                                }
                            }
                        }">

                            <textarea name="answer" id="{{ $i }}-isian" x-model="user_answer" :disabled="answered ? true : false"
                                class="textarea textarea-bordered w-full mt-3" placeholder="Masukkan jawaban"></textarea>
                            <div class="mt-3">
                                <div x-show="answered" x-transition>
                                    <div :class="answer_status ? 'bg-green-400' : 'bg-red-400'"
                                        id="{{ $i }}-alert" class="card w-full">
                                        <div class="card-body text-white">
                                            <h2 class="card-title">Penjelasan</h2>
                                            <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                            <p>{{ $item->reasons }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="warning" x-transition class="mt-3">
                                    <div id="{{ $i }}-alert" class="card w-full bg-red-400">
                                        <div class="card-body text-white">
                                            <h2 class="card-title">Peringatan!</h2>
                                            <p x-text="warning_text"></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-full justify-center">
                                <button id="{{ $i }}-button-isian" @click="submit"
                                    :disabled="answered ? true : false"
                                    class="btn bg-green-400 border-none hover:bg-green-600 mt-5">Submit
                                    Jawaban</button>
                            </div>
                        </div>
                    @endif
                    <div>
                        @if ($item->type == 'pilihan_ganda')
                            <div x-data="{
                                answered: false,
                                soal_id: `{{ $item->id }}`,
                                key: '{{ $item->correct_answer }}',
                                answer_status: '',
                                user_answer: '',
                                warning: false,
                                warning_text: 'Jawaban tidak boleh kosong',
                                submit() {
                                    this.warning = false;
                                    if (this.user_answer == '') {
                                        this.warning = true;
                                    } else if (this.user_answer == this.key) {
                                        this.answered = true;
                                        this.answer_status = true;
                                        App.saved_answer.push({ result: true, user_answer: this.user_answer, soal_id: this.soal_id, ...App.abstract });
                                        play_sound(true);
                                    } else if (this.user_answer != this.key) {
                                        this.answered = true;
                                        this.answer_status = false;
                                        App.saved_answer.push({ result: false, user_answer: this.user_answer, soal_id: this.soal_id, ...App.abstract });
                                        play_sound(false);
                                    }
                                }
                            }">

                                <br>
                                <input type="radio" id="a" name="answer"
                                    class="answer-{{ $i }}"
                                    x-on:click="user_answer=this.event.target.value" value="a"
                                    :disabled="answered ? true : false">
                                <label for="a">a. {{ $item->a }}</label><br>
                                <input type="radio" id="b" name="answer"
                                    class="answer-{{ $i }}"
                                    x-on:click="user_answer=this.event.target.value" value="b"
                                    :disabled="answered ? true : false">
                                <label for="b">b. {{ $item->b }}</label><br>
                                <input type="radio" id="c" name="answer"
                                    class="answer-{{ $i }}"
                                    x-on:click="user_answer=this.event.target.value" value="c"
                                    :disabled="answered ? true : false">
                                <label for="c">c. {{ $item->c }}</label><br>
                                <input type="radio" id="d" name="answer"
                                    class="answer-{{ $i }}"
                                    x-on:click="user_answer=this.event.target.value" value="d"
                                    :disabled="answered ? true : false">
                                <label for="d">d. {{ $item->d }}</label>
                                <div class="mt-3">
                                    <div x-show="answered" x-transition>
                                        <div :class="answer_status ? 'bg-green-400' : 'bg-red-400'"
                                            id="{{ $i }}-alert" class="card w-full">
                                            <div class="card-body text-white">
                                                <h2 class="card-title">Penjelasan</h2>
                                                <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                                <p>{{ $item->reasons }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="warning" x-transition class="mt-3">
                                        <div id="{{ $i }}-alert" class="card w-full bg-red-400">
                                            <div class="card-body text-white">
                                                <h2 class="card-title">Peringatan!</h2>
                                                <p x-text="warning_text"></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex w-full justify-center">
                                    <button id="{{ $i }}-button-isian" @click="submit"
                                        :disabled="answered ? true : false"
                                        class="btn bg-green-400 border-none hover:bg-green-600 mt-5">Submit
                                        Jawaban</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        @endforeach
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
        document.addEventListener('alpine:init', () => {
            Alpine.data('main_data', () => ({
                is_saved_with_session() {
                    if (sessionStorage.getItem("is_saved") == null) {
                        return "false"
                    } else if (sessionStorage.getItem("is_saved") == "true") {
                        return "true"
                    } else if (sessionStorage.getItem("is_saved") == "false") {
                        return "false"
                    }
                },
                page: 1,
                async next() {
                    let next_page = this.page + 1
                    if (next_page <= App.page_total) {
                        this.page = this.page + 1
                    } else {
                        if (App.quiz_total == App.saved_answer.length) {
                            if (this.is_saved_with_session() == "false") {
                                await this.submit_jawaban(App.saved_answer);
                            }
                            Swal.fire({
                                title: "Sudah Selesai!",
                                text: "Tekan Lihat Skor untuk melihat skor kamu",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Lihat Skor",
                                cancelButtonText: "Kembali",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    sessionStorage.clear();
                                    window.location.href =
                                        `/learn/${App.abstract.package_id}/result`;
                                }
                            });
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
                    return `Progress : ${Math.round(this.page/App.page_total*100)}%`
                },
                async submit_jawaban(jawaban) {
                    let responses = await fetch("/api/submit-jawaban", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(jawaban)
                    })
                    if (responses.status == 200) {
                        sessionStorage.setItem("is_saved", 'true')
                    }
                    return responses;
                },
                prev() {
                    let next_page = this.page - 1
                    if (next_page >= 1) {
                        this.page = this.page - 1
                    }
                },
                show_sidebar: false,
                play_sound(bool) {
                    let true_sound = new Audio('{{ asset('sound/true.mp3') }}');
                    let false_sound = new Audio('{{ asset('sound/false.mp3') }}');
                    if (bool == true) {
                        true_sound.play();
                    } else if (bool == false) {
                        false_sound.play()
                    }
                }
            }))
        })
        document.getElementById("exit").addEventListener("click", function() {
            Swal.fire({
                title: "Yakin mau keluar?",
                text: "Progress sekarang tidak akan disimpan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Keluar",
            }).then((result) => {
                if (result.isConfirmed) {
                    sessionStorage.clear();
                    window.location.href = "/flush";
                }
            });
        });
    </script>
    <script></script>
</body>

</html>
