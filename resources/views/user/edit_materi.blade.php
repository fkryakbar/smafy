<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Edit Topik</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
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
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Edit Topik
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Edit Topik
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

                        <form action="" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Judul Topik</span>
                                </label>
                                <input type="text" value="{{ $materi->title }}" name="title"
                                    placeholder="Masukkan judul Topik" class="input input-bordered w-full" />
                            </div>
                            <div class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Deskripsi</span>
                                </label>
                                <textarea name="description" class="textarea textarea-bordered" placeholder="Masukkan Deskripsi">{{ $materi->description }}</textarea>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Tipe Topik</span>
                                </label>
                                <select id="topic_type" class="select select-bordered" name="topic_type"
                                    onclick="check_type()" disabled>
                                    <option value="materi" @if ($materi->topic_type == 'materi') selected @endif>Materi
                                    </option>
                                    <option value="kuis" @if ($materi->topic_type == 'kuis') selected @endif>Kuis
                                    </option>
                                </select>
                                <label class="label">
                                    <span class="label-text italic text-red-600">Tipe topik tidak dapat diubah</span>
                                </label>
                            </div>
                            <div id="lesson_options">
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Tampilkan kunci jawaban setelah menjawab
                                            pertanyaan</span>
                                    </label>
                                    <select class="select select-bordered" name="show_correction_lesson">
                                        <option value="1" @if ($materi->show_correction_lesson == '1') selected @endif>Ya
                                        </option>
                                        <option value="0" @if ($materi->show_correction_lesson == '0') selected @endif>Tidak
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
                                        <option value="1" @if ($materi->show_correction_quiz == '1') selected @endif>Ya
                                        </option>
                                        <option value="0" @if ($materi->show_correction_quiz == '0') selected @endif>Tidak
                                        </option>
                                    </select>

                                </div>
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Waktu pengerjaan (dalam menit)</span>
                                    </label>
                                    <input type="number" name="timer" placeholder="Masukkan waktu pengerjaan"
                                        class="input input-bordered w-full" value="{{ $materi->timer / 60 }}" />
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
                                    <option value="1" @if ($materi->show_result == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if ($materi->show_result == '0') selected @endif>Tidak
                                    </option>
                                </select>
                            </div>
                            @if ($materi->is_duplicated == 0)
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text">Tampilkan di pencarian</span>
                                    </label>
                                    <select class="select select-bordered" name="show_public"
                                        @disabled($materi->is_duplicated == 1)>
                                        <option value="1" @if ($materi->show_public == '1') selected @endif>Ya
                                        </option>
                                        <option value="0" @if ($materi->show_public == '0') selected @endif>Tidak
                                        </option>
                                    </select>

                                </div>
                            @endif
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Terima Respons</span>
                                </label>
                                <select class="select select-bordered" name="accept_responses">
                                    <option value="1" @if ($materi->accept_responses == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if ($materi->accept_responses == '0') selected @endif>Tidak
                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3">Simpan</button>
                        </form>
                    </div>



                </div>
            </main>

        </div>

    </div>
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
