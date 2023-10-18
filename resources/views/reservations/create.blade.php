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
            <h3 class="card-title">Create New Reservation</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/reservation">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Artwork Id</label>
                    <input type="text" class="form-control" name="artwork_id" placeholder="Enter a artwork id" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Place</label>
                    <input type="text" class="form-control" name="place" placeholder="Enter the place" required>
                </div>

                <div class="form-group">
                    <label for="storage_method">Storage Method</label>
                    <select class="form-control" name="storage_method">
                        <option value="hung">hung</option>
                        <option value="placed_on_the_floor">placed_on_the_floor</option>
                        <option value="rolled">rolled</option>
                        <option value="shelved">shelved</option>
                        <option value="packed_bubble_wrap">packed_bubble_wrap</option>
                        <option value="packed_kraft_paper">packed_kraft_paper</option>
                        <option value="other">other</option>
                    </select>
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
