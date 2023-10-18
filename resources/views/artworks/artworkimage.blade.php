@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Image</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/artworkimage" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Upload Image</label>
                    <input type="file" class="form-control" name="image" id="exampleInputFile" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Copyright Notice</label>
                    <input type="text" class="form-control" name="copyright_notice"
                        placeholder="Enter the copy right notice">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Photographic Rights</label>
                    <input type="text" class="form-control" name="photographic_rights"
                        placeholder="Enter the photographic rights">
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
