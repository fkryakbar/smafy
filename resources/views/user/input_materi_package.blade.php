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
            <main class="h-full overflow-y-auto mr-5">
                <div class="container px-6 mx-auto grid">
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
                                <a href="/dashboard/topik/{{ $materi->slug }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Slide
                                </a>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Tambah Slide
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Tambah Slide : {{ $materi->title }}
                        </h2>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-error shadow-sm mt-2">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $error }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @endif

                        <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Judul Slide</span>
                                </label>
                                <input type="text" name="title" placeholder="Judul Slide"
                                    class="input input-bordered w-full" value="{{ old('title') }}" />
                            </div>
                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Tipe Slide : </span>
                                </label>
                                <select id="type" name="type" class="select select-bordered">
                                    @if ($materi->topic_type == 'materi')
                                        <option value="materi" @if (old('type') == 'materi') selected @endif>
                                            Penjelasan
                                        </option>
                                        <option value="youtube_video" @if (old('type') == 'youtube_video') selected @endif>
                                            Video Youtube</option>
                                        <option value="isian" @if (old('type') == 'isian') selected @endif>Soal
                                            Isian
                                        </option>
                                    @endif
                                    <option value="pilihan_ganda" @if (old('type') == 'pilihan_ganda') selected @endif>Soal
                                        Pilihan Ganda</option>
                                </select>
                            </div>
                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Cover</span>
                                </label>
                                <input type="file" name="image"
                                    class="file-input file-input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Konten</span>
                                </label>
                                <textarea name="content" id="content" class="textarea textarea-bordered hidden" placeholder="Masukkan isi slide"></textarea>
                                <div id="toolbar-content" class="mt-3"></div>
                                <div class="border-2">
                                    <div id="content-editor">
                                        {!! old('content') !!}
                                    </div>
                                </div>
                            </div>
                            <div id="youtube_link_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Link Video Youtube</span>
                                </label>
                                <input type="text" name="youtube_link" placeholder="Masukkan Link"
                                    class="input input-bordered w-full" value="{{ old('youtube_link') }}" />
                            </div>
                            <div id="pilihan_ganda_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Opsi</span>
                                </label>
                                <input type="text" placeholder="Opsi a" name="a"
                                    class="input input-bordered w-full" value="{{ old('a') }}" />
                                <input type="text" placeholder="Opsi b" name="b"
                                    class="input input-bordered w-full mt-3" value="{{ old('b') }}" />
                                <input type="text" placeholder="Opsi c" name="c"
                                    class="input input-bordered w-full mt-3" value="{{ old('c') }}" />
                                <input type="text" placeholder="Opsi d" name="d"
                                    class="input input-bordered w-full mt-3" value="{{ old('d') }}" />
                                <input type="text" placeholder="Opsi e" name="e"
                                    class="input input-bordered w-full mt-3" value="{{ old('e') }}" />
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <select id="type" name="correct_answer_pilihan_ganda"
                                    class="select select-bordered">
                                    <option value="a" @if (old('correct_answer_pilihan_ganda') == 'a') selected @endif>a</option>
                                    <option value="b" @if (old('correct_answer_pilihan_ganda') == 'b') selected @endif>b</option>
                                    <option value="c" @if (old('correct_answer_pilihan_ganda') == 'c') selected @endif>c</option>
                                    <option value="d" @if (old('correct_answer_pilihan_ganda') == 'd') selected @endif>d
                                    </option>
                                    <option value="e" @if (old('correct_answer_pilihan_ganda') == 'e') selected @endif>e
                                    </option>
                                </select>
                            </div>
                            <div id="isian_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <input type="text" name="correct_answer_isian"
                                    placeholder="Masukkan jawaban benar" class="input input-bordered w-full"
                                    value="{{ old('correct_answer_isian') }}" />
                            </div>
                            <div id="reasons" class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Penjelasan</span>
                                </label>
                                <textarea name="reasons" class="textarea textarea-bordered" placeholder="Masukkan Penjelasan jawaban">{{ old('reasons') }}</textarea>
                            </div>
                            <button type="submit" id="simpan"
                                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3">Simpan</button>
                        </form>
                    </div>



                </div>
            </main>

        </div>

    </div>
    <script>
        const content = document.getElementById('content');
        const youtube_box = document.getElementById('youtube_link_box')
        const pilihan_ganda_box = document.getElementById('pilihan_ganda_box')
        const isian_box = document.getElementById('isian_box')
        const reasons = document.getElementById('reasons')
        DecoupledEditor
            .create(document.querySelector('#content-editor'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-content');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                editor = editor
                const simpan = document.getElementById('simpan')
                simpan.addEventListener('click', () => {
                    content.value = editor.getData()
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        const type = document.getElementById('type');
        type.addEventListener('change', () => {
            change_type(type.value)
        })
        change_type()

        function change_type() {
            if (type.value == 'materi') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.add('hidden')
            }

            if (type.value == 'youtube_video') {
                youtube_box.classList.remove('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.add('hidden')
            }
            if (type.value == 'pilihan_ganda') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.remove('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.remove('hidden')
            }
            if (type.value == 'isian') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.remove('hidden');
                reasons.classList.remove('hidden')
            }
        }
    </script>

</body>

</html>
