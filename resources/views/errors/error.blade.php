@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>

    <body>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid errorbox">
                <p class="errortext">Sorry You don't have access to this function</p>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </body>
@endsection
