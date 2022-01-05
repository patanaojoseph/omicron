<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            @if (session('success'))
            <div class="alert alert-primary alert-highlighted" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Category table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL no.</th>
                                        <th scope="col">Category name</th>
                                        <th scope="col">Admin</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if ($category->created_at == NULL)
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $category->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.category',$category->id) }}" class="btn-sm btn-info">edit</a>
                                                <a href="{{ route('delete.category',$category->id) }}" class="btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Category?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                     <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Add new Category</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Category name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter category name">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-footer pt-1 pt-2 mt-1 border-top">
                                    <button type="submit" class="btn btn-primary btn-default" style="float: right;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            <!-- Trash Category -->

            <div class="col-lg-8">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Trash Category table</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL no.</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @Php($i = 1)
                                @foreach ($trashCat as $category)
                                    <tr>
                                        <td scope="row">{{ $i++ }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if ($category->created_at == NULL)
                                                <span class="text-danger">no date was set</span>
                                            @else
                                                {{ $category->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('restore.category',$category->id) }}" class="btn-sm btn-info">restore</a>
                                            <a href="{{ route('remove.category',$category->id) }}" class="btn-sm btn-danger" onclick="return confirm('This Category will be completely remove. Are you sure?')">remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trashCat->links() }}
                    </div>
                </div>
            </div>



            </div>
        </div>
    </div>
</x-app-layout>
