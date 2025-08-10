<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="icon" href="{{ asset('web/media/logos/favicon.ico') }}" type="image/png">
    <title>{{ __('messages.invoice.invoice_pdf') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/invoice-pdf.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border-width: 3px;
        }

        th,
        td {
            border: 1px solid black;
            border-width: 3px;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body style="padding: 30px 15px !important;">
    <div id="report" style="display: block; margin-top: 25px;">
        <!-- header -->
        <div style="display: flex; justify-content: space-between; align-items: center; text-align: center;">
            <div style="width: 30%;">
                <img src="{{ getLogoUrl($invoice->tenant_id) }}" alt="Logo" style="width: 150px; height: auto;">
            </div>
            <div style="width: 40%; line-height: 25px;">
                <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>អ៊ី ប៊ី អិម ខូ អិលធីឌី</strong></div>
                <span style="font-family: 'Khmer Moul';"><strong>EBM Co.,Ltd.</strong></span>
            </div>
            <h2 style="width: 30%; font-family: 'Khmer Moul';"></h2>
        </div>

        <!-- address -->
        <div style="text-align: center; line-height: 8px;">
            <p style="font-family: 'Kh Battambang'; font-size: 13px;">លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px;">អាសយដ្ឋាន៖ ផ្ទះលេខ ១៥១ ផ្លូវ ៣៧៦ សង្កាត់បឹងកេងកង៣
                ខណ្ឌចំការមន រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ ០៨៥ ៥២៩ ៦៨០</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px;">Address: #151, Street 376, Sangkat Beoung Keng
                Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680</p>
        </div>

        <hr />

        <div style="text-align: center; line-height: 25px;">
            <div style="font-family: 'Khmer Moul'; font-size: 20px; text-align: center;"><strong>វិក្កយបត្រអាករ</strong>
            </div>
            <div style="font-family: 'Arial, sans-serif'; font-size: 16px; text-align: center;"><strong>TAX
                    INVOICE</strong></div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div class="left" style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">អតិថិជន/Customer: {{ $client->user->full_name }}</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Company name/Customer: {{ $client->user->full_name }}</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Telephone No: {{ $client->user->phone }}</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">លេខអត្តសញ្ញាណកម្ម អតប​ #
                    (VATTIN): </p>
            </div>
            <div class="right" style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">លេខរៀងវិក្កយបត្រ៖ #{{ $invoice->invoice_id }}</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Invoice No</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">កាលបរិច្ឆេទ៖ {{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat(currentDateFormat()) }}</p>
                <p style="font-size: 13px; font-weight: normal;">Order #</p>
                <p style="font-size: 13px; font-weight: normal;">Approval Date</p>
            </div>
        </div>

        <!-- table -->
        <table>
            <thead>
                <tr>
                    <th>ល.រ<br>No</th>
                    <th>បរិយាយមុខទំនិញ<br>Description</th>
                    <th>ថ្លៃឯកតា<br>Unit Price</th>
                    <th>បរិមាណ<br>Quantity</th>
                    <th>ថ្លៃសេវាគិតជា ប្រាក់ដុល្លា<br>Amount (USD)</th>
                    <th>ថ្លៃសេវាគិតជា ប្រាក់រៀល<br>Amount (KHR)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $SUB_TOTAL_USD = 0;
                    $SUB_TOTAL_KHR = 0;
                @endphp
                @foreach ($invoice->invoiceItems as $key => $invoiceItems)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ isset($invoiceItems->product->name) ? $invoiceItems->product->name : $invoiceItems->product_name ?? __('messages.common.n/a') }}</td>
                        <td>{{ number_format($invoiceItems->price, 2) }}</td>
                        <td>{{ number_format($invoiceItems->quantity, 2) }}</td>
                        <td>
                            @php
                                $amountUSD = $invoiceItems->price * $invoiceItems->quantity;
                                $SUB_TOTAL_USD += $amountUSD;
                            @endphp
                            {{ number_format($amountUSD, 2) }}
                        </td>
                        <td>
                            @php
                                $amountKHR = $amountUSD * $KHR; /* Assuming $KHR is defined */
                                $SUB_TOTAL_KHR += $amountKHR;
                            @endphp
                            {{ number_format($amountKHR, 0) }}
                        </td>
                    </tr>
                @endforeach
                <tr style="text-align: end;">
                    <td colspan="4">សរុប<br>Sub Total</td>
                    <td>{{ number_format($SUB_TOTAL_USD, 2) }}</td>
                    <td>{{ number_format($SUB_TOTAL_KHR, 0) }}</td>
                </tr>
                <tr style="text-align: end;">
                    <td colspan="4">អាករលើតម្លៃបន្ថែម ១០%<br>VAT (10%)</td>
                    <td>{{ number_format(($SUB_TOTAL_USD * $VAT) / 100, 2) }}</td>
                    <td>{{ number_format(($SUB_TOTAL_KHR * $VAT) / 100, 0) }}</td>
                </tr>
                <tr style="text-align: end;">
                    <td colspan="4">សរុបរួម<br>Grand Total in USD</td>
                    <td>{{ number_format($SUB_TOTAL_USD + ($SUB_TOTAL_USD * $VAT) / 100, 2) }}</td>
                    <td>{{ number_format($SUB_TOTAL_KHR + ($SUB_TOTAL_KHR * $VAT) / 100, 0) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Currency Rate -->
        <div style="line-height: 8px; margin-top: 25px; text-align: left;">
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                អត្រាប្តូរប្រាក់ : <span style="font-family: 'Arial, sans-serif'; font-size: 15px;">1</span> ដុល្លា/រៀល = 
                <span style="font-family: 'Arial, sans-serif'; font-size: 15px;">
                    <?= number_format($KHR, 0) ?>
                </span>
            </p>
            <p style="font-size: 14px; font-weight: normal;">
                Exchange Rate : 1 USD/KHR = <?= number_format($KHR, 0) ?>
            </p>
        </div>

        <!-- footer and signature -->
        <div style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 100px;">
            <div style="display: block; text-align: start; line-height: 8px;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold; font-style: italic;">
                    {{ $client->user->full_name }}
                </p>
                <hr />
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                    ហត្ថលេខា នឹងឈ្មោះអ្នកទិញ
                </p>
                <p style="font-size: 14px; font-weight: normal;">Customer's Signature & Name</p>
            </div>

            <div style="display: block; text-align: center; line-height: 8px;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold; font-style: italic;">
                    {{ $user }}
                </p>
                <hr />
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                    ហត្ថលេខា នឹងឈ្មោះអ្នកលក់
                </p>
                <p style="font-size: 14px; font-weight: normal;">Supplier's Signature & Name</p>
            </div>
        </div>

        <!-- QR Code -->
        <div style="text-align: center; margin-top: 20px;">
            @if (!empty($invoice->paymentQrCode))
                <div>
                    <strong><b>{{ __('messages.payment_qr_codes.payment_qr_code') }}</b></strong><br>
                    <img class="mt-2" src="{{ $invoice->paymentQrCode->qr_image }}" height="110" width="110" alt="QR Code">
                </div>
            @endif
        </div>
    </div>
</body>

</html>

