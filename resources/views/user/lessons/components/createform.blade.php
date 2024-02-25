<dialog id="buat" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Buat Topik</h3>
        <form action="" method="POST" autocomplete="off">
            @csrf
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Judul Topik</span>
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
            <button type="submit"
                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3 text-white">Buat</button>
        </form>

    </div>
    {{-- <script>
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
    </script> --}}
</dialog>
