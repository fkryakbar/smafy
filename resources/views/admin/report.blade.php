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
                    Reports
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
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reporter</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $i => $report)
                                <tr>
                                    <th>{{ $i + 1 }}</th>
                                    <td>{{ $report->reporter }}</td>
                                    <td>{{ $report->email }}</td>
                                    <td>{{ $report->type }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>
                                        <button onclick="delete_report('{{ $report->id }}')"
                                            class="btn btn-sm bg-red-500 border-none">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        function delete_report(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/report/${id}/delete`
                }
            })
        }
    </script>
</body>

</html>
