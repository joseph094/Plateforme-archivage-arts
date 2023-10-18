@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    </head>

    <body>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Images List') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
                    <a href="/image/create" class="btn btn-primary mb-3">Add New Image</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>

                                <form action="{{ route('image.search') }}" method="get">
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
                                <div style="margin-left:1em; margin-top:0.5em; margin-bottom:1.5em">
                                    <form action="{{ route('image.filter') }}" method="get">
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
                                    var route = "{{ url('/image/autocomplete') }}";
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
                                            <th>Image</th>
                                            <th>Artwork Id</th>
                                            <th>Copyright Notice</th>
                                            <th>Photographic Rights</th>
                                            <th colspan=2>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($images as $image)
                                            <tr>
                                                <td>{{ $image->id }}</td>
                                                <td><a class="image-popup-no-margins"
                                                        href="../images/{{ $image->path }}"><img
                                                            src="../images/{{ $image->path }}" width="75px"
                                                            height="75px" /></a></td>
                                                <td>{{ $image->artwork_id }}</td>
                                                <td>{{ $image->copyright_notice }}</td>
                                                <td>{{ $image->photographic_rights }}</td>
                                                @if ($image->user_id == auth()->user()->id || auth()->user()->role == "superadmin")
                                                    <td>
                                                        <a href="/image/{{ $image->id }}/edit"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('image.destroy', $image->id) }}"
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
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('.image-popup-no-margins').magnificPopup({
                                            type: 'image',
                                            closeOnContentClick: true,
                                            closeBtnInside: false,
                                            fixedContentPos: true,
                                            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                                            image: {
                                                verticalFit: true
                                            },
                                            zoom: {
                                                enabled: true,
                                                duration: 300 // don't foget to change the duration also in CSS
                                            }
                                        });
                                    });
                                </script>
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
