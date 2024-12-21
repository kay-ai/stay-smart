@extends('layouts.app', [$activePage = 'Payments'])

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-2 text-uppercase">Payments</h4>
                <hr>
                <div class="card rounded-4">
                    <div class="card-body">
                        @if(count($payments)>0)
                            <div class="table-responsive">
                                <table id="myPaymentTable" class="mDatatable table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payment Ref</th>
                                            <th>Property</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment->trx_ref }}</td>
                                            <td>{{ $payment->booking->property->name }}</td>
                                            <td>
                                                <span class="badge bg-{{ $payment->status == 'Completed' ? 'success' : ($payment->status == 'Failed' ? 'danger' : 'dark') }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $payment->payment_method }}</td>
                                            <td>{{ $payment->amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center mb-0 p-3">You have no Payments with us</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
