@extends('layouts.app')

@section('content')

    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New Artist</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/artist">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    placeholder="Enter a first name" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" name="last_name" required
                                    placeholder="Enter a last name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Birth Place</label>
                                <select class="form-control" name="birth_place">
                                    @foreach ($countries as $code => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Death Date</label>
                                <input type="date" class="form-control" name="death_date">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Death Place</label>

                                <select class="form-control" name="death_place">
                                    <option value=""></option>
                                    @foreach ($countries as $code => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nationality</label>
                                <input type="text" class="form-control" name="nationality"
                                    placeholder="Enter a nationality" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Biography</label>
                                <textarea class="form-control" name="biography" placeholder="Enter a biography" required></textarea>
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
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </body>
@endsection
