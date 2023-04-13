<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <title>About Us!</title>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="relative bg-slate-100" x-data="{ sidebar_open: false }">
    @include('partials.navbar')
    <div x-show="sidebar_open" x-cloak class="absolute w-full h-screen bg-black opacity-50">

    </div>
    <section class="mx-auto lg:w-[80%] w-[90%] bg-white rounded-lg lg:p-10 p-4 lg:mt-15 mt-10 shadow-lg">
        <div class="lg:flex ">
            <div class="basis-[50%]">
                <h1 class="text-amber-400 text-6xl font-bold text-center lg:text-left">About Us!</h1>
                <img src="{{ asset('image/About us page-pana.svg') }}" class="block lg:hidden mt-3" alt="about">
                <p class="my-7 text-justify indent-7">
                    Welcome to Smafy, the comprehensive web-based learning platform designed to help teachers create
                    interactive,
                    engaging, and effective classroom experiences for their students. Our mission is to provide
                    educators with
                    the
                    necessary tools and resources to design customized learning experiences that cater to the unique
                    needs of
                    each
                    student.
                </p>
                <p class="my-7 text-justify indent-7">
                    Our platform offers a range of features that enable educators to design lessons that are
                    interactive,
                    interesting, and effective. With Smafy, teachers can easily create lessons that incorporate
                    multimedia
                    content,
                    interactive quizzes, and other engaging elements that help students stay focused and interested in
                    the
                    subject
                    matter. Our customizable features allow teachers to tailor their lessons to meet the specific needs
                    of their
                    students, ensuring that each student can learn in a way that works best for them.
                </p>
                <p class="my-7 text-justify indent-7">
                    One of the key features of Smafy is the ability to provide students with immediate feedback on their
                    progress.
                    Our platform includes a range of practice exercises, including multiple choice and fill-in-the-blank
                    questions,
                    as well as the ability to score student responses. This enables teachers to monitor student progress
                    in
                    real-time, identify areas where students may be struggling, and provide immediate feedback to help
                    students
                    stay
                    on track.
                </p>
                <p class="my-7 text-justify indent-7">
                    Our platform is accessible from anywhere, at any time, making it easy for students to access
                    learning
                    materials
                    and resources from home, school, or on-the-go. With Smafy, students can engage with course materials
                    in a
                    way
                    that works best for them, at a pace that suits their learning style.
                </p>
                <p class="my-7 text-justify indent-7">
                    At Smafy, we are committed to providing educators with the best possible tools and resources to help
                    them
                    create
                    engaging, effective classroom experiences for their students. We believe that every student deserves
                    access
                    to a
                    high-quality education, and we're dedicated to making that a reality. Join us today and experience
                    the power
                    of
                    Smafy for yourself.
                </p>
                <p class="my-7 text-justify">
                    - Ahmad Fikri Akbar, Web Engineer
                </p>
                <div class="flex justify-center flex-col gap-2">
                    <button onclick="clear_session()"
                        class="btn h-fit py-2 bg-red-500 hover:bg-red-700 border-none mx-auto gap-2"
                        href="/clear_session">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                        Hapus Semua Pengerjaan yang tersimpan</button>
                    <label for="my-modal-4" class="btn btn-sm bg-amber-500 hover:bg-amber-700 border-none mx-auto gap-2"
                        href="/clear_session">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-flag" viewBox="0 0 16 16">
                            <path
                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z" />
                        </svg>
                        Report and feedback</label>

                </div>
                <p class="my-7 text-center text-green-400">
                    App Version 3.0 Stable
                </p>
                <input type="checkbox" id="my-modal-4" class="modal-toggle" />
                <label for="my-modal-4" class="modal cursor-pointer">
                    <label class="modal-box relative" for="">
                        <h3 class="text-lg font-bold">Report and Feedback</h3>
                        <h3 class="text-sm">Let us know how we're doing</h3>
                        <hr class="my-3">
                        <form action="" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">What is your name?</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full"
                                    name="reporter" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">What is your email?</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full"
                                    name="email" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">What's kind you want to tell us about?</span>
                                </label>
                                <select class="select w-full select-bordered" name="type">
                                    <option selected>Feedback</option>
                                    <option>Report</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tell us what you think</span>
                                </label>
                                <textarea class="textarea textarea-bordered h-24" placeholder="Tell us here..." name="description"></textarea>
                            </div>
                            <div class="form-control mt-3">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </label>
                </label>
            </div>
            <div class="basis-[50%]">
                <img src="{{ asset('image/About us page-pana.svg') }}" class="hidden lg:block" alt="about">
                <img src="{{ asset('image/About us page-rafiki.svg') }}" class="hidden lg:block" alt="about2">
            </div>
        </div>

    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1"
            d="M0,224L48,218.7C96,213,192,203,288,176C384,149,480,107,576,117.3C672,128,768,192,864,192C960,192,1056,128,1152,101.3C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    @include('partials.landing_footer')
    <script>
        function clear_session() {
            Swal.fire({
                title: 'Bersihkan riwayat?',
                text: "Anda tidak bisa lagi melihat riwayat pengerjaan topik anda!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/clear_session'
                }
            })
        }
        @if (session()->has('msg'))
            Swal.fire(
                'Success!',
                '{{ session('msg') }}',
                'success'
            )
        @endif
    </script>
</body>

</html>
