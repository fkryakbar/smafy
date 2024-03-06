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
                <p class="my-7 text-justify">
                    - Ahmad Fikri Akbar, Developer
                </p>
                <p class="my-7 text-center text-green-400">
                    App Version 5.0 Stable </p>
            </div>
            <div class="basis-[50%]">
                <img src="{{ asset('image/About us page-pana.svg') }}" class="hidden lg:block" alt="about">
            </div>
        </div>

    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1"
            d="M0,224L48,218.7C96,213,192,203,288,176C384,149,480,107,576,117.3C672,128,768,192,864,192C960,192,1056,128,1152,101.3C1248,75,1344,85,1392,90.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    @include('partials.landing_footer')
</body>

</html>
