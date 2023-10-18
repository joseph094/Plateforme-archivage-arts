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
            <h3 class="card-title">Edit Bibliography Number {{ $bibliography->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/bibliography/{{ $bibliography->id }}">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="artwork_id">Artwork Id</label>
                    <input type="text" class="form-control" name="artwork_id" value="{{ $bibliography->artwork_id }}"
                        placeholder="Enter the artwork_id" required>
                </div>

                <div class="form-group">
                    <label for="book_title">Book Title</label>
                    <input type="text" class="form-control" name="book_title"
                        value="{{ $bibliography->book_title }}"placeholder="Enter the book_title" required>
                </div>

                <div class="form-group">
                    <label for="author_name">Author Name</label>
                    <input type="text" class="form-control" name="author_name" value="{{ $bibliography->author_name }}"
                        placeholder="Enter the author_name" required>
                </div>

                <div class="form-group">
                    <label for="publication_date">Publication Date</label>
                    <input type="date" class="form-control" name="publication_date"
                        value="{{ $bibliography->publication_date }}" placeholder="Enter the  publication_date" required>
                </div>

                <div class="form-group">
                    <label for="page">Number Of Pages</label>
                    <input type="text" class="form-control" name="page" value="{{ $bibliography->page }}"
                        placeholder="Enter the number of pages" required>
                </div>

                <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" name="publisher" value="{{ $bibliography->publisher }}"
                        placeholder="Enter the publisher" required>
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
