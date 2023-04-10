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
                                Edit Slide
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Edit Slide : {{ $data->title }}
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
                                    <span class="label-text">Slide ke :</span>
                                </label>
                                <input type="text" value="{{ $data->order_id }}" name="order_id"
                                    placeholder="Judul Slide" class="input input-bordered w-full" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Judul Slide :</span>
                                </label>
                                <input type="text" value="{{ $data->title }}" name="title"
                                    placeholder="Judul Slide" class="input input-bordered w-full" />
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
                                    <option value="pilihan_ganda" @if ($data->type == 'pilihan_ganda') selected @endif>Soal
                                        Pilihan Ganda</option>
                                </select>
                            </div>
                            <div class="form-control w-full max-w-xs">
                                <label class="label">
                                    <span class="label-text">Cover :</span>
                                </label>
                                <input type="file" name="image"
                                    class="file-input file-input-bordered w-full max-w-xs" />
                                <label class="">
                                    @if ($data->image_path)
                                        <span class="label-text">Gambar yang sudah dipilih : </span>
                                        <br>
                                        <img class="w-36" src="/{{ $data->image_path }}">
                                    @endif
                                </label>
                            </div>
                            <div class="form-control w-full mt-1">
                                <label class="label">
                                    <span class="label-text">Konten : </span>
                                </label>
                                <textarea name="content" id="content" class="textarea textarea-bordered hidden" placeholder="Masukkan isi slide"></textarea>
                                <div id="toolbar-content" class="mt-3"></div>
                                <div class="border-2">
                                    <div id="content-editor">
                                        {!! $data->content !!}
                                    </div>
                                </div>
                            </div>
                            <div id="youtube_link_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Link Video Youtube :</span>
                                </label>
                                <input type="text" name="youtube_link" placeholder="Masukkan Link"
                                    class="input input-bordered w-full" value="{{ $data->youtube_link }}" />
                            </div>
                            <div id="pilihan_ganda_box"
                                class="form-control w-full mt-3 p-3 border-solid border-grey-500 border-2 rounded-md">
                                <label class="label">
                                    <span class="label-text">Opsi :</span>
                                </label>
                                <input type="text" placeholder="Opsi a" name="a"
                                    class="input input-bordered w-full" value="{{ $data->a }}" />
                                <input type="text" placeholder="Opsi b" name="b"
                                    class="input input-bordered w-full mt-3" value="{{ $data->b }}" />
                                <input type="text" placeholder="Opsi c" name="c"
                                    class="input input-bordered w-full mt-3" value="{{ $data->c }}" />
                                <input type="text" placeholder="Opsi d" name="d"
                                    class="input input-bordered w-full mt-3" value="{{ $data->d }}" />
                                <label class="label">
                                    <span class="label-text">Jawaban Benar : </span>
                                </label>
                                <select id="type" name="correct_answer_pilihan_ganda"
                                    class="select select-bordered">
                                    <option value="a" @if ($data->correct_answer == 'a') selected @endif>a</option>
                                    <option value="b" @if ($data->correct_answer == 'b') selected @endif>b</option>
                                    <option value="c" @if ($data->correct_answer == 'c') selected @endif>c
                                    </option>
                                    <option value="d" @if ($data->correct_answer == 'd') selected @endif>d
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
                                    value="{{ $data->correct_answer }}" />
                            </div>
                            <div id="reasons" class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Penjelasan : </span>
                                </label>
                                <textarea name="reasons" class="textarea textarea-bordered" placeholder="Masukkan Penjelasan jawaban">{{ $data->reasons }}</textarea>
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
                placeholder: 'Masukkan teks di sini',
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
    <script>
        const type = document.getElementById('type');
        type.addEventListener('change', () => {
            change_type(type.value)
        })
        change_type(type.value)

        function change_type(type) {
            if (type == 'materi') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.add('hidden')
            }

            if (type == 'youtube_video') {
                youtube_box.classList.remove('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.add('hidden')
            }
            if (type == 'pilihan_ganda') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.remove('hidden');
                isian_box.classList.add('hidden');
                reasons.classList.remove('hidden')
            }
            if (type == 'isian') {
                youtube_box.classList.add('hidden');
                pilihan_ganda_box.classList.add('hidden');
                isian_box.classList.remove('hidden');
                reasons.classList.remove('hidden')
            }
        }
    </script>

</body>

</html>
