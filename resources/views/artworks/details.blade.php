@extends('layouts.app')

@section('content')

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    </head>

    <body>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Artwork Number {{ $artwork->id }} </h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{ $artwork->title }}</h3>
                            @if (isset($images[0]))
                                <div class="col-12">
                                    <img src="../images/{{ $images[0]->path }}" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">

                                    @foreach ($images as $key => $image)
                                        <div class="product-image-thumb {{ $key == 0 ? 'active' : '' }}"><img
                                                src="../images/{{ $image->path }}" alt="Product Image"></div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <img src="../images/1674596346.png" class="product-image" alt="Product Image">
                                    </div>
                                    <div class="col-12 product-image-thumbs">
                                        <div class="product-image-thumb  "><img src="../images/1674596346.png"
                                                alt="Product Image"></div>
                                        <div class="product-image-thumb "><img src="../images/1674596346.png"
                                                alt="Product Image"></div>
                                        <div class="product-image-thumb "><img src="../images/1674596346.png"
                                                alt="Product Image"></div>
                                        <div class="product-image-thumb "><img src="../images/1674596346.png"
                                                alt="Product Image"></div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $artwork->title }} </h3>
                        <p>{{ $artwork->description }}</p>
                        <hr>
                        <h2 style="margin-top:2em;">Current Location</h2>
                        @if ($currentLocation->current_owner)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Acquisition</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Current Owner</td>
                                            <td>{{ $currentLocation->current_owner }}</td>
                                        </tr>
                                        <tr>
                                            <td>Acquisition Date</td>
                                            <td>{{ $currentLocation->acquisition_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Acquisition Location</td>
                                            <td>{{ $currentLocation->acquisition_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Acquisition Method</td>
                                            <td>{{ $currentLocation->acquisition_method }}</td>
                                        </tr>
                                        @if (isset($currentLocation->price))
                                            <tr>
                                                <td>Price</td>
                                                <td>{{ $currentLocation->price }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($currentLocation->proof_of_purchase))
                                            <tr>
                                                <td>Proof Of Purchase</td>
                                                <td>{{ $currentLocation->proof_of_purchase }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($currentLocation->authenticity_certificate))
                                            <tr>
                                                <td>Authenticity Certificate</td>
                                                <td>{{ $currentLocation->authenticity_certificate }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($currentLocation->exhibition_location)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover" style="text-align:left">
                                    <thead>
                                        <tr>
                                            <th>Exhibition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Exhibition Title</td>
                                            <td>{{ $currentLocation->exhibition_title }}</td>
                                        </tr>
                                        @if (isset($currentLocation->specific_constraints))
                                            <tr>
                                                <td>specific_constraints</td>
                                                <td>{{ $currentLocation->specific_constraints }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Exhibition Location</td>
                                            <td>{{ $currentLocation->exhibition_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Start Date</td>
                                            <td>{{ $currentLocation->start_date }}</td>
                                        </tr>
                                        @if (isset($currentLocation->end_date))
                                            <tr>
                                                <td>End Date</td>
                                                <td>{{ $currentLocation->end_date }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($currentLocation->institution)
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Loan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Institution</td>
                                            <td>{{ $currentLocation->institution }}</td>
                                        </tr>
                                        <tr>
                                            <td>Exhibition Title</td>
                                            <td>{{ $currentLocation->exhibition_title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Departure Date</td>
                                            <td>{{ $currentLocation->departure_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Return Date</td>
                                            <td>{{ $currentLocation->return_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($currentLocation->diagnosis)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Restoration</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Diagnosis</td>
                                            <td>{{ $currentLocation->diagnosis }}</td>
                                        </tr>
                                        <tr>
                                            <td>Causes</td>
                                            <td>{{ $currentLocation->causes }}</td>
                                        </tr>
                                        <tr>
                                            <td>Restoration Date</td>
                                            <td>{{ $currentLocation->restoration_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Restoration Location</td>
                                            <td>{{ $currentLocation->restoration_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Restorer Name</td>
                                            <td>{{ $currentLocation->restorer_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Intervention Type</td>
                                            <td>{{ $currentLocation->intervention_type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Materials And Techniques</td>
                                            <td>{{ $currentLocation->materials_and_techniques }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($currentLocation->place)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Reservation</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Place</td>
                                            <td>{{ $currentLocation->place }}</td>
                                        </tr>
                                        <tr>
                                            <td>Storage Method</td>
                                            <td>{{ $currentLocation->storage_method }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ($currentLocation->conservation_location)
                            <p style="font-size:1.2rem"> This artwork is currently conserved in its normal conservation
                                location : <span style="color:#4981f5"> {{ $currentLocation->conservation_location }}
                                </span></p>
                        @endif
                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="artwork-tab" role="tablist">
                            <a class="nav-item nav-link active" id="artwork-info-tab" data-toggle="tab" href="#artwork-info"
                                role="tab" aria-controls="artwork-info" aria-selected="true">Artwork Information</a>
                            @if (isset($acquisition))
                                <a class="nav-item nav-link" id="artwork-acquistion-tab" data-toggle="tab"
                                    href="#artwork-acquistion" role="tab" aria-controls="artwork-acquistion"
                                    aria-selected="false">Acquisition Information</a>
                            @endif
                            @if (count($bibliography) > 0)
                                <a class="nav-item nav-link" id="artwork-bibliography-tab" data-toggle="tab"
                                    href="#artwork-bibliography" role="tab" aria-controls="artwork-bibliography"
                                    aria-selected="false">Bibliography Information</a>
                            @endif
                            @if (count($exhibitions) > 0)
                                <a class="nav-item nav-link" id="artwork-exhibition-tab" data-toggle="tab"
                                    href="#artwork-exhibition" role="tab" aria-controls="artwork-exhibition"
                                    aria-selected="false">Exhibitions Information</a>
                            @endif
                            @if (count($loans) > 0)
                                <a class="nav-item nav-link" id="artwork-loan-tab" data-toggle="tab" href="#artwork-loan"
                                    role="tab" aria-controls="artwork-loan" aria-selected="false">Loans Information</a>
                            @endif
                            @if (count($restorations) > 0)
                                <a class="nav-item nav-link" id="artwork-restoration-tab" data-toggle="tab"
                                    href="#artwork-restoration" role="tab" aria-controls="artwork-restoration"
                                    aria-selected="false">Restoration Information</a>
                            @endif
                            @if (count($reservations) > 0)
                                <a class="nav-item nav-link" id="artwork-reservation-tab" data-toggle="tab"
                                    href="#artwork-reservation" role="tab" aria-controls="artwork-reservation"
                                    aria-selected="false">Reservations Information</a>
                            @endif
                        </div>
                    </nav>
                    <div class="tab-content p-3 w-100" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="artwork-info" role="tabpanel"
                            aria-labelledby="artwork-info-tab">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Artwork General Information</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Type</td>
                                            <td>{{ $artwork->type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Artist</td>
                                            <td>{{ $artist->first_name }} {{ $artist->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Material Used</td>
                                            <td>{{ $material_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Support Used</td>
                                            <td>{{ $artwork->support }}</td>
                                        </tr>
                                        <tr>
                                            <td>Publication Date</td>
                                            <td>{{ $artwork->created_at }}</td>
                                        </tr>
                                        @if (isset($artwork->height))
                                            <tr>
                                                <td>Height</td>
                                                <td>{{ $artwork->height }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->width))
                                            <tr>
                                                <td>Width</td>
                                                <td>{{ $artwork->width }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->depth))
                                            <tr>
                                                <td>Depth</td>
                                                <td>{{ $artwork->depth }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->weight))
                                            <tr>
                                                <td>Weight</td>
                                                <td>{{ $artwork->weight }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->elements_number))
                                            <tr>
                                                <td>Number Of Elements</td>
                                                <td>{{ $artwork->elements_number }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->print_number))
                                            <tr>
                                                <td>Print Number</td>
                                                <td>{{ $artwork->print_number }}</td>
                                            </tr>
                                        @endif
                                        @if (isset($artwork->print_type))
                                            <tr>
                                                <td>Print Type</td>
                                                <td>{{ $artwork->print_type }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Signature</td>
                                            <td>{{ $artwork->signature }}</td>
                                        </tr>
                                        <tr>
                                            <td>Signature Location</td>
                                            <td>{{ $artwork->signature_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Conservation Location</td>
                                            <td>{{ $artwork->conservation_location }}</td>
                                        </tr>
                                        <tr>
                                            <td>Storage Location</td>
                                            <td>{{ $artwork->storage_place }}</td>
                                        </tr>
                                        <tr>
                                            <td>Storage Method</td>
                                            <td>{{ $artwork->storage_method }}</td>
                                        </tr>
                                        <tr>
                                            <td>Inventory Number</td>
                                            <td>{{ $artwork->inventory_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if (isset($acquisition))
                            <div class="tab-pane fade" id="artwork-acquistion" role="tabpanel"
                                aria-labelledby="artwork-acquistion-tab">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Acquisition</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Current Owner</td>
                                                <td>{{ $acquisition->current_owner }}</td>
                                            </tr>
                                            <tr>
                                                <td>Acquisition Date</td>
                                                <td>{{ $acquisition->acquisition_date }}</td>
                                            </tr>
                                            <tr>
                                                <td>Acquisition Location</td>
                                                <td>{{ $acquisition->acquisition_location }}</td>
                                            </tr>
                                            <tr>
                                                <td>Acquisition Method</td>
                                                <td>{{ $acquisition->acquisition_method }}</td>
                                            </tr>
                                            @if (isset($acquisition->price))
                                                <tr>
                                                    <td>Price</td>
                                                    <td>{{ $acquisition->price }}</td>
                                                </tr>
                                            @endif
                                            @if (isset($acquisition->proof_of_purchase))
                                                <tr>
                                                    <td>Proof Of Purchase</td>
                                                    <td>{{ $acquisition->proof_of_purchase }}</td>
                                                </tr>
                                            @endif
                                            @if (isset($acquisition->authenticity_certificate))
                                                <tr>
                                                    <td>Authenticity Certificate</td>
                                                    <td>{{ $acquisition->authenticity_certificate }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        @if (count($bibliography) > 0)
                            <div class="tab-pane fade" id="artwork-bibliography" role="tabpanel"
                                aria-labelledby="artwork-bibliography-tab">
                                <div class="card-body table-responsive p-0">
                                    @foreach ($bibliography as $bibliography)
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Bibliography</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Book Title</td>
                                                    <td>{{ $bibliography->book_title }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Author Name</td>
                                                    <td>{{ $bibliography->author_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Publication Date</td>
                                                    <td>{{ $bibliography->publication_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>page</td>
                                                    <td>{{ $bibliography->page }}</td>
                                                </tr>
                                                <tr>
                                                    <td>publisher</td>
                                                    <td>{{ $bibliography->publisher }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (count($exhibitions) > 0)
                            <div class="tab-pane fade" id="artwork-exhibition" role="tabpanel"
                                aria-labelledby="artwork-exhibition-tab">
                                <div class="card-body table-responsive p-0">
                                    @foreach ($exhibitions as $exhibition)
                                        <table class="table table-hover" style="text-align:left">
                                            <thead>
                                                <tr>
                                                    <th>Exhibition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Exhibition Title</td>
                                                    <td>{{ $exhibition->exhibition_title }}</td>
                                                </tr>
                                                @if (isset($exhibition->specific_constraints))
                                                    <tr>
                                                        <td>specific_constraints</td>
                                                        <td>{{ $exhibition->specific_constraints }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>Exhibition Location</td>
                                                    <td>{{ $exhibition->exhibition_location }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Start Date</td>
                                                    <td>{{ $exhibition->start_date }}</td>
                                                </tr>
                                                @if (isset($exhibition->end_date))
                                                    <tr>
                                                        <td>End Date</td>
                                                        <td>{{ $exhibition->end_date }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (count($loans) > 0)
                            <div class="tab-pane fade" id="artwork-loan" role="tabpanel"
                                aria-labelledby="artwork-loan-tab">
                                <div class="card-body table-responsive p-0">
                                    @foreach ($loans as $loan)
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Loan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Institution</td>
                                                    <td>{{ $loan->institution }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Exhibition Title</td>
                                                    <td>{{ $loan->exhibition_title }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Departure Date</td>
                                                    <td>{{ $loan->departure_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Return Date</td>
                                                    <td>{{ $loan->return_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (count($restorations) > 0)
                            <div class="tab-pane fade" id="artwork-restoration" role="tabpanel"
                                aria-labelledby="artwork-restoration-tab">
                                <div class="card-body table-responsive p-0">
                                    @foreach ($restorations as $restoration)
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Restoration</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Diagnosis</td>
                                                    <td>{{ $restoration->diagnosis }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Causes</td>
                                                    <td>{{ $restoration->causes }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Restoration Date</td>
                                                    <td>{{ $restoration->restoration_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Restoration Location</td>
                                                    <td>{{ $restoration->restoration_location }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Restorer Name</td>
                                                    <td>{{ $restoration->restorer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Intervention Type</td>
                                                    <td>{{ $restoration->intervention_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Materials And Techniques</td>
                                                    <td>{{ $restoration->materials_and_techniques }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (count($reservations) > 0)
                            <div class="tab-pane fade" id="artwork-reservation" role="tabpanel"
                                aria-labelledby="artwork-reservation-tab">
                                <div class="card-body table-responsive p-0">
                                    @foreach ($reservations as $reservation)
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Reservation</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Place</td>
                                                    <td>{{ $reservation->place }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Storage Method</td>
                                                    <td>{{ $reservation->storage_method }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>
        <!-- AdminLTE App -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dagre-d3/0.4.17/demo/demo.js"></script>
        <script>
            $(document).ready(function() {
                $('.product-image-thumb').on('click', function() {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })
            })
        </script>
    </body>

@endsection
