@extends('layouts.app')

@section('title', __('messages.quote.quote_details'))

@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <h1 class="mb-3 mb-md-0 fs-3">@yield('title')</h1>

            <div class="text-end mt-3 mt-md-0">
                {{-- Show Edit button only if quote is not converted --}}
                @if ($quote->status !== \App\Models\Quote::CONVERTED)
                    <a href="{{ route('quotes.edit', ['quote' => $quote->id]) }}" 
                       class="btn btn-primary me-3">
                        {{ __('messages.common.edit') }}
                    </a>
                @endif

                {{-- Back Button --}}
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-lg">
        <div class="d-flex flex-column align-items-center">

            {{-- Flash Messages --}}
            @include('flash::message')

            {{-- Quote Details Card --}}
            <div class="card shadow-sm p-4 mb-5 w-100" style="max-width: 960px;">
                @include('quotes.show_fields', ['isPublicView' => true])
            </div>
        </div>
    </div>
@endsection
