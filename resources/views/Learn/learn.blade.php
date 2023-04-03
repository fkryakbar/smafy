<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Learn</title>
</head>

<body>
    {{-- navbar --}}
    <div id="coba" class="navbar fixed top-0 w-full bg-amber-400 shadow-xl z-50">
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
            <a class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm " id="progress">
                <p class="animate-[mantul_1s_ease-in-out]">Progress : 0%</p>
            </a>
            <button id="exit" class="btn btn-ghost text-white normal-case text-lg min-[200px]:btn-sm"><i
                    class="bi bi-box-arrow-right text-2xl"></i></button>
        </div>
    </div>

    {{-- endnavbar --}}
    {{-- main --}}
    <script>
        const saved_answer = [];
        const soal_total = {{ count($soal) }}
        const quiz_total = {{ count($quiz_total) }}
        const package_slug = '{{ $package->slug }}'
    </script>
    <div id="capture"
        class="bg-slate-100 mx-auto my-auto h-screen lg:w-[1000px] min-[200px]:w-full pt-[100px] py-9 pb-[100px] overflow-y-auto p-9 shadow-xl">
        @foreach ($soal as $i => $item)
            <div class="main">
                <div id="content" class="animate-[wiggle_1.5s_ease-in-out]">
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
                        <textarea name="answer" id="{{ $i }}-isian" class="textarea textarea-bordered w-full mt-3"
                            placeholder="Masukkan jawaban"></textarea>
                        <div class="mt-3">
                            <div id="{{ $i }}-alert" class="card w-full shadow-xl hidden">
                                <div class="card-body text-white">
                                    <h2 class="card-title">Penjelasan</h2>
                                    <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                    <p>{{ $item->reasons }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full justify-center">
                            <button id="{{ $i }}-button-isian"
                                class="btn bg-green-400 border-none hover:bg-green-600 mt-5">Submit Jawaban</button>
                        </div>

                        <script></script>
                    @endif
                    @if ($item->type == 'pilihan_ganda')
                        <br>
                        <input type="radio" id="a" name="answer" class="answer-{{ $i }}"
                            value="a">
                        <label for="a">a. {{ $item->a }}</label><br>
                        <input type="radio" id="b" name="answer" class="answer-{{ $i }}"
                            value="b">
                        <label for="b">b. {{ $item->b }}</label><br>
                        <input type="radio" id="c" name="answer" class="answer-{{ $i }}"
                            value="c">
                        <label for="c">c. {{ $item->c }}</label><br>
                        <input type="radio" id="d" name="answer" class="answer-{{ $i }}"
                            value="d">
                        <label for="d">d. {{ $item->d }}</label>
                        <div class="mt-3">
                            <div id="{{ $i }}-alert" class="card w-full shadow-xl hidden ">
                                <div class="card-body text-white">
                                    <h2 class="card-title">Penjelasan</h2>
                                    <p>Jawaban benar : {{ $item->correct_answer }} </p>
                                    <p>{{ $item->reasons }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full justify-center">
                            <button id="{{ $i }}-button-isian"
                                class="btn bg-green-400 border-none hover:bg-green-600 mt-5">Submit Jawaban</button>
                        </div>

                        <script></script>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

    {{-- endmain --}}
    <div class="fixed bottom-0 w-full">

        <footer class="footer footer-center p-4 bg-amber-400 shadow-lg ">
            <div class="lg:w-[1000px] mx-auto flex flex-row justify-center">
                <div id="add_prev">
                    <button id="prev_button" class="btn bg-amber-400 border-none hover:bg-amber-600 float-left">
                        <i class="bi text-3xl text-white float-right bi-arrow-left-circle-fill"></i>
                    </button>
                </div>
                <div class="text-white text-center">
                    <button id="next"
                        class="btn bg-yellow-600 border-none hover:bg-amber-600 normal-case rounded-full outline-amber-600 ">Berikutnya</button>
                </div>
            </div>
        </footer>

    </div>
    </div>
    <script>
        @foreach ($soal as $i => $item)
            @if ($item->type == 'isian')
                let field_{{ $i }} = document.getElementById('{{ $i }}-isian');
                let button_{{ $i }} = document.getElementById('{{ $i }}-button-isian');
                let alert_{{ $i }} = document.getElementById('{{ $i }}-alert');
                button_{{ $i }}.addEventListener('click', function() {
                    if (field_{{ $i }}.value == `{{ $item->correct_answer }}`) {
                        alert_{{ $i }}.classList.remove('hidden');
                        alert_{{ $i }}.classList.add('bg-green-400');

                        field_{{ $i }}.disabled = true
                        button_{{ $i }}.disabled = true

                        saved_answer.push({
                            u_id: `{{ session('siswa')['u_id'] }}`,
                            package_id: `{{ $package->slug }}`,
                            soal_id: `{{ $item->id }}`,
                            user_answer: field_{{ $i }}.value,
                            result: true
                        })
                    } else if (field_{{ $i }}.value == ``) {
                        alert_{{ $i }}.innerHTML = `<div class="alert alert-warning shadow-lg">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                            <span>Jawaban tidak boleh kosong</span>
                                                        </div>
                                                    </div>`
                    } else {
                        alert_{{ $i }}.classList.remove('hidden');
                        alert_{{ $i }}.classList.add('bg-red-400');


                        field_{{ $i }}.disabled = true
                        button_{{ $i }}.disabled = true

                        saved_answer.push({
                            u_id: `{{ session('siswa')['u_id'] }}`,
                            package_id: `{{ $package->slug }}`,
                            soal_id: `{{ $item->id }}`,
                            user_answer: field_{{ $i }}.value,
                            result: false
                        })


                    }




                })
            @endif

            @if ($item->type == 'pilihan_ganda')
                let button_{{ $i }} = document.getElementById('{{ $i }}-button-isian');
                let alert_{{ $i }} = document.getElementById('{{ $i }}-alert')
                button_{{ $i }}.addEventListener('click', function() {
                    let field_{{ $i }} = document.querySelector('.answer-{{ $i }}:checked');
                    if (field_{{ $i }} == null) {
                        alert_{{ $i }}.innerHTML = `<div class="alert alert-warning shadow-lg">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                            <span>Jawaban tidak boleh kosong</span>
                                                        </div>
                                                    </div>`

                    } else if (field_{{ $i }}.value == `{{ $item->correct_answer }}`) {
                        alert_{{ $i }}.classList.remove('hidden');
                        alert_{{ $i }}.classList.add('bg-green-400');

                        field_{{ $i }}.disabled = true
                        button_{{ $i }}.disabled = true

                        saved_answer.push({
                            u_id: `{{ session('siswa')['u_id'] }}`,
                            package_id: `{{ $package->slug }}`,
                            soal_id: `{{ $item->id }}`,
                            user_answer: field_{{ $i }}.value,
                            result: true
                        })
                    } else {
                        alert_{{ $i }}.classList.remove('hidden');
                        alert_{{ $i }}.classList.add('bg-red-400');

                        field_{{ $i }}.disabled = true
                        button_{{ $i }}.disabled = true
                        saved_answer.push({
                            u_id: `{{ session('siswa')['u_id'] }}`,
                            package_id: `{{ $package->slug }}`,
                            soal_id: `{{ $item->id }}`,
                            user_answer: field_{{ $i }}.value,
                            result: false
                        })
                    }




                })
            @endif
        @endforeach
    </script>
    <script src="{{ asset('js/script3.js') }}"></script>
</body>

</html>
