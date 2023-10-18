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
            <h3 class="card-title">Create New Restoration</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/restoration">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Artwork Id</label>
                    <input type="text" class="form-control" name="artwork_id" placeholder="Enter a artwork id" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Diagnosis</label>
                    <input type="text" class="form-control" name="diagnosis" placeholder="Enter the diagnosis" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Causes</label>
                    <input type="text" class="form-control" name="causes" placeholder="Enter the causes" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Start Date</label>
                    <input type="date" class="form-control" name="start_date" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">End Date</label>
                    <input type="date" class="form-control" name="end_date">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Restoration Location</label>
                    <input type="text" class="form-control" name="restoration_location"
                        placeholder="Enter the restoration location" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Restorer Name</label>
                    <input type="text" class="form-control" name="restorer_name" placeholder="Enter the restorer name" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Intervention Type</label>
                    <input type="text" class="form-control" name="intervention_type"
                        placeholder="Enter the intervention type" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Materials And Techniques</label>
                    <input type="text" class="form-control" name="materials_and_techniques"
                        placeholder="Enter the matierials and techniques" required>
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
