@extends('layouts.app')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Image Number {{$image->id}}'s Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="/image/{{$image->id}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Artwork Id</label>
                        <input type="text" class="form-control" name="artwork_id" value="{{$image->artwork_id}}" placeholder="Enter a artwork id" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Image</label>
                        <input type="file" class="form-control" name="image" value="{{$image->path}}" id="exampleInputFile" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Copyright Notice</label>
                        <input type="text" class="form-control" name="copyright_notice" value="{{$image->copyright_notice}}" placeholder="Enter image copyright notice">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Photographic Rights</label>
                        <input type="text" class="form-control" name="photographic_rights" value="{{$image->photographic_rights}}" placeholder="Enter photographic rights">
                    </div>
          
                    <!-- /.card-body -->
                    <center>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </center>
                </div>
                </form>
                </div>
@endsection