@extends('layouts.app', [$activePage = 'My Bookings'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-2 text-uppercase">My Bookings</h4>
                <hr>
                <div class="card rounded-4">
                    <div class="card-body">
                        @if(count($bookings)>0)
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
                                        @foreach ($bookings as $index => $booking)
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
        </div>
    </div>
</main>
@endsection
