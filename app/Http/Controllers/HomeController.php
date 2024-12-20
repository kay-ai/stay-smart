<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bookings = Booking::latest()->get();
        $my_bookings = Booking::where('id', auth()->id())->count();
        $properties = Property::latest()->get();
        $users = User::count();
        return view('dashboard', compact('bookings', 'my_bookings', 'properties', 'users'));
    }
}
