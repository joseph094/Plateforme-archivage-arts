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
                        <h1 class="m-0">{{ __('Inventory Notices List') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('inventory_notice.search') }}" method="get">
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
                                    var route = "{{ url('/inventory_notice/autocomplete') }}";
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
                                            <th>Editor Name</th>
                                            <th>Updated At</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventory_notices as $inventory_notice)
                                            <tr>
                                                <td>{{ $inventory_notice->id }}</td>
                                                <td>{{ $inventory_notice->artwork_id }}</td>
                                                <td>{{ $inventory_notice->editor_name }}</td>
                                                <td>{{ $inventory_notice->created_at }}</td>

                                                <td>
                                                <td>

                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('inventory_notice.destroy', $inventory_notice->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                </td>
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
