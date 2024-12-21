@extends('layouts.app', [$activePage = 'My Bookings'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-4">
                <div class="property-banner">
                    <img class="property-banner-image" src="{{ asset('storage/' . $booking->property->image_path) }}">
                    <div class="property-banner-content">
                        <div class="text-center">
                            <h1>{{$booking->property->name}}</h1>
                            <small class="">{{$booking->property->address}}, {{$booking->property->city}}, {{ $booking->property->country }}</small>
                        </div>
                        <div class="property-badge" style="font-size: 14px">
                            <span class="booked {{$booking->property->status == 'Booked' ? 'bg-danger' : ($booking->property->status == 'Available' ? 'bg-success' : '')}}">{{$booking->property->status}}</span>
                            <span class="price bg-success">₦ {{$booking->property->price_per_night}}</span>
                        </div>
                    </div>
                </div>
                <div class="amenities gap-2 px-5">
                    <span class="item">{{$booking->property->max_guests}} Max Guests</span>
                    @foreach($booking->property->amenities as $amenity)
                        <span class="item">{{$amenity->name}}</span>
                    @endforeach
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-5">
                        <table class="table">
                            <tr>
                                <th>Booking Status</th>
                                <td>
                                    <span class="badge {{$booking->status == 'Cancelled' ? 'bg-danger' : ($booking->status == 'Confirmed' ? 'bg-success' : 'bg-dark')}}">{{ $booking->status}}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Booking Name</th>
                                <td>{{$booking->user->first_name . ' ' . $booking->user->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$booking->user->email}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$booking->user->phone_number}}</td>
                            </tr>
                            <tr>
                                <th>Check-In</th>
                                <td>{{$booking->check_in_date}}</td>
                            </tr>
                            <tr>
                                <th>Check-Out</th>
                                <td>{{$booking->check_out_date}}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td>₦ {{ $booking->total_price }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                @if ($booking->status == 'Cancelled' || ($booking->payment && $booking->payment->status == 'Completed'))
                @else
                <div class="desc px-5 mt-4">
                    <h4 class="text-center">Pay <b>securely</b> now to confirm your booking</h4>
                </div>
                <form class="px-5 pt-1" action="{{route('booking.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="property_id" value="{{$booking->property->id}}">
                        <div class="col-12 mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-4 px-4">Confirm Booking</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
