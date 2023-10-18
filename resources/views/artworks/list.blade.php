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
                        <h1 class="m-0">{{ __('Artworks List') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
                    <a href="/artwork/create" class="btn btn-primary mb-3">Create New Artwork</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                <form action="{{ route('artwork.search') }}" method="get">
                                    <div class="input-group input-group-sm" style="width: 100%;">
                                        <input type="text" id="search" name="query" class="form-control search-bar"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


                            <script type="text/javascript">
                                var route = "{{ url('/artwork/autocomplete') }}";
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
                            <div class="row w-100">
                                <div style="width:50% ; margin-left:1em; margin-top:0.5em; margin-bottom:1.5em">
                                    <form action="{{ route('artwork.filter') }}" method="get">
                                        <label for="type">Sort By Type</label>
                                        <select class="form-control" name="type" id="type"
                                            onchange='this.form.submit()' style="width:90%;">
                                            <option value=""></option>
                                            <option value="painting">Painting</option>
                                            <option value="sculpture">Sculpture</option>
                                            <option value="photography">Photography</option>
                                            <option value="graphics">Graphics</option>
                                            <option value="video">Video</option>
                                            <option value="textile">Textile</option>
                                            <option value="installation">Installation</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </form>
                                </div>
                                <div style="width:40%; margin-left:1em; margin-top:0.5em; margin-bottom:1.5em">
                                    <form action="{{ route('artwork.filterc') }}" method="get">
                                        <label for="creator">Sort By Creator</label>
                                        <select class="form-control" name="creator" id="creator"
                                            onchange='this.form.submit()' style="width:100%;">
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
                                            <th>Inventory Number</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Artist</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th colspan=3>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($artworks as $artwork)
                                            <tr>
                                                <td>{{ $artwork->id }}</td>
                                                <td>{{ $artwork->inventory_number }}</td>
                                                <td>{{ $artwork->type }}</td>
                                                <td>{{ $artwork->title }}</td>
                                                <td>{{ $artwork->artist_id }}</td>
                                                <td>{{ $artwork->created_at }}</td>
                                                <td>{{ $artwork->updated_at }}</td>
                                                <td><a href="/artwork/{{ $artwork->id }}"
                                                        class="btn btn-warning">Details</a>
                                                </td>
                                                 @if ($artwork->user_id == auth()->user()->id || auth()->user()->role == "superadmin")
                                                 <td>

                                                    <a href="/artwork/{{ $artwork->id }}/edit"
                                                        class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('artwork.destroy', $artwork->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this artwork? It will delete all the objects related to it')">Delete</button>
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
        <!-- /.content -->
    </body>
@endsection
