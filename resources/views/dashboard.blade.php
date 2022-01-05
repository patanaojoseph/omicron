<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hello admin <b>{{ Auth::user()->name }}.</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Administrator table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID no.</th>
                                        <th scope="col">Admin name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($user as $users)
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
