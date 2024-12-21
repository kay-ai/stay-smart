<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(){
        $payments = Payment::where('user_id', auth()->id())->get();

        return view('payments.index', compact('payments'));
    }
}
