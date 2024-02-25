<div class="navbar bg-amber-400 shadow-lg top-0">
    <div class="flex-1">
        <a href="/" class="btn btn-ghost normal-case text-white text-xl">Smafy</a>
    </div>
    <div class="dropdown dropdown-end min-[200px]:block lg:hidden">
        <label tabindex="0" class="btn m-1 bg-amber-400 hover:bg-amber-700 border-none">
            <i x-on:click="sidebar_open=true" x-show="sidebar_open==false" class="bi bi-list text-3xl"></i>
            <svg x-on:click="sidebar_open=false" x-show="sidebar_open==true" xmlns="http://www.w3.org/2000/svg"
                width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
            </svg>
        </label>
    </div>
    <div class="flex-none text-white lg:block min-[200px]:hidden">
        <ul class="menu menu-horizontal p-0">
            <li><a href="/login"
                    class="btn text-white shadow-none bg-amber-400 border-none hover:bg-amber-700">Masuk</a>
            </li>
            <li><a href="/register"
                    class="btn text-white shadow-none bg-amber-400 border-none hover:bg-amber-700">Daftar</a></li>
            <li><a href="/browse" class="btn text-white shadow-none bg-amber-400 border-none hover:bg-amber-700">Smafy
                    Library</a></li>
            <li><a href="/about"
                    class="btn text-white shadow-none bg-amber-400 border-none hover:bg-amber-700">Tentang</a></li>
            <li><a href="https://docs.smafy.my.id/" target="_blank"
                    class="btn text-white shadow-none bg-amber-400 border-none hover:bg-amber-700">Bantuan</a></li>
        </ul>
    </div>
</div>
<div x-cloak class="h-screen w-[300px] bg-amber-400 top-0  fixed transition-all z-10"
    :class="sidebar_open ? 'left-[0px]' : '-left-[300px]'">
    <div class="py-5 px-3">
        <p class="text-3xl text-white font-bold">Smafy</p>
        <hr class="my-5">
        <a href="/login" class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                <path fill-rule="evenodd"
                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
            </svg>
            <p class="font-bold">Masuk</p>
        </a>
        <a href="/register" class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z" />
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                <path
                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
            </svg>
            <p class="font-bold">Daftar</p>

        </a>
        <a target="_blank" href="/learn/demo"
            class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-caret-right-square" viewBox="0 0 16 16">
                <path
                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                <path
                    d="M5.795 12.456A.5.5 0 0 1 5.5 12V4a.5.5 0 0 1 .832-.374l4.5 4a.5.5 0 0 1 0 .748l-4.5 4a.5.5 0 0 1-.537.082z" />
            </svg>
            <p class="font-bold">Demo</p>
        </a>
        <a href="/browse" class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <p class="font-bold">Smafy Library</p>
        </a>
        <a href="/about" class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>

            <p class="font-bold">Tentang</p>
        </a>
        <a href="https://docs.smafy.my.id/" target="_blank"
            class="flex mt-3 gap-3 text-white w-full hover:bg-amber-600 p-3 rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
            <p class="font-bold">Bantuan</p>
        </a>

    </div>
</div>
