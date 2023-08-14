<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>Hasil</title>
</head>

<body>

    <div class="flex h-screen bg-slate-300">
        <div class="m-auto">
            <div class="card min-[500px]:w-96 min-[200px]:w-[350px]  bg-base-100 shadow-xl m-3">
                <div class="card-body items-center text-center">
                    <p class="text-center card-title">Yeey! Sudah selesai </p>
                    <img src="{{ asset('image/Finish line-amico.svg') }}" alt="">
                    @if ($package->show_result == 1 && $total > 0)
                        <h2 class="card-title">Skor kamu</h2>
                        <div class="radial-progress text-green-400" style="--value:{{ $skor }};">
                            {{ $skor }}
                        </div>
                        <p>Soal Benar : {{ $benar }} dari {{ $total }} Soal</p>
                    @endif
                    <div class="flex gap-2 flex-wrap justify-center">
                        <div class="card-actions">
                            <a href="/play/{{ $collection_slug }}/{{ $package->slug }}"
                                class="btn btn-sm bg-blue-400 border-none hover:bg-blue-600">Lihat Kembali
                                Pengerjaan</a>
                        </div>
                        <div class="card-actions">
                            <a href="/play/{{ $collection_slug }}"
                                class="btn btn-sm bg-green-400 border-none hover:bg-green-600">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
