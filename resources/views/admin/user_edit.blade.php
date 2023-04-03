<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.admin_head')
    <title>Admin Dashboard</title>
</head>

<body x-data="{ sidebar_open: false }" class="relative">
    <section class="flex gap-3">
        @include('partials.admin_sidebar')
        <div class="w-full mx-2">
            <div class="w-full mt-3 rounded-md p-5 shadow-lg flex items-center gap-2">
                <button class="lg:hidden" x-on:click="sidebar_open=true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <h1 class="uppercase font-bold text-lg">
                    Edit User
                </h1>
            </div>
            <div class="w-full mt-3 rounded-md p-5 shadow-lg">
                @if (session()->has('msg'))
                    <div class="alert alert-success shadow-sm my-3">
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
                @foreach ($errors->all() as $item)
                    <div class="alert alert-error mb-5">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $item }}</span>
                        </div>
                    </div>
                @endforeach
                <form action="" autocomplete="off" method="POST">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" name="name" placeholder="Masukkan disini"
                            class="input input-bordered w-full" value="{{ $user->name }}" />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" name="email" placeholder="Masukkan disini"
                            class="input input-bordered w-full" value="{{ $user->email }}"
                            @disabled(true) />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">New Password</span>
                        </label>
                        <input type="password" name="password" placeholder="Masukkan disini"
                            class="input input-bordered w-full" />
                    </div>
                    <button type="submit" class="btn bg-black-400 border-0 mt-5 w-full lg:w-fit">Save</button>
                </form>
            </div>
        </div>
    </section>

</body>

</html>
