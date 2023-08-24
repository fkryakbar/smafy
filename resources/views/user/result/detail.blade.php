<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Hasil Belajar</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    @if (session()->has('msg'))
                        <div class="alert alert-success shadow-sm mt-3">
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
                    <div class="text-sm breadcrumbs mt-3">
                        <ul>
                            <li>
                                <a href="/dashboard/hasil">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Hasil
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/result/{{ $collection->slug }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    {{ $collection->title }}
                                </a>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-2 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                Detail
                            </li>

                        </ul>
                    </div>
                    <div class="bg-white p-3 rounded-md shadow mt-3 min-[500px]:w-full min-[200px]:w-[327px]">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-semibold text-gray-700  inline">
                                Hasil Belajar, {{ $siswa->name }}
                            </h2>
                        </div>
                    </div>
                    @php
                        $total_score = 0;
                    @endphp
                    <div class="bg-white p-3 rounded-md shadow mt-6 min-[500px]:w-full min-[200px]:w-[327px] mb-10 ">
                        @foreach ($siswa->collection->packages as $package)
                            <div class="mb-10">
                                <p class="font-bold text-gray-700 text-lg mb-5">
                                    {{ $package->title }}
                                    @if ($package->topic_type == 'materi')
                                        <span
                                            class="bg-green-500 p-1 rounded-lg text-white text-sm">{{ $package->topic_type }}</span>
                                    @else
                                        <span
                                            class="bg-amber-500 p-1 rounded-lg text-white text-sm">{{ $package->topic_type }}</span>
                                    @endif
                                    <span class="bg-blue-500 p-1 rounded-lg text-white text-sm">Skor :
                                        {{ $siswa->activities[$package->slug]['score'] }}</span>
                                    @php
                                        $total_score = $total_score + (int) $siswa->activities[$package->slug]['score'];
                                    @endphp
                                </p>
                                <div class="overflow-x-auto">
                                    <table class="table w-full min-[200px]:text-xs">
                                        <thead>
                                            <tr>
                                                <th>Nama slide</th>
                                                <th>Jawaban siswa</th>
                                                <th>Jawaban Jawaban benar</th>
                                                <th>Keterangan</th>
                                                <th>Ubah Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package->answers as $index => $answer)
                                                @if ($answer->u_id == $siswa->u_id)
                                                    <tr>
                                                        <th>{{ $answer->get_soal->title }}</th>
                                                        <th>{{ $answer->answer }}</th>
                                                        <th>{{ $answer->get_soal->correct_answer }}</th>
                                                        <th>
                                                            @if ($answer->result == 0)
                                                                <span class="badge bg-red-400 border-none">Salah</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-green-400 border-none">Benar</span>
                                                            @endif
                                                        </th>
                                                        <th class="flex justify-center gap-2 items-center">
                                                            <label for="" class="text-green-400">Benar</label>
                                                            <div>
                                                                <input type="radio"
                                                                    name="jawaban-{{ $answer->id }}" class="radio"
                                                                    @checked($answer->result == 1)
                                                                    onclick="changeAnswer('{{ $answer->id }}', 1)" />
                                                                <input type="radio"
                                                                    name="jawaban-{{ $answer->id }}"class="radio"
                                                                    @checked($answer->result == 0)
                                                                    onclick="changeAnswer('{{ $answer->id }}', 0)" />
                                                            </div>
                                                            <p class="text-red-400">Salah</p>
                                                        </th>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                        <h1 class="mt-10 font-bold text-xl text-gray-600">
                            Total Skor : {{ $total_score }}
                        </h1>
                    </div>



                </div>
            </main>

        </div>

    </div>


    <script>
        async function changeAnswer(jawaban_id, value) {
            const data = {
                jawaban_id: jawaban_id,
                value: value
            }
            const response = await fetch('/api/change-answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Something Error'
                })
            }
        }
    </script>

</body>

</html>
