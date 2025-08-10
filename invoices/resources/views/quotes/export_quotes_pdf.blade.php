<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ getLogInUser()->hasRole('client') ? 'Client' : '' }} Quotes PDF</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            padding: 20px;
        }

        h4 {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .custom-font-size-pdf {
            font-size: 10px;
        }

        .table thead th {
            font-size: 11px;
            background-color: #f2f2f2;
        }

        .right-align {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .table td, .table th {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="text-center mb-4">
        <h4>{{ getLogInUser()->hasRole('client') ? 'Client' : '' }} Quotes Export Data</h4>
    </div>

    <table class="table table-bordered border-dark w-100">
        <thead>
        <tr>
            <th style="width: 10%">Quote ID</th>
            <th style="width: 10%">Client Name</th>
            <th style="width: 14%">Client Email</th>
            <th style="width: 13%">Quote Date</th>
            <th style="width: 15%">Amount</th>
            <th style="width: 18%">Due Date</th>
            <th style="width: 10%">Status</th>
            <th style="width: 10%">Address</th>
        </tr>
        </thead>
        <tbody>
        @if(count($quotes) > 0)
            @foreach($quotes as $quote)
                <tr class="custom-font-size-pdf">
                    <td>{{ $quote->quote_id }}</td>
                    <td>{{ $quote->client->user->FullName }}</td>
                    <td>{{ $quote->client->user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($quote->quote_date)->translatedFormat(currentDateFormat()) }}</td>
                    <td class="right-align">{{ getCurrencyAmount($quote->final_amount, true) }}</td>
                    <td>{{ \Carbon\Carbon::parse($quote->due_date)->translatedFormat(currentDateFormat()) }}</td>
                    <td>
                        @if($quote->status == \App\Models\Quote::DRAFT)
                            Draft
                        @elseif($quote->status == \App\Models\Quote::CONVERTED)
                            Converted
                        @else
                            Sent
                        @endif
                    </td>
                    <td>{{ $quote->client->address ?? 'N/A' }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center text-danger">{{ __('messages.no_records_found') }}</td>
            </tr>
        @endif
        </tbody>
    </table>
</body>
</html>
