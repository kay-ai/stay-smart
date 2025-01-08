@extends('layouts.app', [$activePage = 'My Bookings'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-12 p-md-4">
                <div class="property-banner">
                    <img class="property-banner-image" src="{{ asset('storage/' . $property->image_path) }}">
                    <div class="property-banner-content">
                        <div class="text-center">
                            <h1>{{$property->name}}</h1>
                            <small class="">{{$property->address}}, {{$property->city}}, {{ $property->country }}</small>
                        </div>
                        <div class="property-badge" style="font-size: 14px">
                            <span class="booked {{$property->status == 'Booked' ? 'bg-danger' : ($property->status == 'Available' ? 'bg-success' : '')}}">{{$property->status}}</span>
                            <span class="price bg-success">₦ {{$property->price_per_night}}</span>
                        </div>
                    </div>
                </div>
                <div class="amenities gap-2 px-md-5" style="flex-wrap: wrap">
                    <span class="item">{{$property->max_guests}} Max Guests</span>
                    @foreach($property->amenities as $amenity)
                        <span class="item">{{$amenity->name}}</span>
                    @endforeach
                </div>
                <div class="desc px-md-5 mt-3">
                    <p class="text-center">{{$property->description}}</p>
                </div>
                <form class="px-md-5 pt-3" action="{{route('booking.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputCheckInDate" class="form-label">Check-in Date</label>
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                    <i class="bi bi-calendar-range-fill"></i>
                                </div>
                                <input type="date" name="check_in_date"
                                    class="form-control radius-30 ps-5 @error('check_in_date') is-invalid @enderror" id="inputCheckInDate" value="{{old('check_in_date')}}" required>
                            </div>
                            @error('check_in_date')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="inputCheckOutDate" class="form-label">Check-out Date</label>
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                    <i class="bi bi-calendar-range-fill"></i>
                                </div>
                                <input type="date" name="check_out_date"
                                    class="form-control radius-30 ps-5 @error('check_out_date') is-invalid @enderror" id="inputCheckOutDate" value="{{old('check_out_date')}}" required>
                            </div>
                            @error('check_out_date')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="inputNumberOfGuests" class="form-label">Number of Guests</label>
                            <div class="ms-auto position-relative">
                                <div
                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <input type="number" name="number_of_guests"
                                    class="form-control radius-30 ps-5 @error('number_of_guests') is-invalid @enderror" id="inputNumberOfGuests" value="{{old('number_of_guests')}}" min="1" max="{{$property->max_guests}}" required>
                            </div>
                            @error('number_of_guests')
                                <small class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <input type="hidden" name="property_id" value="{{$property->id}}">
                        <div class="col-12 my-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-4 px-4">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
