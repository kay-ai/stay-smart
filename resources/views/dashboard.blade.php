@extends('layouts.app')

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
                                <i class="bi bi-person-lines-fill"></i>
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
                                <h4 class="mb-0">{{number_format($my_bookings)}}</h4>
                                <p class="mb-0 mt-2 font-13"><i class="bi bi-arrow-up"></i><span>Since Inception</span></p>
                            </div>
                            <div class="ms-auto widget-icon bg-success text-white">
                                <i class="bi bi-currency-dollar"></i>
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
                            <div class="ms-auto widget-icon bg-orange text-white">
                                <i class="bi bi-emoji-heart-eyes"></i>
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
                            <div class="ms-auto widget-icon bg-info text-white">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->

        <div class="row">
        </div>
        <!--end row-->

        <div class="row">
            <h6 class="mb-0 text-uppercase">Manage Bookings</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    @if(count($bookings)>0)
                        <div class="table-responsive">
                            <table id="bookingsTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking ID</th>
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
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->property->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'active' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'secondary') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $booking->start_date }}</td>
                                        <td>{{ $booking->end_date }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm" onclick="handleCheckIn({{ $booking->id }})">Check In</button>
                                                <button class="btn btn-warning btn-sm" onclick="handleCheckOut({{ $booking->id }})">Check Out</button>
                                                <button class="btn btn-danger btn-sm" onclick="handleCancel({{ $booking->id }})">Cancel</button>
                                                <button class="btn btn-dark btn-sm" onclick="handleDelete({{ $booking->id }})">Delete</button>
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
            $('#bookingsTable').DataTable();
        });
    </script>
@endpush
