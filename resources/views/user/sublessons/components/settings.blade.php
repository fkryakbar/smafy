<dialog id="pengaturan" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Pengaturan</h3>
        <form action="/dashboard/lessons/{{ $topic->slug }}/settings" method="POST" autocomplete="off">
            @csrf
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Topik</span>
                </label>
                <input type="text" name="title" placeholder="Masukkan judul sub topik"
                    class="input input-bordered w-full" value="{{ $topic->title }}" />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Deskripsi</span>
                </label>
                <input type="text" name="description" placeholder="Deskripsi" class="input input-bordered w-full"
                    value="{{ $topic->description }}" />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Batas waktu pengerjaan</span>
                    <input type="checkbox" id="deadline_time" onclick="validate()" name="deadline_time"
                        class="toggle toggle-warning" @checked($topic->deadline_time > 0) />
                </label>
                <input type="date" id="date_picker" name="deadline_time_date" placeholder="Batas waktu pengerjaan"
                    class="input input-bordered w-full" min="{{ date('Y-m-d', time()) }}"
                    value="{{ date('Y-m-d', $topic->deadline_time == 0 ? time() : $topic->deadline_time) }}" />
                <input type="time" id="time_picker" name="deadline_time_time" placeholder="Batas waktu pengerjaan"
                    class="input input-bordered w-full mt-2"
                    value="{{ date('H:i:s', $topic->deadline_time == 0 ? time() : $topic->deadline_time) }}" />
                <script>
                    function validate() {
                        if (document.getElementById('deadline_time').checked) {
                            document.getElementById('date_picker').classList.remove('hidden')
                            document.getElementById('time_picker').classList.remove('hidden')
                        } else {
                            document.getElementById('date_picker').classList.add('hidden')
                            document.getElementById('time_picker').classList.add('hidden')
                        }
                    }
                    validate();
                </script>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Izinkan untuk mengulang Topik</span>
                    <input type="checkbox" name="allow_to_restart_lesson" class="toggle toggle-warning" value="1"
                        @checked($topic->allow_to_restart_lesson) />
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Tampilkan jawaban benar</span>
                    <input type="checkbox" name="show_correct_answer" class="toggle toggle-warning" value="1"
                        @checked($topic->show_correct_answer) />
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Tampilkan skor akhir</span>
                    <input type="checkbox" name="show_final_score" class="toggle toggle-warning" value="1"
                        @checked($topic->show_final_score) />
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Terima respons</span>
                    <input type="checkbox" name="accept_responses" class="toggle toggle-warning" value="1"
                        @checked($topic->accept_responses) />
                </label>
            </div>

            <button type="submit"
                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3 text-white">Simpan</button>
        </form>
    </div>
</dialog>
