<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Aktivitas</title>
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
                                Tambah Aktivitas
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-3 rounded-md shadow mt-3">
                        <h2 class="text-2xl font-semibold text-gray-700  inline">
                            Tambah Aktivitas
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
                                    <span class="label-text">Judul Aktivitas</span>
                                </label>
                                <input type="text" name="title" placeholder="Masukkan judul topik"
                                    class="input input-bordered w-full" value="{{ old('title') }}" />
                            </div>
                            <div class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Deskripsi</span>
                                </label>
                                <textarea name="description" class="textarea textarea-bordered" placeholder="Masukkan Deskripsi">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-control w-full mt-3">
                                <label class="label">
                                    <span class="label-text">Pilih Topik</span>
                                </label>
                                <select id="topik" multiple name="packages[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    @foreach ($topik as $t)
                                        <option value="{{ $t->slug }}">{{ $t->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Tampilkan skor</span>
                                </label>
                                <select class="select select-bordered" name="show_score">
                                    <option value="1" @if (old('show_score') == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if (old('show_score') == '0') selected @endif>Tidak
                                    </option>
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Tampilkan di pencarian</span>
                                </label>
                                <select class="select select-bordered" name="show_public">
                                    <option value="1" @if (old('show_public') == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if (old('show_public') == '0') selected @endif>Tidak
                                    </option>
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Terima Respons</span>
                                </label>
                                <select class="select select-bordered" name="accept_responses">
                                    <option value="1" @if (old('accept_responses') == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if (old('accept_responses') == '0') selected @endif>Tidak
                                    </option>
                                </select>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Bisa Mengulang Aktivitas</span>
                                </label>
                                <select class="select select-bordered" name="allow_to_restart_activity">
                                    <option value="1" @if (old('allow_to_restart_activity') == '1') selected @endif>Ya
                                    </option>
                                    <option value="0" @if (old('allow_to_restart_activity') == '0') selected @endif>Tidak
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
        $(document).ready(function() {
            $('#topik').select2()
        });
    </script>
</body>

</html>
