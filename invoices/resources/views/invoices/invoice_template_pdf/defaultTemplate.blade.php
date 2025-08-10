<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />

    <style>
        /* Add your fonts & styles here, e.g. Khmer fonts if needed */
        body {
            font-family: 'Kh Battambang', Arial, sans-serif;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            text-align: center;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            border-bottom: 2px solid #000;
        }

        .logo-box img {
            height: 50px;
            width: auto;
            display: block;
        }

        .company-info {
            text-align: right;
            line-height: 1.6;
        }

        .company-info strong {
            font-size: 16px;
            display: block;
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            margin: 20px 0 10px;
            font-size: 18px;
        }

        .receipt-info {
            display: flex;
            flex-wrap: wrap;
            border: 1px solid #000;
            margin-top: 10px;
        }

        .column {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border-bottom: 1px solid #000;
        }

        .column:last-child {
            border-bottom: none;
        }

        .info-pair {
            display: flex;
            margin-bottom: 6px;
        }

        .info-pair .label {
            width: 100px;
            font-weight: bold;
        }

        .info-pair .separator {
            width: 10px;
        }

        .info-pair .value {
            flex: 1;
        }

        @media (min-width: 601px) {
            .column {
                width: 50%;
                border-right: 1px solid #000;
                border-bottom: none;
            }

            .column:last-child {
                border-right: none;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #f9cfa6;
            text-align: center;
        }

        .desc-cell {
            height: 100px;
        }

        .price {
            text-align: right;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: -1px;
        }

        .summary td {
            border: 1px solid #000;
            padding: 6px;
            background-color: #f9cfa6;
        }

        .summary td.left {
            width: 60%;
            font-style: italic;
            vertical-align: bottom;
            border-right: none;
        }

        .summary td.label {
            font-weight: bold;
            text-align: right;
            width: 20%;
        }

        .summary td.value {
            width: 20%;
            text-align: right;
        }

        .summary tr:nth-child(2) td.value {
            border-bottom: 1px solid #000;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            /* This will push items to the ends */
            gap: 200px;
            /* INCREASE THIS VALUE for 'far' space - adjust as needed */
            margin-top: 50px;
            page-break-inside: avoid;
        }

        .footer-section {
            /*
     * We'll remove the fixed width for .footer-section and let flexbox handle sizing
     * in conjunction with 'gap'. If you need specific widths for the content within,
     * you might need to apply them to inner elements or use flex-basis.
     */
            /* width: 60%; */
            /* Remove this or set it to auto/flex-basis */
            flex-grow: 1;
            /* Allows the sections to grow and take available space */
            flex-shrink: 1;
            /* Allows them to shrink if needed */
            flex-basis: 0;
            /* A good default for flex-grow to work properly */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-text-top {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .signature-box {
            width: 100%;
            /* Keep signature box filling its section */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .signature-line {
            width: 100%;
            border-top: 1px solid #000;
            margin-bottom: 8px;
        }

        .signature-label {
            font-size: 14px;
            font-weight: normal;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .footer-right-text {
            text-align: center;
        }

        @media print {

            th,
            .summary td,
            .logo-box {
                background-color: #f9cfa6 !important;
                color: #000 !important;
            }
        }

        .page {
            width: 210mm;
            /* A4 width */
            height: 297mm;
            /* A4 height */
            padding: 20mm;
            margin: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .page {
                box-shadow: none;
                page-break-after: always;
            }
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-width: 3px;
        }

        th,
        td {
            border: 1px solid black;
            border-width: 3px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div id="report" style="margin-top: 25px;">
            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; text-align: center;">
                <div style="width: 30%;">
                    <img src="/assets/images/infyom.png" alt="Logo" style="width: 150px; height: auto;">

                </div>
                <div style="width: 40%; line-height: 25px;">
                    <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>អ៊ី ប៊ី អិម ខូ អិលធីឌី</strong>
                    </div>
                    <span style="font-family: 'Khmer Moul';"><strong>EBM Co.,Ltd.</strong></span>
                </div>
                <h2 style="width: 30%; font-family: 'Khmer Moul';"></h2>
            </div>
            <?php
            //dd($data);
            ?>
            <!-- Address -->
            <div style="text-align: center; line-height: 8px;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px;">លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677
                </p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px;">អាសយដ្ឋាន៖ ផ្ទះលេខ ១៥១ ផ្លូវ ៣៧៦
                    សង្កាត់បឹងកេងកង៣ ខណ្ឌចំការមន រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ ០៨៥ ៥២៩ ៦៨០</p>
                <p style="font-family: 'Kh Battambang'; font-size: 13px;">Address: #151, Street 376, Sangkat Beoung Keng
                    Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680</p>
            </div>


            @php
                $invoice = $data[0]; // Get the first item since all items are for the same invoice
            @endphp

            @php
                use Carbon\Carbon;

                if (!function_exists('convertToKhmerNumber')) {
                    function convertToKhmerNumber($number)
                    {
                        $khmerNumbers = [
                            '0' => '០',
                            '1' => '១',
                            '2' => '២',
                            '3' => '៣',
                            '4' => '៤',
                            '5' => '៥',
                            '6' => '៦',
                            '7' => '៧',
                            '8' => '៨',
                            '9' => '៩',
                        ];

                        return strtr($number, $khmerNumbers);
                    }
                }

                $date = Carbon::parse($invoice->invoice_date)->format('d-m-Y');

                $khmerMonths = [
                    '01' => 'មករា',
                    '02' => 'កុម្ភៈ',
                    '03' => 'មិនា',
                    '04' => 'មេសា',
                    '05' => 'ឧសភា',
                    '06' => 'មិថុនា',
                    '07' => 'កក្កដា',
                    '08' => 'សីហា',
                    '09' => 'កញ្ញា',
                    '10' => 'តុលា',
                    '11' => 'វិច្ឆិកា',
                    '12' => 'ធ្នូ',
                ];

                [$day, $month, $year] = explode('-', $date);

                $khmerDate =
                    convertToKhmerNumber($day) . ' ' . $khmerMonths[$month] . ' ' . convertToKhmerNumber($year);
            @endphp



            <div style="text-align: center; line-height: 25px;">
                <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>វិក្កយបត្រអាករ</strong></div>
                <div style="font-family: 'Arial'; font-size: 16px;"><strong>TAX INVOICE</strong></div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div class="left"
                    style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">អតិថិជន/Customer:
                        {{ $invoice->client_name }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ឈ្មោះក្រុមហ៊ុន
                        ឬអតិថិជន: {{ $invoice->client_name }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Company
                        name/Customer: {{ $invoice->client_name }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ទូរស័ព្ទលេខ:
                        {{ $invoice->phone_number }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Telephone No.:
                        {{ $invoice->phone_number }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">លេខអត្តសញ្ញាណកម្ម អតប​
                        # (VATTIN): {{ $invoice->vat_tin }}</p>
                </div>

                <div class="right"
                    style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">លេខរៀងវិក្កយបត្រ៖
                        {{ $invoice->invoice_id }}</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Invoice No</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">កាលបរិច្ឆេទ៖
                        {{ $khmerDate }}</p>
                    <p style="font-size: 13px; font-weight: normal;">Date: {{ $invoice->invoice_date }}</p>
                    <p style="font-size: 13px; font-weight: normal;">Order #</p>
                    <p style="font-size: 13px; font-weight: normal;">Approval Date</p>
                </div>
            </div>


            <!-- table -->
            <table>
                <thead>
                    <tr>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ល.រ</p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">No</p>
                        </th>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                                បរិយាយមុខទំនិញ
                            </p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Description
                            </p>
                        </th>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃឯកតា</p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Unit Price
                            </p>
                        </th>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">បរិមាណ</p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Quantity</p>
                        </th>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃសេវាគិតជា
                                ប្រាក់ដុល្លា</p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Amount (USD)
                            </p>
                        </th>
                        <th>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃសេវាគិតជា
                                ប្រាក់រៀល</p>
                            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Amount (KHR)
                            </p>
                        </th>
                    </tr>
                </thead>


                @php
                    // $exchangeRate = $invoice->exchange_rate ??  4500; // Assuming exchange_rate is available in the invoice data
                    $exchangeRate = $invoice->exchange_rate; // Assuming exchange_rate is available in the invoice data
                    $items = $data;
                    $totalSubUSD = 0;
                @endphp

                @foreach ($items as $item)
                    @php

                        $unitPrice = (float) $item->unit_price;
                        $quantity = (int) $item->quantity;
                        $amountUSD = $unitPrice * $quantity;
                        $amountKHR = round($amountUSD * $exchangeRate);
                        $totalSubUSD += $amountUSD;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $item->product_name }}</td>
                        <td class="text-end">${{ number_format($unitPrice, 2) }}</td>
                        <td class="text-end">{{ $quantity }}</td>
                        <td class="text-end">${{ number_format($amountUSD, 2) }}</td>
                        <td class="text-end">៛{{ number_format($amountKHR, 0) }}</td>
                    </tr>
                @endforeach

                @php
                    $vatUSD = $totalSubUSD * 0.1;
                    $grandTotalUSD = $totalSubUSD + $vatUSD;

                    $totalSubKHR = round($totalSubUSD * $exchangeRate);
                    $vatKHR = round($vatUSD * $exchangeRate);
                    $grandTotalKHR = round($grandTotalUSD * $exchangeRate);
                @endphp

                {{-- Sub Total --}}
                <tr>
                    <td colspan="4" class="text-start">
                        <div style="font-family: 'Kh Battambang'; font-size: 13px;">សរុប</div>
                        <div>Sub Total</div>
                    </td>
                    <td class="text-end">${{ number_format($totalSubUSD, 2) }}</td>
                    <td class="text-end">៛{{ number_format($totalSubKHR, 0) }}</td>
                </tr>

                {{-- VAT --}}
                <tr>
                    <td colspan="4" class="text-start">
                        <div style="font-family: 'Kh Battambang'; font-size: 13px;">អាករលើតម្លៃបន្ថែម ១០%</div>
                        <div>VAT (10%)</div>
                    </td>
                    <td class="text-end">${{ number_format($vatUSD, 2) }}</td>
                    <td class="text-end">៛{{ number_format($vatKHR, 0) }}</td>
                </tr>

                {{-- Grand Total --}}
                <tr>
                    <td colspan="4" class="text-start">
                        <div style="font-family: 'Kh Battambang'; font-size: 13px;">សរុបរួម</div>
                        <div>Grand Total</div>
                    </td>
                    <td class="text-end"><strong>${{ number_format($grandTotalUSD, 2) }}</strong></td>
                    <td class="text-end"><strong>៛{{ number_format($grandTotalKHR, 0) }}</strong></td>
                </tr>
                </tbody>
            </table>

            {{-- Exchange Rate Note --}}
            <div style="line-height: 1.2; margin-top: 25px;">
                <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                    អត្រាប្តូរប្រាក់៖
                    <span style="font-family: Arial, sans-serif; font-size: 15px;">
                        1 USD = ៛{{ number_format($exchangeRate, 0) }}
                    </span>
                </p>
                <p style="font-size: 14px; font-weight: normal;">
                    Exchange Rate: 1 USD = KHR {{ number_format($exchangeRate, 0) }}
                </p>
            </div>

            <!-- Add more QR codes here -->
            {{-- <div style="display: flex; gap: 30px; margin-top: 30px; justify-content: center; page-break-inside: avoid;">
                <div>
                    <img src="{{ asset('QR/QR1.png') }}" alt="Payment QR Code 1" height="110" width="110"
                        style="border: 1px solid #ccc;">
                    <p style="text-align: center; font-size: 12px; margin-top: 6px;">ABA</p>
                </div>
                <div>
                    <img src="{{ asset('QR/QR1.png') }}" alt="Payment QR Code 2" height="110" width="110"
                        style="border: 1px solid #ccc;">
                    <p style="text-align: center; font-size: 12px; margin-top: 6px;">Acleda</p>
                </div>
            </div> --}}




            <!-- footer and signature -->
            <div
                style="display: flex; justify-content: space-evenly; align-items: center; margin-top: 200px; page-break-inside: avoid;">
                <div style="text-align: start; line-height: 1.2; width: 40%;">
                    <hr />
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                        ហត្ថលេខា នឹងឈ្មោះអ្នកទិញ
                    </p>
                    <p style="font-size: 14px; font-weight: normal;">
                        Customer's Signature & Name
                    </p>
                </div>

                <div style="text-align: center; line-height: 1.2; width: 40%;">
                    <hr />
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                        ហត្ថលេខា នឹងឈ្មោះអ្នកលក់
                    </p>
                    <p style="font-size: 14px; font-weight: normal;">
                        Supplier's Signature & Name
                    </p>
                </div>
            </div>

        </div>
    </div>
    </head>

</body>

<body>

    <div class="page">
        <header class="header-container">
            <div style="width: 30%;">
                <img src="/assets/images/infyom.png" alt="Logo" style="width: 150px; height: auto;">

            </div>
            <div class="company-info">
                <strong>EBM Co.,Ltd.</strong><br>
                #151, Street 376, Boeung Keng Kang II,<br>
                Chamkarmon, Phnom Penh.<br>
                Tel: (855)23 213 919 &nbsp;&nbsp; Fax: (855)23 213 929
            </div>
        </header>

        <main>
            <h1>Official Receipt</h1>

            <section class="receipt-info">
                <div class="column">
                    <div class="info-pair">
                        <div class="label">Bill To</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->client_name ?? '' }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Address</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->client_address ?? '' }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Attn</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->attn ?? '' }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Tel/Fax</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->phone_number ?? '' }}</div>
                    </div>
                </div>
                <div class="column">
                    <div class="info-pair">
                        <div class="label">Receipt #</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->invoice_id }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Receipt Date</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->invoice_date }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Invoice #</div>
                        <div class="separator">:</div>
                        <div class="value">{{ $invoice->invoice_id }}</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Contact</div>
                        <div class="separator">:</div>
                        <div class="value">Ms. Sok Cheng</div>
                    </div>
                    <div class="info-pair">
                        <div class="label">Tel #</div>
                        <div class="separator">:</div>
                        <div class="value">012 922 556</div>
                    </div>
                </div>
            </section>

            <table border="1" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width: 5%;" scope="col">Item</th>
                        <th style="width: 45%;" scope="col">Description</th>
                        <th style="width: 10%;" scope="col">Qty</th>
                        <th style="width: 15%;" scope="col">Unit Price (USD)</th>
                        <th style="width: 25%;" scope="col">Total Price (US$)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $items)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="desc-cell">{{ $items->product_description }}</td>
                            <td>{{ $items->quantity }}</td>
                            <td class="price">${{ number_format($items->unit_price, 2) }}</td>
                            <td class="total-price-cell">
                                <span class="currency-symbol">$</span>
                                <span
                                    class="value-placeholder">{{ number_format($items->unit_price * $items->quantity, 2) }}</span>
                            </td>
                        </tr>
                    @empty
                        {{-- This content will be displayed if $data is empty --}}
                        <tr>
                            <td>&nbsp;</td>
                            <td class="desc-cell">No items to display.</td> {{-- Or keep it blank/stylized as the original static row --}}
                            <td>&nbsp;</td>
                            <td class="price">$</td>
                            <td class="total-price-cell">
                                <span class="currency-symbol">$</span>
                                <span class="value-placeholder">-</span>
                            </td>
                        </tr>
                        {{-- You can add more placeholder rows here if needed for the empty state --}}
                    @endforelse
                </tbody>
            </table>


            @php
                $total_sub = $totalSubUSD ?? 0; // Total in USD
                $vat = $total_sub * 0.1; // VAT 10%
                $total_final = $total_sub + $vat; // Grand total in USD
                $total_sub_khr = round($total_sub * $exchangeRate); // Total in

                use NumberToWords\NumberToWords;

                $numberToWords = new NumberToWords();
                $numberTransformer = $numberToWords->getNumberTransformer('en');
                $amountInWords = ucfirst($numberTransformer->toWords(floor($total_final))) . ' dollars';

                $cents = round(($total_final - floor($total_final)) * 100);
                if ($cents > 0) {
                    $amountInWords .= " and $cents cents";
                }

            @endphp







            <table class="summary">
                <tr>
                    <td class="left" rowspan="3">
                        <div style="font-family: 'Kh Battambang'; font-size: 13px;">
                            Amount in word: <strong>{{ $amountInWords }}</strong>
                        </div>
                    </td>
                    <td class="label">Sub Total in USD :</td>
                    <td class="value">${{ number_format($total_sub, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">VAT 10% :</td>
                    <td class="value">${{ number_format($vat, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Grand Total Amount in USD :</td>
                    <td class="value"><strong>${{ number_format($total_final, 2) }}</strong></td>
                </tr>
            </table>
        </main>

        <footer class="footer">
            <div class="footer-section">
                <div class="footer-text-top">
                    For and on behalf of<br>
                    EBM Co., Ltd.
                </div>
                <div style="margin-top: 90px;">
                    <div style="width: 150%;">
                        <hr>
                        <p>
                            Authorized Signature & Chop
                        </p>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <div class="footer-text-top">Paid By</div>
                <div style="margin-top: 90px;">
                    <div style="width: 150%;">
                        <hr>
                        <p>
                            Authorized Signature
                        </p>
                    </div>
                </div>
            </div>
        </footer>
</body>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        window.print();
        window.onafterprint = function() {
            window.close();
        };

    });
</script>




</body>

</html>
