<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">

            @if (session('success'))
            <div class="alert alert-success alert-highlighted" role="alert">
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
                            <h2>Update Brand</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.brand',$brands->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ asset($brands->brand_image) }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Brand name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter brand name" value="{{ $brands->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Brand image file input</label>
                                    <input type="file" name="brand_image" class="form-control-file" id="exampleFormControlFile1" value="{{ $brands->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}" style="height: 400px; width: 500px;">
                                </div>

                                <div class="form-footer pt-2 pt-2 mt-2 border-top">
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
