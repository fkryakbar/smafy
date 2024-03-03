<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    @include('partials.dashboard_head')
    <title>Hasil | {{ $participant->name }}</title>
</head>

<body>
    <div class="flex h-screen bg-gray-50 " :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('partials.menu')
        <div class="flex flex-col flex-1 w-full">
            @include('partials.header')
            <main class="h-full overflow-y-auto">
                <div class="container px-2 mx-auto grid">
                    @if (session()->has('success'))
                        <script>
                            Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            }).fire({
                                icon: "success",
                                title: "{{ session('success') }}"
                            });
                        </script>
                    @endif
                    @foreach ($errors->all() as $item)
                        <div class="alert alert-error mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $item }}</span>
                        </div>
                    @endforeach
                    <div class="text-sm breadcrumbs mt-3">
                        <ul>
                            <li>
                                <a href="/dashboard/result">
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
                                <a href="/dashboard/result/{{ $topic->slug }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="w-4 h-4 mr-2 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                    Peserta Didik
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

                    <div class="bg-white p-3 rounded-md shadow mt-3 w-full">
                        <div class="flex gap-3 p-3">
                            <div class="lg:basis-[5%] basis-[15%]">
                                <img src="/image/documents.png" alt="logo" width="100%">
                            </div>
                            <div class="block lg:basis-[95%] basis-[75%]">
                                <div>
                                    <p class="text-lg font-semibold text-slate-600">
                                        {{ $participant->name }} - Kelas {{ $participant->kelas }}
                                    </p>
                                    <p class="text-sm text-slate-600">
                                        {{ $topic->title }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-slate-400">
                                        Dimulai sejak {{ $participant->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <hr class="my-3">
                                <div class="flex gap-3">
                                    <div class="rounded-md border-slate-300 border-[1px] p-5">
                                        <p class="text-center text-xl text-slate-500 font-bold">
                                            {{ $participant->average_score() }}%</p>
                                        <p class="text-center text-slate-500 text-sm">Accuracy</p>
                                    </div>
                                    <div class="rounded-md border-slate-300 border-[1px] p-5">
                                        <p class="text-center text-xl text-slate-500 font-bold">
                                            {{ $participant->progress() }}%</p>
                                        <p class="text-center text-slate-500 text-sm">Progress</p>
                                    </div>
                                    <div class="rounded-md border-slate-300 border-[1px] p-5">
                                        <p class="text-center text-xl text-slate-500 font-bold">
                                            {{ $participant->score_total() }}</p>
                                        <p class="text-center text-slate-500 text-sm">Score</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('user.lessons.components.createform')
                    <div class="bg-white p-3 rounded-md shadow mt-3 w-full space-y-5">
                        @forelse ($groupedAnswers as $i => $answers)
                            <div class="collapse rounded-lg border-[1px]">
                                <input type="checkbox" />
                                <div class="collapse-title text-xl font-medium">
                                    @if ($answers[0]->sublesson->sublesson_type == 'materi')
                                        <p
                                            class="text-xs capitalize bg-green-300 font-semibold text-green-700 px-2 py-1 w-fit rounded-md">
                                            {{ $answers[0]->sublesson->sublesson_type }}</p>
                                    @else
                                        <p
                                            class="text-xs capitalize bg-amber-300 font-semibold text-amber-700 px-2 py-1 w-fit rounded-md">
                                            {{ $answers[0]->sublesson->sublesson_type }}</p>
                                    @endif
                                    <h1>{{ $i }}</h1>
                                </div>
                                <div class="collapse-content space-y-5">
                                    {{-- @dd($answers) --}}
                                    @foreach ($answers as $answer)
                                        <div class="border-[1px] p-5 rounded-md">
                                            <div class="flex gap-2 items-center">
                                                @if ($answer->result == 1)
                                                    <div
                                                        class="bg-green-300 py-1 px-2 rounded-md flex gap-1 text-green-700 items-center text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Benar
                                                    </div>
                                                @else
                                                    <div
                                                        class="bg-red-300 py-1 px-2 rounded-md flex gap-1 text-red-700 items-center text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Salah
                                                    </div>
                                                @endif
                                                <div
                                                    class="bg-slate-300 py-1 px-2 rounded-md flex gap-1 text-slate-700 items-center text-xs">
                                                    @if ($answer->slide->type == 'multiple_choice')
                                                        Multiple Choice
                                                    @endif
                                                    @if ($answer->slide->type == 'file_attachment')
                                                        Upload File
                                                    @endif
                                                    @if ($answer->slide->type == 'short_answer')
                                                        Jawaban Singkat
                                                    @endif
                                                    @if ($answer->slide->type == 'long_answer')
                                                        Paragraf
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mt-5 font-bold text-slate-500">{{ $answer->slide->title }}</p>
                                            <div class="flex justify-between mt-5">
                                                <div>
                                                    <p class="text-xs text-slate-700">Jawaban</p>
                                                    <p class="text-slate-500 font-semibold mt-2 ">
                                                        @if ($answer->slide->type == 'file_attachment')
                                                            <a href="/{{ $answer->answer }}"
                                                                class="btn btn-sm bg-amber-400 text-white hover:bg-amber-700">Lihat
                                                                Jawaban</a>
                                                        @else
                                                            {{ $answer->answer }}
                                                        @endif
                                                    </p>
                                                </div>
                                                @isset($answer->slide->format['correct_answer'])
                                                    <div>
                                                        <p class="text-xs text-green-500">Jawaban Benar</p>
                                                        <p class="text-slate-500 font-semibold mt-2 ">
                                                            {{ $answer->slide->format['correct_answer'] }}
                                                        </p>
                                                    </div>
                                                @endisset
                                                @if (isset($answer->slide->format['manual_correction']) || $answer->slide->type == 'file_attachment')
                                                    @if ($answer->slide->type == 'file_attachment')
                                                        <div>
                                                            <p class="text-xs text-slate-700">Evaluasi</p>
                                                            <div class="flex justify-center gap-2 items-center">
                                                                <label for="jawaban-{{ $answer->id }}-true"
                                                                    class="text-green-400">Benar</label>
                                                                <div>
                                                                    <input type="radio"
                                                                        name="jawaban-{{ $answer->id }}"
                                                                        id="jawaban-{{ $answer->id }}-true"
                                                                        class="radio radio-success"
                                                                        @checked($answer->result == 1)
                                                                        onclick="changeAnswer('{{ $answer->id }}', 1)" />
                                                                    <input type="radio"
                                                                        name="jawaban-{{ $answer->id }}"
                                                                        id="jawaban-{{ $answer->id }}-false"
                                                                        class="radio radio-error"
                                                                        @checked($answer->result == 0)
                                                                        onclick="changeAnswer('{{ $answer->id }}', 0)" />
                                                                </div>
                                                                <label for="jawaban-{{ $answer->id }}-false"
                                                                    class="text-red-400">Salah</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @if ($answer->slide->format['manual_correction'] == 1)
                                                            <div>
                                                                <p class="text-xs text-slate-700">Evaluasi</p>
                                                                <div class="flex justify-center gap-2 items-center">
                                                                    <label for="jawaban-{{ $answer->id }}-true"
                                                                        class="text-green-400">Benar</label>
                                                                    <div>
                                                                        <input type="radio"
                                                                            name="jawaban-{{ $answer->id }}"
                                                                            id="jawaban-{{ $answer->id }}-true"
                                                                            class="radio radio-success"
                                                                            @checked($answer->result == 1)
                                                                            onclick="changeAnswer('{{ $answer->id }}', 1)" />
                                                                        <input type="radio"
                                                                            name="jawaban-{{ $answer->id }}"
                                                                            id="jawaban-{{ $answer->id }}-false"
                                                                            class="radio radio-error"
                                                                            @checked($answer->result == 0)
                                                                            onclick="changeAnswer('{{ $answer->id }}', 0)" />
                                                                    </div>
                                                                    <label for="jawaban-{{ $answer->id }}-false"
                                                                        class="text-red-400">Salah</label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="">
                                <img src="/image/Empty-amico.svg" alt="Empty" class="mx-auto" width="300px">
                                <p class="text-center mt-5 text-slate-600 italic">
                                    Belum ada jawaban
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        async function changeAnswer(answer_id, result) {
            const data = {
                answer_id: answer_id,
                result: result
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
