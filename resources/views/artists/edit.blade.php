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
            <h3 class="card-title">Edit Artist Number {{ $artist->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/artist/{{ $artist->id }}">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $artist->first_name }}"
                        placeholder="Enter a first name" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $artist->last_name }}"
                        placeholder="Enter a last name" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Birth Date</label>
                    <input type="date" class="form-control" name="birth_date" value="{{ $artist->birth_date }}" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Birth Place</label>
                    <select class="form-control" name="birth_place">
                        @foreach ($countries as $code => $name)
                            <option value="{{ $name }}" @if($name == $artist->birth_place) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Death Date</label>
                    <input type="date" class="form-control" name="death_date" value="{{ $artist->death_date }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Death Place</label>
                    <select class="form-control" name="death_place">
                    <option value="" @></option>
                        @foreach ($countries as $code => $name)
                            <option value="{{ $name }}" @if($name == $artist->death_place) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nationality</label>
                    <input type="text" class="form-control" name="nationality" value="{{ $artist->nationality }}"
                        placeholder="Enter a nationality" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Biography</label>
                    <input class="form-control" name="biography" value="{{ $artist->biography }}"
                        placeholder="Enter a biography" required></textarea>
                </div>
            </div><!-- /.card-body -->

            <!-- /.card-footer -->
            <center>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </center>
        </form>
    </div><!-- /.card -->
@endsection
