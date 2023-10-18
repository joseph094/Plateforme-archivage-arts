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
                        <h1 class="m-0">{{ __('Artists List') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
                    <a href="/artist/create" class="btn btn-primary mb-3">Create New Artist</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('artist.search') }}" method="get">
                                    <div class="input-group input-group-sm" style="width: 100%">
                                        <input type="text" id="search" name="query" class="form-control search-bar"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


                                <script type="text/javascript">
                                    var route = "{{ url('/artist/autocomplete') }}";
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
                                <div style="margin-left:1em; margin-top:0.5em; margin-bottom:1.5em">
                                    <form action="{{ route('artist.filter') }}" method="get">
                                        <label for="creator">Sort By Creator</label>
                                        <select class="form-control" name="creator" id="creator"
                                            onchange='this.form.submit()' style="width:30%;">
                                            <option value=""></option>
                                            <option value="All">All </option>
                                            <option value="Mine">Mine</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Birth Date</th>
                                            <th>Birth Place</th>
                                            <th>Death Date</th>
                                            <th>Death Place</th>
                                            <th>Nationality</th>
                                            <th>Biography</th>
                                            <th colspan=2>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artists as $artist)
                                            <tr>
                                                <td>{{ $artist->id }}</td>
                                                <td>{{ $artist->first_name }}</td>
                                                <td>{{ $artist->last_name }}</td>
                                                <td>{{ $artist->birth_date }}</td>
                                                <td>{{ $artist->birth_place }}</td>
                                                <td>{{ $artist->death_date }}</td>
                                                <td>{{ $artist->death_place }}</td>
                                                <td>{{ $artist->nationality }}</td>
                                                <td>{{ $artist->biography }}</td>

                                                @if ($artist->user_id == auth()->user()->id || auth()->user()->role == "superadmin")
                                                    <td>
                                                        <a href="/artist/{{ $artist->id }}/edit"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('artist.destroy', $artist->id) }}"
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
