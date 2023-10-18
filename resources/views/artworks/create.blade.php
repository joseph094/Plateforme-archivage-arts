@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create new Artwork </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/artwork">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="inventory_number">Inventory Number</label>
                    <input type="text" class="form-control" name="inventory_number" placeholder="Enter an inventory_number"
                        required>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type">
                        <option value="painting">painting</option>
                        <option value="sculpture">sculpture</option>
                        <option value="graphics">graphics</option>
                        <option value="photography">photography</option>
                        <option value="video">video</option>
                        <option value="textile">textile</option>
                        <option value="installation">installation</option>
                        <option value="other">other</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter a title" required>
                </div>

                <div class="form-group">
                    <label for="artist_id">Artist ID</label>
                    <select class="form-control" name="artist_id" id="artists">
                        @foreach ($availableArtists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->first_name }} {{ $artist->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="materials">Materials</label>
                    <select class="form-control" name="materials" id="materials">
                        @foreach ($availableMaterials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary" id="create-material-btn">Create New Material</button>

                </div>
                <div class="modal fade" id="createMaterialModal" tabindex="-1" role="dialog"
                    aria-labelledby="createMaterialModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createMaterialModalLabel">Create Material</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="material-name-input"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"
                                    id="create-material-modal-btn">Create</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="support">Support</label>
                    <input type="text" class="form-control" name="support" placeholder="Enter a support" required>
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" name="height" placeholder="Enter the height">
                </div>

                <div class="form-group">
                    <label for="width">Width</label>
                    <input type="text" class="form-control" name="width" placeholder="Enter the width">
                </div>

                <div class="form-group">
                    <label for="depth">Depth</label>
                    <input type="text" class="form-control" name="depth" placeholder="Enter the depth">
                </div>

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" class="form-control" name="weight" placeholder="Enter the weight">
                </div>

                <div class="form-group">
                    <label for="elements_number">Elements Number</label>
                    <input type="text" class="form-control" name="elements_number"
                        placeholder="Enter the elements_number">
                </div>

                <div class="form-group">
                    <label for="print_number">Print Number</label>
                    <input type="text" class="form-control" name="print_number" placeholder="Enter the print_number">
                </div>

                <div class="form-group">
                    <label for="print_type">Print Type</label>
                    <input type="text" class="form-control" name="print_type" placeholder="Enter the print_type">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter the description"
                        required>
                </div>

                <div class="form-group">
                    <label for="signature">Signature</label>
                    <input type="text" class="form-control" name="signature" placeholder="Enter a signature"
                        required>
                </div>

                <div class="form-group">
                    <label for="signature_location">Signature Location</label>
                    <input type="text" class="form-control" name="signature_location"
                        placeholder="Enter a signature_location" required>
                </div>

                <div class="form-group">
                    <label for="conservation_location">Conservation Location</label>
                    <input type="text" class="form-control" name="conservation_location"
                        placeholder="Enter a conservation_location" required>
                </div>

                <div class="form-group">
                    <label for="storage_place">Storage Place</label>
                    <input type="text" class="form-control" name="storage_place" placeholder="Enter a storage_place"
                        required>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // When the "Create New Material" button is clicked
            $('#create-material-btn').click(function() {
                // Show the create material modal
                $('#createMaterialModal').modal('show');
            });

            // When the "Create" button in the "Create Material" modal is clicked
            $('#create-material-modal-btn').click(function() {
                // Get the entered material name
                var materialName = $('#material-name-input').val();

                // Send an AJAX request to create a new material
                $.ajax({
                    url: '/materialart',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: materialName,
                    },
                    success: function(response) {
                        // If the material was successfully created
                        if (response.success) {
                            // Append the new material option to the materials select input
                            $('#materials').append($('<option>', {
                                value: response.material.id,
                                text: response.material.name
                            }));
                            // Select the new material in the select input
                            $('#materials').val(response.material.id);
                            // Hide the create material modal
                            $('#createMaterialModal').modal('hide');
                        }
                    },
                    error: function() {
                        alert('Error creating material!');
                    }
                });
            });
        });
    </script>
@endsection
