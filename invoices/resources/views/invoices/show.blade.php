@extends('layouts.app')

@section('title', __('messages.invoice.invoice_details'))

@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                {{-- Show Edit button only if status is not 2 or 3 --}}
                @if (!in_array($invoice->status, [2, 3]))
                    <a href="{{ route('invoices.edit', ['invoice' => $invoice->id]) }}" 
                       data-turbo="false" 
                       class="btn btn-primary me-4">
                        {{ __('messages.common.edit') }}
                    </a>
                @endif

                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')

            {{-- Show invoice details fields, set public view to true --}}
            @include('invoices.show_fields', ['isPublicView' => true])
        </div>
    </div>

    {{-- Modal for payment notes --}}
    @include('transactions.payment-notes-modal')
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/invoice/invoice_payment_history.js') }}"></script>
    <script src="{{ asset('assets/js/invoice/invoice_send.js') }}"></script>
@endsection
