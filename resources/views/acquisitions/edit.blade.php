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
            <h3 class="card-title">Edit Acquisition Number {{ $acquisition->id }}'s Information</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/acquisition/{{ $acquisition->id }}">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="artwork_id">Artwork ID</label>
                    <input type="text" class="form-control" name="artwork_id" value="{{ $acquisition->artwork_id }}"
                        placeholder="Enter the artwork_id">
                </div>

                <div class="form-group">
                    <label for="current_owner">Current Owner</label>
                    <input type="text" class="form-control" name="current_owner"
                        value="{{ $acquisition->current_owner }}" placeholder="Enter the current_owner">
                </div>

                <div class="form-group">
                    <label for="acquisition_date">Acquisition Date</label>
                    <input type="date" class="form-control" name="acquisition_date"
                        value="{{ $acquisition->acquisition_date }}">
                </div>

                <div class="form-group">
                    <label for="acquisition_location">Acquisition Location</label>
                    <input type="text" class="form-control" name="acquisition_location"
                        value="{{ $acquisition->acquisition_location }}" placeholder="Enter an acquisition_location">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value="{{ $acquisition->price }}">
                </div>

                <div class="form-group">
                    <label for="acquisition_method">Acquisition Method</label>
                    <select class="form-control" name="acquisition_method" value="{{ $acquisition->acquisition_method }}">
                        <option value="purchase">purchase</option>
                        <option value="donation">donation</option>
                        <option value="bequest">bequest</option>
                        <option value="other">other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="proof_of_purchase">Proof Of Purchase</label>
                    <input type="text" class="form-control" name="proof_of_purchase"
                        value="{{ $acquisition->proof_of_purchase }}" placeholder="Enter a proof_of_purchase">
                </div>

                <div class="form-group">
                    <label for="authenticity_certificate">Authenticity Certificate</label>
                    <input type="text" class="form-control" name="authenticity_certificate"
                        value="{{ $acquisition->authenticity_certificate }}"
                        placeholder="Enter a authenticity_certificate">
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
