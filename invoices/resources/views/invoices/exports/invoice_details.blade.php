<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Khmer OS Content', 'Arial', sans-serif;
            text-align: center;
        }
        .logo {
            height: 70px;
            margin-bottom: 10px;
        }
        .company-name-kh {
            font-family: 'Khmer Moul', serif;
            font-size: 24px;
            font-weight: bold;
        }
        .company-name-en {
            font-family: 'Khmer Moul', serif;
            font-size: 18px;
            font-weight: bold;
        }
        .vattin, .address {
            font-family: 'Kh Battambang', serif;
            font-size: 14px;
        }
        .invoice-title {
            font-family: 'Khmer OS Muol Light', serif;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <div>
        <img src="{{ public_path('assets/images/infyom.png') }}" class="logo" alt="EBM Logo">
    </div>

    <!-- Company Info -->
    <div class="company-name-kh">អ៊ី ប៊ី អិម ខូ អិលធីឌី</div>
    <div class="company-name-en">EBM Co.,Ltd.</div>
    <div class="vattin">លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677</div>
    <div class="address">
        អាសយដ្ឋាន៖ ផ្ទះលេខ ១៥១ ផ្លូវ ៣៧៦ សង្កាត់បឹងកេងកង៣ ខណ្ឌចំការមន រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ ០៨៥ ៥២៩ ៦៨០
    </div>
    <div class="address">
        Address: #151, Street 376, Sangkat Beoung Keng Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680
    </div>

    <!-- Invoice Title -->
    <div class="invoice-title">វិក្កយបត្រ TAX INVOICE</div>

</body>
</html>
