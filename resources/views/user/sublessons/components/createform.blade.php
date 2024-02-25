<dialog id="buat" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Buat Sub Topik</h3>
        <form action="" method="POST" autocomplete="off">
            @csrf
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Judul Sub Topik</span>
                </label>
                <input type="text" name="title" placeholder="Masukkan judul sub topik"
                    class="input input-bordered w-full" value="{{ old('title') }}" />
            </div>
            <div class="form-control w-full mt-3">
                <label class="label">
                    <span class="label-text">Tipe subtopik</span>
                </label>
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    <li>
                        <input type="radio" id="hosting-small" name="sublesson_type" value="materi"
                            class="hidden peer" />
                        <label for="hosting-small"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-green-500 peer-checked:text-green-500 hover:text-gray-600 hover:bg-green-100 ">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <div class="text-lg font-semibold bg-green-500 text-white py-2 px-4 rounded-full">
                                    Materi
                                </div>
                                <div class="text-center">Slide interaktif untuk pembelajaran yang disukai siswa</div>
                            </div>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="hosting-big" name="sublesson_type" value="kuis" class="hidden peer">
                        <label for="hosting-big"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-amber-500 peer-checked:text-amber-500 hover:text-gray-600 hover:bg-amber-100">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <div class="text-lg font-semibold bg-amber-500 text-white py-2 px-4 rounded-full">Kuis
                                </div>
                                <div class="text-center">Kuis interaktif sebagai assesment pembelajaran</div>
                            </div>
                        </label>
                    </li>
                </ul>

            </div>
            <button type="submit"
                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3 text-white">Buat</button>
        </form>
    </div>
</dialog>
