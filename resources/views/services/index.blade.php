@extends('layouts.app', [$activePage = 'Payments'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container p-5">
        <div class="row gap-5 justify-content-center">
            <div class="col-md-5 col-sm-12">
                <div class="card rounded-4 p-3" style="width: 100%;">
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <img src="{{asset('dashboard/assets/images/chef.jpg')}}" alt="" style="text-align:center; width: 80%">
                        </div>
                        <p>Professional Chefs are waiting</p>
                        <button type="submit" class="btn btn-primary rounded-4 px-4">Book a Chef</button>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card rounded-4 p-3" style="width: 100%;">
                    <div class="card-body text-center">
                        <div class="row justify-content-center">
                            <img src="{{asset('dashboard/assets/images/driver.avif')}}" alt="" style="text-align:center; width: 94%">
                        </div>
                        <p class="mt-3">Anywhere, Anytime. Our Drivers Available all day</p>
                        <button type="submit" class="btn btn-primary rounded-4 px-4">Book a Driver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
