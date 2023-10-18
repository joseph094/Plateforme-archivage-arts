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
            <h3 class="card-title">Edit Material Number {{ $material->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/material/{{ $material->id }}">
            @method('PUT')
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $material->name }}"
                        placeholder="Enter Material Name" required>
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
