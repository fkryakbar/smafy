<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Update Slide</title>
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
                                <a href="/dashboard/lessons/{{ $lesson->slug }}/{{ $lesson->sublessons[0]->slug }}">
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
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                Update slide
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Update Slide : {{ $lesson->sublessons[0]->title }}
                        </h2>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-6">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-error shadow-sm mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $error }}</span>
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
                                    class="input input-bordered w-full" value="{{ $slide->title }}" />
                            </div>
                            <div class="form-control w-full my-3">
                                {{-- <label class="label">
                                    <span class="label-text">Tipe Slide : </span>
                                </label> --}}
                                <ul class="grid w-full gap-6 lg:grid-cols-6">
                                    <li class="flex justify-center items-center h-full">
                                        <input type="radio" id="penjelasan" name="type" value="penjelasan"
                                            @checked($slide->type == 'penjelasan' || !$slide->type) class="hidden peer" />
                                        <label for="penjelasan"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/penjelasan.png" alt="penjelasan"
                                                    width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Penjelasan
                                                </div>
                                                <div class="text-center text-xs">Slide berupa text dan gambar</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <input type="radio" id="youtube" name="type" value="youtube_video"
                                            @checked($slide->type == 'youtube_video') class="hidden peer" />
                                        <label for="youtube"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/youtube.png" alt="penjelasan" width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Video Youtube
                                                </div>
                                                <div class="text-center text-xs">Slide yang berisi video youtube</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <input type="radio" id="file_attachment" name="type"
                                            @checked($slide->type == 'file_attachment') value="file_attachment" class="hidden peer" />
                                        <label for="file_attachment"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/file_upload.png" alt="penjelasan"
                                                    width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Upload File
                                                </div>
                                                <div class="text-center text-xs">Siswa dapat melampirkan hasil kerja
                                                    mereka</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <input type="radio" id="short_answer" name="type" value="short_answer"
                                            @checked($slide->type == 'short_answer') class="hidden peer" />
                                        <label for="short_answer"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/short_answer.png" alt="penjelasan"
                                                    width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Jawaban Singkat
                                                </div>
                                                <div class="text-center text-xs">Soal dengan Jawaban singkat</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <input type="radio" id="long_answer" name="type" value="long_answer"
                                            @checked($slide->type == 'long_answer') class="hidden peer" />
                                        <label for="long_answer"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/long_answer.png" alt="penjelasan"
                                                    width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Paragraf
                                                </div>
                                                <div class="text-center text-xs">Soal dengan jawaban panjang</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <input type="radio" id="multiple_choice" name="type"
                                            @checked($slide->type == 'multiple_choice') value="multiple_choice"
                                            class="hidden peer" />
                                        <label for="multiple_choice"
                                            class="items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                                            <div class="flex flex-col items-center justify-center">
                                                <img src="/image/slideType/multiple_choice.png" alt="penjelasan"
                                                    width="50px">
                                                <div class="text-sm font-bold  py-1 px-2 rounded-full">
                                                    Pilihan Ganda
                                                </div>
                                                <div class="text-center text-xs">Soal dengan Pilihan ganda</div>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                                {{-- <select id="type" name="type" class="select select-bordered">
                                    @if ($lesson->sublessons[0]->sublesson_type == 'materi')
                                        <option value="penjelasan" @if ($slide->type == 'penjelasan') selected @endif>
                                            Penjelasan
                                        </option>
                                        <option value="youtube_video"
                                            @if ($slide->type == 'youtube_video') selected @endif>
                                            Video Youtube</option>
                                        <option value="file_attachment"
                                            @if (old('type') == 'file_attachment') selected @endif>
                                            Upload File</option>
                                        <option value="short_answer" @if (old('type') == 'short_answer') selected @endif>
                                            Soal
                                            Isian Pendek
                                        </option>
                                        <option value="long_answer" @if (old('type') == 'long_answer') selected @endif>
                                            Soal
                                            Isian Panjang
                                        </option>
                                    @endif
                                    <option value="multiple_choice" @if (old('type') == 'multiple_choice') selected @endif>
                                        Soal
                                        Pilihan Ganda</option>
                                </select> --}}
                            </div>
                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Cover</span>
                                </label>
                                @if ($slide->image_path)
                                    <img src="/{{ $slide->image_path }}" class="lg:w-[300px] mx-auto mb-4">
                                    <div class="form-control w-full mt-3">
                                        <label class="label">
                                            <span class="label-text">Hapus Gambar</span>
                                            <input type="checkbox" value="1" name="delete_image"
                                                class="toggle toggle-warning" />
                                        </label>
                                    </div>
                                @endif
                                <input type="file" name="image"
                                    class="file-input file-input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control w-full mt-3">
                                <style>
                                    .ck-editor__editable {
                                        min-height: 300px
                                    }
                                </style>
                                <label class="label">
                                    <span class="label-text">Konten</span>
                                </label>
                                <textarea name="content" id="content" class="textarea textarea-bordered hidden" placeholder="Masukkan isi slide"></textarea>
                                <div id="toolbar-content" class="mt-3"></div>
                                <div class="border-2">
                                    <div id="content-editor">
                                        {!! $slide->content !!}
                                    </div>
                                </div>
                            </div>
                            <div id="youtube_link_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Link Video Youtube</span>
                                </label>
                                <input type="text" name="youtube_link" placeholder="Masukkan Link"
                                    class="input input-bordered w-full"
                                    value="{{ $slide->type == 'youtube_video' ? $slide->format['youtube_link'] : '' }}" />
                            </div>
                            <div id="multiple_choice_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Opsi</span>
                                </label>
                                <input type="text" placeholder="Opsi a" name="a"
                                    class="input input-bordered w-full"
                                    value="{{ $slide->type == 'multiple_choice' ? $slide->format['choices']['a'] : '' }}" />
                                <input type="text" placeholder="Opsi b" name="b"
                                    class="input input-bordered w-full mt-3"
                                    value="{{ $slide->type == 'multiple_choice' ? $slide->format['choices']['b'] : '' }}" />
                                <input type="text" placeholder="Opsi c" name="c"
                                    class="input input-bordered w-full mt-3"
                                    value="{{ $slide->type == 'multiple_choice' ? $slide->format['choices']['c'] : '' }}" />
                                <input type="text" placeholder="Opsi d" name="d"
                                    class="input input-bordered w-full mt-3"
                                    value="{{ $slide->type == 'multiple_choice' ? $slide->format['choices']['d'] : '' }}" />
                                <input type="text" placeholder="Opsi e" name="e"
                                    class="input input-bordered w-full mt-3"
                                    value="{{ $slide->type == 'multiple_choice' ? $slide->format['choices']['e'] : '' }}" />
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <select id="type" name="correct_answer_multiple_choice"
                                    class="select select-bordered">
                                    <option value="a" @if (($slide->type == 'multiple_choice' ? $slide->format['correct_answer'] : '') == 'a') selected @endif>a</option>
                                    <option value="b" @if (($slide->type == 'multiple_choice' ? $slide->format['correct_answer'] : '') == 'b') selected @endif>b</option>
                                    <option value="c" @if (($slide->type == 'multiple_choice' ? $slide->format['correct_answer'] : '') == 'c') selected @endif>c
                                    </option>
                                    <option value="d" @if (($slide->type == 'multiple_choice' ? $slide->format['correct_answer'] : '') == 'd') selected @endif>d
                                    </option>
                                    <option value="e" @if (($slide->type == 'multiple_choice' ? $slide->format['correct_answer'] : '') == 'e') selected @endif>e
                                    </option>
                                </select>
                            </div>
                            <div id="correct_answer_short_answer"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <input type="text" name="correct_answer_short_answer"
                                    placeholder="Masukkan jawaban benar" class="input input-bordered w-full"
                                    value="{{ $slide->type == 'short_answer' ? $slide->format['correct_answer'] : '' }}" />
                            </div>
                            <div id="correct_answer_long_answer"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <textarea name="correct_answer_long_answer" class="textarea textarea-bordered"
                                    placeholder="Masukkan Penjelasan jawaban">{{ $slide->type == 'long_answer' ? $slide->format['correct_answer'] : '' }}</textarea>
                            </div>
                            <div id="reasons" class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Penjelasan</span>
                                </label>
                                <textarea name="reasons" class="textarea textarea-bordered" placeholder="Masukkan Penjelasan jawaban">{{ in_array($slide->type, ['file_attachment', 'short_answer', 'long_answer', 'multiple_choice']) ? $slide->format['explanation'] : '' }}</textarea>
                            </div>
                            <div id="manual_correction_box" class="form-control lg:w-[30%] w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Periksa Jawaban Secara Manual</span>
                                    <input type="checkbox" value="1" name="manual_correction_toggle"
                                        class="toggle toggle-warning" @checked(in_array($slide->type, ['file_attachment', 'short_answer', 'long_answer'])
                                                ? $slide->format['manual_correction']
                                                : false) />
                                </label>
                            </div>
                            <button type="submit" id="simpan"
                                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3 text-white">Perbarui
                                Slide</button>
                        </form>
                    </div>
                </div>
            </main>

        </div>

    </div>
    <script>
        const content = document.getElementById('content');
        const youtube_box = document.getElementById('youtube_link_box')
        const pilihan_ganda_box = document.getElementById('multiple_choice_box')
        const correct_answer_short_answer = document.getElementById('correct_answer_short_answer')
        const correct_answer_long_answer = document.getElementById('correct_answer_long_answer')
        const reasons = document.getElementById('reasons')
        const manual_correction_box = document.getElementById('manual_correction_box')
        const simpan = document.getElementById('simpan')
        CKEDITOR.ClassicEditor.create(document.getElementById("content-editor"), {
                toolbar: {
                    items: [
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                placeholder: 'Ketikkan sesuatu',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType'
                ]
            }).then(editor => {
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


        var slideType = document.querySelectorAll("input[type='radio']");

        slideType.forEach(function(input) {
            input.addEventListener('click', function(e) {
                change_type(e.target.value)
            })
        });
        slideType.forEach(function(input) {
            if (input.checked) {
                change_type(input.value)
            }
        });

        type.addEventListener('change', () => {
            change_type(type.value)
        })
        change_type()

        function change_type(value) {
            if (value == 'penjelasan') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                manual_correction_box.classList.add('hidden');
                correct_answer_short_answer.classList.add('hidden');
                correct_answer_long_answer.classList.add('hidden');
                reasons.classList.add('hidden')

            }

            if (value == 'youtube_video') {
                youtube_box.classList.remove('hidden');
                pilihan_ganda_box.classList.add('hidden');
                manual_correction_box.classList.add('hidden');
                correct_answer_short_answer.classList.add('hidden');
                correct_answer_long_answer.classList.add('hidden');
                reasons.classList.add('hidden');


            }
            if (value == 'multiple_choice') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.remove('hidden');
                correct_answer_short_answer.classList.add('hidden');
                correct_answer_long_answer.classList.add('hidden');
                manual_correction_box.classList.add('hidden');
                reasons.classList.remove('hidden');
            }
            if (value == 'short_answer') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                manual_correction_box.classList.remove('hidden');
                correct_answer_short_answer.classList.remove('hidden');
                correct_answer_long_answer.classList.add('hidden');
                reasons.classList.remove('hidden');
            }
            if (value == 'long_answer') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                manual_correction_box.classList.remove('hidden');
                correct_answer_short_answer.classList.add('hidden');
                correct_answer_long_answer.classList.remove('hidden');
                reasons.classList.remove('hidden');
            }
            if (value == 'file_attachment') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                manual_correction_box.classList.add('hidden');
                correct_answer_short_answer.classList.add('hidden');
                correct_answer_long_answer.classList.add('hidden');
                reasons.classList.remove('hidden');
            }
        }
    </script>

</body>

</html>
