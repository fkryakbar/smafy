<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.admin_head')
    <title>Admin Dashboard</title>
</head>

<body x-data="{ sidebar_open: false }" class="relative">
    <section class="flex gap-3">
        @include('partials.admin_sidebar')
        <div class="w-full mx-2">
            <div class="w-full mt-3 rounded-md p-5 shadow-lg flex items-center gap-2">
                <button class="lg:hidden" x-on:click="sidebar_open=true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <h1 class="uppercase font-bold text-lg">
                    Edit Topic
                </h1>
            </div>
            <div class="w-full mt-3 rounded-md p-5 shadow-lg">
                @if (session()->has('msg'))
                    <div class="alert alert-success shadow-sm my-3">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('msg') }}</span>
                        </div>
                    </div>
                @endif
                @foreach ($errors->all() as $item)
                    <div class="alert alert-error mb-5">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $item }}</span>
                        </div>
                    </div>
                @endforeach
                <form action="" autocomplete="off" method="POST">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Slug</span>
                        </label>
                        <input type="text" name="slug" placeholder="Masukkan disini"
                            class="input input-bordered w-full" value="{{ $package->slug }}" />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" name="title" placeholder="Masukkan disini"
                            class="input input-bordered w-full" value="{{ $package->title }}" />
                    </div>
                    <div class="form-control w-full mt-3">
                        <label class="label">
                            <span class="label-text">Deskripsi</span>
                        </label>
                        <textarea name="description" class="textarea textarea-bordered" placeholder="Masukkan Deskripsi">{{ $package->description }}</textarea>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Tipe Topik</span>
                        </label>
                        <select id="topic_type" class="select select-bordered" name="topic_type" onclick="check_type()">
                            <option value="materi" @if ($package->topic_type == 'materi') selected @endif>Materi
                            </option>
                            <option value="kuis" @if ($package->topic_type == 'kuis') selected @endif>Kuis
                            </option>
                        </select>
                    </div>
                    <div id="lesson_options">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Tampilkan kunci jawaban setelah menjawab
                                    pertanyaan</span>
                            </label>
                            <select class="select select-bordered" name="show_correction_lesson">
                                <option value="1" @if ($package->show_correction_lesson == '1') selected @endif>Ya
                                </option>
                                <option value="0" @if ($package->show_correction_lesson == '0') selected @endif>Tidak
                                </option>
                            </select>

                        </div>
                    </div>
                    <div id="quiz_options">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Tampilkan kunci jawaban setelah menyelesaikan
                                    kuis</span>
                            </label>
                            <select class="select select-bordered" name="show_correction_quiz">
                                <option value="1" @if ($package->show_correction_quiz == '1') selected @endif>Ya
                                </option>
                                <option value="0" @if ($package->show_correction_quiz == '0') selected @endif>Tidak
                                </option>
                            </select>

                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Waktu pengerjaan (dalam menit)</span>
                            </label>
                            <input type="number" name="timer" placeholder="Masukkan waktu pengerjaan"
                                class="input input-bordered w-full" value="{{ $package->timer / 60 }}" />
                            <label class="label">
                                <span class="label-text italic text-green-600">Masukkan <span
                                        class="font-bold">120</span> jika waktu
                                    pengerjaan adalah 2 jam atau
                                    120 menit, masukkan <span class="font-bold">0</span> jika tidak ingin
                                    menggunakan timer</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Tampilkan skor setelah mengerjakan</span>
                        </label>
                        <select class="select select-bordered" name="show_result">
                            <option value="1" @if ($package->show_result == '1') selected @endif>Ya
                            </option>
                            <option value="0" @if ($package->show_result == '0') selected @endif>Tidak
                            </option>
                        </select>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Tampilkan di pencarian</span>
                        </label>
                        <select class="select select-bordered" name="show_public">
                            <option value="1" @if ($package->show_public == '1') selected @endif>Ya
                            </option>
                            <option value="0" @if ($package->show_public == '0') selected @endif>Tidak
                            </option>
                        </select>

                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Is Duplicated</span>
                        </label>
                        <select class="select select-bordered" name="is_duplicated">
                            <option value="1" @if ($package->is_duplicated == '1') selected @endif>Ya
                            </option>
                            <option value="0" @if ($package->is_duplicated == '0') selected @endif>Tidak
                            </option>
                        </select>

                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Terima Respons</span>
                        </label>
                        <select class="select select-bordered" name="accept_responses">
                            <option value="1" @if ($package->accept_responses == '1') selected @endif>Ya
                            </option>
                            <option value="0" @if ($package->accept_responses == '0') selected @endif>Tidak
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn bg-black-400 border-0 mt-5 w-full lg:w-fit">Save</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        function check_type() {
            let lesson_options = document.getElementById('lesson_options')
            let quiz_options = document.getElementById('quiz_options')
            if (document.getElementById('topic_type').value == 'materi') {
                lesson_options.classList.remove('hidden')
                quiz_options.classList.add('hidden')
            } else if (document.getElementById('topic_type').value == 'kuis') {
                quiz_options.classList.remove('hidden')
                lesson_options.classList.add('hidden')
            }
        }
        check_type()
    </script>
</body>

</html>
