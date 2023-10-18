@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Acquisitions List') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
                    <a href="/acquisition/create" class="btn btn-primary mb-3">Create New Acquisition</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">


                                <form action="{{ route('acquisition.search') }}" method="get">
                                    <div class="input-group input-group-sm" style="width:100%;">
                                        <input type="text" id="search" name="query" class="form-control search-bar"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div style="margin-left:1em; margin-top:0.5em; margin-bottom:1.5em">
                                    <form action="{{ route('acquisition.filter') }}" method="get">
                                        <label for="creator">Sort By Creator</label>
                                        <select class="form-control" name="creator" id="creator"
                                            onchange='this.form.submit()' style="width:30%;">
                                            <option value=""></option>
                                            <option value="All">All </option>
                                            <option value="Mine">Mine</option>
                                        </select>
                                    </form>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


                                <script type="text/javascript">
                                    var route = "{{ url('/acquisition/autocomplete') }}";
                                    $('#search').typeahead({
                                        source: function(query, process) {
                                            return $.get(route, {
                                                query: query
                                            }, function(data) {
                                                return process(data);
                                            });

                                        }

                                    });
                                </script>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Artwork Id</th>
                                            <th>Current Owner</th>
                                            <th>Acquisition Date</th>
                                            <th>Acquisition Location</th>
                                            <th>Price</th>
                                            <th>Acquisition Method</th>
                                            <th>Proof Of Purchase</th>
                                            <th>Authenticity Certificate</th>
                                            <th colspan=2>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acquisitions as $acquisition)
                                            <tr>
                                                <td>{{ $acquisition->id }}</td>
                                                <td>{{ $acquisition->artwork_id }}</td>
                                                <td>{{ $acquisition->current_owner }}</td>
                                                <td>{{ $acquisition->acquisition_date }}</td>
                                                <td>{{ $acquisition->acquisition_location }}</td>
                                                <td>{{ $acquisition->price }}</td>
                                                <td>{{ $acquisition->acquisition_method }}</td>
                                                <td>{{ $acquisition->proof_of_purchase }}</td>
                                                <td>{{ $acquisition->authenticity_certificate }}</td>
                                                @if ($acquisition->user_id == auth()->user()->id || auth()->user()->role == "superadmin")
                                                    <td>
                                                        <a href="/acquisition/{{ $acquisition->id }}/edit"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('acquisition.destroy', $acquisition->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </body>
    <!-- /.content -->
@endsection
