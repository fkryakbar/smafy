<dialog id="pengaturan" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg">Pengaturan</h3>
        <form action="/dashboard/lessons/{{ $lesson->slug }}/{{ $lesson->sublessons[0]->slug }}/settings" method="POST"
            autocomplete="off">
            @csrf
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Judul Subtopik</span>
                </label>
                <input type="text" name="title" placeholder="Masukkan judul sub topik"
                    class="input input-bordered w-full" value="{{ $lesson->sublessons[0]->title }}" />
            </div>
            @if ($lesson->sublessons[0]->sublesson_type == 'kuis')
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Gunakan Timer</span>
                        <input id="timerCheckbox" type="checkbox" class="toggle toggle-warning"
                            @checked($lesson->sublessons[0]->timer > 0) />
                    </label>
                    <div id="timerContainer">
                        <input id="timerBox" type="number" min="0" max="120" name="timer"
                            placeholder="Masukkan judul sub topik" class="input input-bordered w-full"
                            value="{{ $lesson->sublessons[0]->timer }}" />
                        <span class="label-text text-xs text-slate-500 italic">Angka dalam bentuk menit, misal 20 untuk
                            20
                            menit</span>
                    </div>
                </div>
                <script>
                    const timerCheckbox = document.getElementById('timerCheckbox');
                    const timerBox = document.getElementById('timerBox');
                    const timerContainer = document.getElementById('timerContainer');
                    timerCheckbox.addEventListener('click', changeState)

                    function changeState() {
                        if (timerCheckbox.checked) {
                            timerContainer.classList.remove('hidden')
                            return
                        }
                        timerContainer.classList.add('hidden')
                        timerBox.value = 0
                    }

                    changeState()
                </script>
            @endif
            <button type="submit"
                class="btn btn-sm bg-amber-400 border-none hover:bg-amber-600 mt-3 text-white">Simpan</button>
        </form>

    </div>
</dialog>
