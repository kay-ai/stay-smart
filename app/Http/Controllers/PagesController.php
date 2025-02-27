<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome(){
        $properties = Property::where('status', 'Available')->withCount('bookings')
                    ->orderBy('bookings_count', 'desc')
                    ->take(20)
                    ->get();

        return view('welcome', compact('properties'));
    }

    public function services(){
        return view('services.index');
    }
}
