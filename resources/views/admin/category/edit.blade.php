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
                <div class="col-lg-6">
                     <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update Category</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.category',$category->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter category name" value="{{ $category->category_name }}">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-footer pt-1 pt-2 mt-1 border-top">
                                    <button type="submit" class="btn btn-primary btn-default" style="float: right;">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
