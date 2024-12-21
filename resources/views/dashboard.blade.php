@extends('layouts.app', [$activePage = 'Dashboard'])

@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Total Properties</p>
                                <h4 class="mb-0">{{number_format($properties->count())}}</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>Since Inception</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-primary text-white">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">My Bookings</p>
                                <h4 class="mb-0">{{number_format($my_bookings->count())}}</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>Since Inception</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Total Bookings</p>
                                <h4 class="mb-0">{{number_format($bookings->count())}}</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>Since Inception</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-secondary text-white">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Total Users</p>
                                <h4 class="mb-0">{{number_format($users)}}</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>Since Inception</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-dark text-white">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->

        <div class="row">
            <div class="property-carousel owl-carousel owl-theme">
                @foreach ($trending_properties as $property)
                    <div class="item">
                        <div class="card">
                            <div class="property-badge">
                                <span class="booked {{$property->status == 'Booked' ? 'bg-danger' : ($property->status == 'Available' ? 'bg-success' : '')}}">{{$property->status}}</span>
                                <span class="price bg-success">₦ {{$property->price_per_night}}</span>
                            </div>
                            <img src="{{ asset('storage/' . $property->image_path) }}" alt="{{ $property->name }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->name }}</h5>
                                <p class="card-text">{{ $property->location }}</p>
                                <p class="card-text buttons gap-2">
                                    <a href="/book/property/{{$property->id}}" class="icons plus">
                                        <i class="bi bi-plus-lg"></i>
                                    </a>
                                    <a href="#" class="icons bookmark">
                                        <i class="bi bi-bookmark"></i>
                                    </a>
                                    <a href="#" class="icons eye">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!--end row-->

        <div class="row px-3">
            <h6 class="mb-2 text-uppercase">My Bookings</h6>
            <hr/>
            <div class="card rounded-4">
                <div class="card-body">
                    @if(count($my_bookings)>0)
                        <div class="table-responsive">
                            <table id="myBookingsTable" class="mDatatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Ref</th>
                                        <th>Property</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($my_bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->reference }}</td>
                                        <td>{{ $booking->property->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Cancelled' ? 'danger' : 'dark') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <div class="btn-group">
                                                @if($booking->status == 'Confirmed')
                                                    <button class="btn btn-success btn-sm" onclick="handleCheckIn({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-left"></i></button>
                                                    <button class="btn btn-secondary btn-sm" onclick="handleCheckOut({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-right"></i></button>
                                                @endif
                                                <a href="{{route('booking.view', $booking->reference)}}" role="button" class="btn btn-dark btn-sm"><i class="ms-0 bi bi-eye"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="handleCancel({{ $booking->id }})"><i class="ms-0 bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0 p-3">You have no bookings with us</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row px-3 mt-3">
            <h6 class="mb-2 text-uppercase">Manage all Bookings</h6>
            <hr/>
            <div class="card rounded-4">
                <div class="card-body">
                    @if(count($bookings)>0)
                        <div class="table-responsive">
                            <table id="bookingsTable" class="mDatatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Ref</th>
                                        <th>User</th>
                                        <th>Property</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $booking->reference }}</td>
                                        <td>{{ $booking->user->first_name . ' ' . $booking->user->last_name }}</td>
                                        <td>{{ $booking->property->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Cancelled' ? 'danger' : 'dark') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <div class="btn-group">
                                                @if($booking->status == 'Confirmed')
                                                    <button class="btn btn-success btn-sm" onclick="handleCheckIn({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-left"></i></button>
                                                    <button class="btn btn-secondary btn-sm" onclick="handleCheckOut({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-right"></i></button>
                                                @endif
                                                <a href="{{route('booking.view', $booking->reference)}}" role="button" class="btn btn-dark btn-sm"><i class="ms-0 bi bi-eye"></i></a>
                                                <button class="btn btn-danger btn-sm" onclick="handleCancel({{ $booking->id }})"><i class="ms-0 bi bi-x-circle"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0 p-3">There are no bookings in the system</p>
                    @endif
                </div>
            </div>
        </div>

    </main>
    <!--end page main-->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });
    </script>
@endpush
