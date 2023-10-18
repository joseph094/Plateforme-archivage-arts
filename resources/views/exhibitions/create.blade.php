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
            <h3 class="card-title">Create a New Exhibition</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/exhibition">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="artwork_id">Artwork ID</label>
                    <input type="text" class="form-control" name="artwork_id" placeholder="Enter the artwork_id" required>
                </div>

                <div class="form-group">
                    <label for="specific_constraints">Specific Constraints</label>
                    <input type="text" class="form-control" name="specific_constraints"
                        placeholder="Enter a specific_constraints">
                </div>

                <div class="form-group">
                    <label for="exhibition_title">exhibition Title</label>
                    <input type="text" class="form-control" name="exhibition_title"
                        placeholder="Enter the exhibition_title" required>
                </div>

                <div class="form-group">
                    <label for="exhibition_location">exhibition Location</label>
                    <input type="text" class="form-control" name="exhibition_location"
                        placeholder="Enter the  exhibition_location" required>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" name="start_date" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" name="end_date">
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
