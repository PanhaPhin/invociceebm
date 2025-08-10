<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
   
    <style>
        /* Add your fonts & styles here, e.g. Khmer fonts if needed */
        body { font-family: 'Kh Battambang', Arial, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { text-align: center; }
    </style>
</head>
<body>
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
    }
</style>

<div id="report" style="margin-top: 25px;">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; text-align: center;">
        <div style="width: 30%;">
            <img src="/assets/logo.png" alt="Logo" style="width: 150px; height: auto;">
        </div>
        <div style="width: 40%; line-height: 25px;">
            <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>អ៊ី ប៊ី អិម ខូ អិលធីឌី</strong></div>
            <span style="font-family: 'Khmer Moul';"><strong>EBM Co.,Ltd.</strong></span>
        </div>
        <h2 style="width: 30%; font-family: 'Khmer Moul';"></h2>
    </div>

    <!-- Address -->
    <div style="text-align: center; line-height: 8px;">
        <p style="font-family: 'Kh Battambang'; font-size: 13px;">លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677</p>
        <p style="font-family: 'Kh Battambang'; font-size: 13px;">អាសយដ្ឋាន៖ ផ្ទះលេខ ១៥១ ផ្លូវ ៣៧៦ សង្កាត់បឹងកេងកង៣ ខណ្ឌចំការមន រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ ០៨៥ ៥២៩ ៦៨០</p>
        <p style="font-family: 'Kh Battambang'; font-size: 13px;">Address: #151, Street 376, Sangkat Beoung Keng Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680</p>
    </div>

    <hr />

    <div style="text-align: center; line-height: 25px;">
        <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>វិក្កយបត្រអាករ</strong></div>
        <div style="font-family: 'Arial'; font-size: 16px;"><strong>TAX INVOICE</strong></div>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center;">
       @foreach ($data as $items)
        <div class="left"
            style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">អតិថិជន/Customer: {{ $items->client_name }}</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ឈ្មោះក្រុមហ៊ុន ឬអតិថិជន: {{ $items->client_name }}</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Company name/Customer:
                Ms. Michell Hui</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ទូរស័ព្ទលេខ:{{ $items->phone_number }}</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Telephone No.{{ $items->phone_number }}</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: bold;">លេខអត្តសញ្ញាណកម្ម អតប​ #
                (VATTIN): </p>
        </div>
        <div class="right"
            style="display: flex; flex-direction: column; justify-content: flex-start; line-height: 0;">
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">លេខរៀងវិក្កយបត្រ៖ {{ $items->invoice_id }}</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Invoice No</p>
            <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">កាលបរិច្ឆេទ៖
            </p>
            <p style="font-size: 13px; font-weight: normal;">Date {{ $items->invoice_date }}</p>
            <p style="font-size: 13px; font-weight: normal;">Order #</p>
            <p style="font-size: 13px; font-weight: normal;">Approval Date</p>
        </div>
       @endforeach
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
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">បរិយាយមុខទំនិញ
                    </p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Description</p>
                </th>
                <th>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃឯកតា</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Unit Price</p>
                </th>
                <th>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">បរិមាណ</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Quantity</p>
                </th>
                <th>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃសេវាគិតជា
                        ប្រាក់ដុល្លា</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Amount (USD)</p>
                </th>
                <th>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">ថ្លៃសេវាគិតជា
                        ប្រាក់រៀល</p>
                    <p style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">Amount (KHR)</p>
                </th>
            </tr>
        </thead>



        <tbody>
            <tr>
                <td style="vertical-align: super; text-align: center;">1</td>

                <td>
                    @foreach ($data as $items)
                        <div style="font-family: 'Kh Battambang'; font-size: 13px; font-weight: normal;">
                            {{ $items->product_name ?? __('messages.common.n/a') }}
                        </div>
                    
                    @endforeach
                </td>

                <td style="text-align: center;">
                    
                </td>

                <td style="text-align: end;">
                    
                </td>

                <td style="text-align: end;">
                   
                </td>
                <td style="text-align: end;">
                    
                </td>
            </tr>

            <tr style="text-align: end;">
                <td colspan="4">
                    <div style="font-family: 'Kh Battambang'; font-size: 13px;">សរុប</div>
                    <div>Sub Total</div>
                </td>
               
            </tr>
            <tr style="text-align: end;">
                <td colspan="4">
                    <div style="font-family: 'Kh Battambang'; font-size: 13px;">អាករលើតម្លៃបន្ថែម ១០%</div>
                    <div>VAT (10%)</div>
                </td>
               
            </tr>
            <tr style="text-align: end;">
                <td colspan="4">
                    <div style="font-family: 'Kh Battambang'; font-size: 13px;">សរុបរួម</div>
                    <div>Grand Total in USD</div>
                </td>
               
            </tr>
        </tbody>
    </table>

         

    
</div>




</body>
</html>
