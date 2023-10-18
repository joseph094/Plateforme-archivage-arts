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
            <h3 class="card-title">Edit Reservation Number {{ $reservation->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/reservation/{{ $reservation->id }}">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Artwork Id</label>
                    <input type="text" class="form-control" name="artwork_id" value="{{ $reservation->artwork_id }}"
                        placeholder="Enter a artwork id" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Place</label>
                    <input type="text" class="form-control" name="place" value="{{ $reservation->place }}"
                        placeholder="Enter the place" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Storage Method</label>
                    <input type="text" class="form-control" name="storage_method" value="{{ $reservation->storage_method }}"
                        placeholder="Enter the storage method" required>
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
