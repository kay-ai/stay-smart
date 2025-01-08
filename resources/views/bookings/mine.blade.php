@extends('layouts.app', [$activePage = 'My Bookings'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-2 text-uppercase">My Bookings</h4>
                <hr>
                <div class="row">
                    @if(count($bookings)>0)
                        @foreach ($bookings as $index => $booking)
                            <div class="col-md-4">
                                <div class="card rounded-4 shadow-md p-0" style="overflow: hidden">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-4" style="overflow: hidden;">
                                                <div class="booking-img" style="height: 100%; width: 100%;">
                                                    <img class="img-fluid" style="height: 100%; object-fit: cover;" src="{{ asset('storage/' . $booking->property->image_path) }}" alt="booking-img">
                                                </div>
                                            </div>
                                            <div class="col-8 p-2 ps-0">
                                                <p class="card-title mb-0">{{$booking->property->name}}</p>
                                                <p class="card-text mb-0">{{$booking->check_in_date}} - {{$booking->check_out_date}}</p>
                                                <p class="card-text mb-0">₦ {{ $booking->total_price }}</p>
                                                <div class="d-flex justify-content-between align-items-center pe-3">
                                                    <p class="card-text mb-0">
                                                        <span class="badge bg-{{ $booking->status == 'Confirmed' ?'success' : ($booking->status == 'Cancelled' ? 'danger' : 'dark') }}">
                                                            {{ ucfirst($booking->status) }}
                                                        </span>
                                                    </p>
                                                    <div class="btn-group">
                                                        @if($booking->status == 'Confirmed')
                                                            <button class="btn btn-success btn-sm" onclick="handleCheckIn({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-left"></i></button>
                                                            <button class="btn btn-secondary btn-sm" onclick="handleCheckOut({{ $booking->id }})"><i class="ms-0 bi bi-box-arrow-right"></i></button>
                                                        @endif
                                                        <a href="{{route('booking.view', $booking->reference)}}" role="button" class="btn btn-dark btn-sm"><i class="ms-0 bi bi-eye"></i></a>
                                                        <button class="btn btn-danger btn-sm" onclick="handleCancel({{ $booking->id }})"><i class="ms-0 bi bi-x-circle"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mb-0 p-3">You have no bookings with us</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
