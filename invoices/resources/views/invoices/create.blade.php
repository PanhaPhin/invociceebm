@extends('layouts.app')
@php
    use Collective\Html\FormFacade as Form;
@endphp
@section('title')
    {{ __('messages.invoice.new_invoice') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end">
                <a class="btn btn-outline-primary float-end"
                   href="{{ url()->previous() }}">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    <div class="alert alert-danger display-none hide" id="validationErrorsBox"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'invoices.store', 'id' => 'invoiceForm', 'name' => 'invoiceForm']) }}
                    @include('invoices.fields')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('invoices.templates.templates')
    {{ Form::hidden('clients',json_encode($clients, true),['id' => 'clients']) }}
    {{-- {{ Form::hidden('ExchangeRate',json_encode($currencies, true),['id' => 'currencies']) }} --}}
   
    
    {{ Form::hidden('products',json_encode($associateProducts, true),['id' => 'products']) }}
    {{ Form::hidden('taxes',json_encode($associateTaxes, true),['id' => 'taxes']) }}   
    {{ Form::hidden('exchange_rate',isset($invoice->exchange_rate) ? $invoice->exchange_rate : null ,['id' => 'exchangeRate']) }}
    {{ Form::hidden('vat_tin',isset($invoice->vat_tin) ? $invoice->vat_tin : null ,['id' => 'vatTin']) }}
    {{ Form::hidden('exchange_rate_to_riel',isset($invoice->exchange_rate_to_riel) ? $invoice->exchange_rate_to_riel : null ,['id' => 'exchangeRateToRiel']) }}
    {{ Form::hidden('invoice_note',isset($invoice->note) ,['id' => 'invoiceNote']) }}
    {{ Form::hidden('invoice_term',isset($invoice->term) ,['id' => 'invoiceTerm']) }}
    {{ Form::hidden('invoice_recurring',isset($invoice->recurring) ,['id' => 'invoiceRecurring']) }}
    {{ Form::hidden('thousand_separator',getSettingValue('thousand_separator') ,['id' => 'thousandSeparator']) }}
    {{ Form::hidden('decimal_separator',isset($invoice->recurring) ,['id' => 'decimalSeparator']) }}
    {{ Form::hidden('default_tax',json_encode($defaultTax, true),['id' => 'defaultTax']) }}
@endsection
