<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quotation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap");

        body {
           
            font-family: "Times New Roman", serif;
            background-color: white;
            color: black;
            font-size: 12px;
            line-height: 1.5;
            width: 794px;
            /* A4 width in pixels at 96dpi */
            height: 1123px;
            /* A4 height in pixels at 96dpi */
            padding: 2rem;
            margin: auto;
            position: relative;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
            }

            body {
                padding: 2rem;
            }

            footer {
                font-size: 9px;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        .watermark {
            position: absolute;
            top: 35%;
            left: 25%;
            opacity: 0.1;
            font-size: 3.5rem;
            transform: rotate(-30deg);
            white-space: nowrap;
            z-index: 0;
            pointer-events: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #facc15;
            /* Tailwind yellow-500 */
        }

        /* Optional: Table styling if not using Tailwind */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 0.25rem 0.5rem;
            font-size: 12px;
        }

        table thead {
            background-color: #f3f4f6;
            /* Tailwind gray-100 */
        }

        hr {
            border: 1px solid black;

        }



        .image-container {
    position: relative; /* Allows absolute positioning of children */
    display: inline-block; /* Or block, depending on layout */
}

.background-image {
    display: block; /* Removes extra space below image */
    width: 100%; /* Adjust as needed */
    height: auto; /* Maintain aspect ratio */
}

.watermark-overlay {
    position: absolute;
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%) rotate(-45deg); 
    
    
    font-weight: extrabold; 
    color: #FFA500; 
    text-transform: uppercase;
    letter-spacing: 0.1em; 
    font-size: 1.25rem; 
    

    user-select: none; 
    pointer-events: none; 
    white-space: nowrap; 
}

/* Responsive font size for larger screens (md:text-2xl) */
@media (min-width: 768px) { /* Tailwind's 'md' breakpoint */
    .watermark-overlay {
        font-size: 1.5rem; /* Equivalent to text-2xl */
    }
}

.watermark {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-30deg);
  z-index: 0;
  font-size: 2.5rem;
  color: #eab308; /* Gold-yellow tone */
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  opacity: 0.25; /* Increased from 0.12 to be clearer */
  white-space: nowrap;
  pointer-events: none;
  user-select: none;
  font-family: 'Arial Black', 'Arial', sans-serif;
  text-shadow:
    1px 1px 2px rgba(0, 0, 0, 0.05),
    0 0 1px rgba(255, 195, 0, 0.4); /* soft outer glow for clarity */
}


    </style>
</head>

<body class="bg-white text-black p-6 w-full max-w-[794px] mx-auto text-xs relative leading-relaxed">

    <div class="watermark">
  EMPLOYEE BENEFITS MANAGEMENT
</div>
    <!-- Header -->
    <header class="flex items-center space-x-6 mb-2">
        <img src="{{ asset('assets/images/infyom.png') }}" alt="EBM Logo" class="h-10 w-auto" />
        <div>
            <h1 class="text-orange-400 font-extrabold text-xl">EBM CO., LTD.</h1>
            <p class="text-base">
                <span class="text-blue-700 font-bold">Your Benefit</span>,
                <span class="text-black font-semibold">Our Achievement</span>
            </p>
        </div>
    </header>

    <hr class="border border-black mb-6" />

    <!-- Client Info -->
    <section class="mb-3">
        <h2 class="font-bold text-sm">{{ $data->first()->client_name ?? 'Client Name' }}</h2>

        <p class="text-xs">Address: {{ $data->first()->address ?? 'No address available' }}</p>
    </section>

    <!-- Quotation Title & Date -->
    <section class="mb-3">
        <h3 class="text-center font-bold underline text-sm mb-1">QUOTATION</h3>
        <p class="text-right text-xs">Date: {{ \Carbon\Carbon::parse($quote->quote_date)->format('d-M-Y') }}</p>
    </section>

    <!-- Quotation Table -->
    <table class="w-full border border-black border-collapse text-xs mb-5">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-black px-2 py-1 text-center">ITEM</th>
                <th class="border border-black px-2 py-1 text-center">DESCRIPTION</th>
                <th class="border border-black px-2 py-1 text-center">RATE</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
                <tr>
                    <td class="border border-black px-2 py-1 text-center align-top w-10">
                        {{ $index + 1 }}
                    </td>

                    <td class="border border-black px-2 py-1 align-top w-2/3">
                        {{ $item->product_name }}<br />
                        {{-- Optional: Add spacing if needed --}}
                    </td>

                    <td class="border border-black px-2 py-1 text-left align-top w-1/3">
                        <div>
                            USD {{ number_format($item->item_price, 2) }}
                        </div>
                        <span class="text-xs text-gray-700 block mt-1">
                            {{ $item->product_description }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border border-black px-2 py-2 text-center text-red-500">No items found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Terms and Conditions -->
    <section class="mb-10 text-xs">
        <h4 class="font-bold underline mb-8">TERMS AND CONDITIONS</h4>
        <ol class="list-decimal list-inside space-y-1">
            <li>Validity: This quotation will be valid 14 days from the date of this quotation.</li>
            <li>Remarks: All prices quoted herein are exclusive of the 10% Government VAT, Government fee and Tax fine.
            </li>
            <li>Payment: At the beginning of process.</li>
        </ol>
    </section>

    <!-- Signature Section -->
    <section class="flex justify-between items-end gap-4 mt-12 mb-10 text-xs relative z-10">
        <!-- Left Signature -->
        <div class="text-center w-1/2">
            <p>For and on behalf of</p>
            <p class="font-semibold">EBM Co., Ltd.</p>
            <img src="{{ asset('assets/images/signeco.JPG') }}" alt="Signature" class="mx-auto my-2" width="140"
                height="60" />
            <div class="border-b border-black w-32 mx-auto my-1"></div>
            <p><strong>Ms. Sok Cheng</strong></p>
            <p>General Manager</p>
        </div>

        <!-- Right Signature -->
        <div class="text-center w-1/2">
            <p class="mb-20">Confirmed and Accepted by</p>

            <div class="border-b border-black w-48 mx-auto mb-1"></div>

            <div class="space-y-1">
                <p class="font-semibold text-sm">Authorized Signature & Chop</p>
                <p class="text-sm">Date: ____________________</p>
            </div>
        </div>
    </section>


    <hr class="border border-black mb-5" />

    <!-- Footer -->
    <footer class="text-center text-[9px] text-gray-700 leading-tight">
        #151, Street 376, Beoung Keng Kang III, Khan Chamkamorn, Phnom Penh, Cambodia<br />
        Tel: (855) 23 311 972, (855) 23 213 919 • Website: www.ebmcambodia.com
    </footer>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        window.print();
        window.onafterprint = function () {
            // Optionally redirect or close
        };
    });
</script>
