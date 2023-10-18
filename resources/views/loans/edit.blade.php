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
            <h3 class="card-title">Edit Loan Number {{ $loan->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/loan/{{ $loan->id }}">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Artwork Id</label>
                    <input type="text" class="form-control" name="artwork_id" value="{{ $loan->artwork_id }}"
                        placeholder="Enter a artwork id" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Institution</label>
                    <input type="text" class="form-control" name="institution" value="{{ $loan->institution }}"
                        placeholder="Enter an institution" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Exhibition Title</label>
                    <input type="text" class="form-control" name="exhibition_title" value="{{ $loan->exhibition_title }}"
                        placeholder="Enter an exhibition title" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Departure Date</label>
                    <input type="date" class="form-control" name="departure_date" value="{{ $loan->departure_date }}" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Return Date</label>
                    <input type="date" class="form-control" name="return_date" value="{{ $loan->return_date }}" required>
                </div>

                <div class="form-group">

                    <!-- /.card-body -->
                    <center>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </center>
                </div>
            </div>
        </form>
    </div>
@endsection
