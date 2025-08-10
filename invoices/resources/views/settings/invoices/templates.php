<script id="defaultTemplate" type="text/x-jsrender">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border-width: 3px;
        }

        th,
        td {
            border: 1px solid black;
            border-width: 1px;
            padding: 8px;
            text-align: center;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-family: 'Khmer Moul';
            font-size: 20px;
            text-align: center;
        }

        .invoice-subtitle {
            font-family: 'Arial, sans-serif';
            font-size: 16px;
            text-align: center;
        }

        .info-block {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .info-block .left,
        .info-block .right {
            line-height: 1.5;
        }

        .signature-section {
            display: flex;
            justify-content: space-evenly;
            margin-top: 80px;
            text-align: center;
        }

        .img-logo {
            max-width: 100%;
            height: auto;
        }
    </style>

    <div class="container">
        <div class="invoice-header">
            <div style="width: 30%;">
                <img src="<?php echo getLogoUrl() ?>" class="img-logo" alt="Company Logo">
            </div>
            <div style="width: 40%; line-height: 25px; text-align: center;">
                <div style="font-family: 'Khmer Moul'; font-size: 20px;"><strong>អ៊ី បី អីម ខូ អិលតី</strong></div>
                <span style="font-family: 'Khmer Moul';"><strong>EBM Co.,Ltd.</strong></span>
            </div>
            <div style="width: 30%;"></div>
        </div>

        <div style="text-align: center; font-family: 'Kh Battambang'; font-size: 13px;">
            <p>លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677</p>
            <p>អាសយដ្ឋាន: #151, Street 376, Sangkat Beoung Keng Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680</p>
        </div>

        <hr />

        <div class="invoice-title">វិក្កយបត្រអាករ</div>
        <div class="invoice-subtitle"><strong>TAX INVOICE</strong></div>

        <div class="info-block">
            <div class="left">
                <p><strong>អតិថិជន/Customer:</strong> {{:clientName}}</p>
                <p>Company name/Customer: {{:clientName}}</p>
                <p>Telephone No: {{:clientPhone}}</p>
                <p>លេខអត្តសញ្ញាណកម្ម អតប​ (VATTIN): </p>
            </div>
            <div class="right">
                <p>លេខរៀងវិក្កយបត្រ៖ #{{:invoiceId}}</p>
                <p>Invoice No</p>
                <p>កាលបរិច្ឆេទ៖ {{:invoiceDate}}</p>
                <p>Order #</p>
                <p>Approval Date</p>
            </div>
        </div>

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
                {{for invoiceItems}}
                <tr>
                    <td>{{:index + 1}}</td>
                    <td>{{:productName}}</td>
                    <td>{{:unitPrice}}</td>
                    <td>{{:quantity}}</td>
                    <td>{{:amountUSD}}</td>
                    <td>{{:amountKHR}}</td>
                </tr>
                {{/for}}
                <tr style="text-align: end;">
                    <td colspan="4">សរុប<br>Sub Total</td>
                    <td>{{:subTotalUSD}}</td>
                    <td>{{:subTotalKHR}}</td>
                </tr>
                <tr style="text-align: end;">
                    <td colspan="4">អាករលើតម្លៃបន្ថែម ១០%<br>VAT (10%)</td>
                    <td>{{:vatAmountUSD}}</td>
                    <td>{{:vatAmountKHR}}</td>
                </tr>
                <tr style="text-align: end;">
                    <td colspan="4">សរុបរួម<br>Grand Total in USD</td>
                    <td>{{:grandTotalUSD}}</td>
                    <td>{{:grandTotalKHR}}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 25px;">
            <p>អត្រាប្តូរប្រាក់ : 1 ដុល្លា/រៀល = {{:exchangeRate}}</p>
            <p>Exchange Rate : 1 USD/KHR = {{:exchangeRate}}</p>
        </div>

        <div class="signature-section">
            <div>
                <p><strong>{{:clientName}}</strong></p>
                <hr />
                <p>ហត្ថលេខា នឹងឈ្មោះអ្នកទិញ</p>
                <p>Customer's Signature & Name</p>
            </div>

            <div>
                <p><strong>{{:supplierName}}</strong></p>
                <hr />
                <p>ហត្ថលេខា នឹងឈ្មោះអ្នកលក់</p>
                <p>Supplier's Signature & Name</p>
            </div>
        </div>

        {{if paymentQrCode}}
        <div style="text-align: center; margin-top: 20px;">
            <strong><b>{{ __('messages.payment_qr_codes.payment_qr_code') }}</b></strong><br>
            <img class="mt-2" src="{{:paymentQrCode}}" height="110" width="110" alt="QR Code">
        </div>
        {{/if}}
    </div>
</script>



<script id="newYorkTemplate" type="text/x-jsrender">
    <?php
    $styleCss = 'style';
    ?>
    <div class="container">
        <div class="invoice-header d-flex justify-content-between">
            <div class="mb-8" style="vertical-align:top !important;">
            <img src="<?php echo getLogoUrl() ?>"class="img-logo">
            </div>
            <div class="invoice-header-inner">
                <div class="d-title" style="color:{{:invColor}};"><strong class="" "><?php echo __('messages.common.invoice') ?></strong></div>
                <p class="text-end">#9B5QX7</p>
            </div>
        </div>

        <div class="details-section">
            <div class="overflow-auto mb-15">
                <table class="w-100 mb-15"  style="white-space:nowrap;">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align:top !important; width:33.33% !important; border-top: 1px solid #c0c0c0; border-right: 1px solid #c0c0c0;
                                border-bottom: 1px solid #c0c0c0; padding: 15px 20px;">
                                <div class="mb-2">
                                    <strong class="font-size-15"><?php echo __('messages.invoice.invoice_date') ?>:</strong>
                                    <p class="p-text mb-0"><strong class="font-size-15"></strong>2020.09.25</p>
                                </div>
                                <div class="">
                                    <strong class="font-size-15"><?php echo __('messages.invoice.due_date') ?>: </strong>
                                    <p class="p-text mb-0"><b></b>2020.09.26</p>
                                </div>
                            </td>
                            <td style="vertical-align:top !important; width:33.33% !important; overflow:hidden; word-wrap: break-word; word-break: break-all;  padding: 15px 20px;
                                border-top: 1px solid #c0c0c0;
                                border-right: 1px solid #c0c0c0;
                                border-bottom: 1px solid #c0c0c0;">
                                <p class="p-text mb-2"><b class=""><?php echo __('messages.common.to') ?>:</b></p>
                                <p class="p-text">&lt<?php echo __('messages.invoice.client_name')  ?>&gt</p>
                                <p class="p-text">&lt<?php echo __('messages.invoice.client_email')  ?>&gt</p>
                                <p class="p-text">&lt<?php echo __('messages.client_address')  ?>&gt</p>
                            </td>
                            <td style="vertical-align:top !important; width:33.33% !important; padding: 15px 20px;
                                border-top: 1px solid #c0c0c0;
                                border-left: 1px solid #c0c0c0;
                                border-bottom: 1px solid #c0c0c0;">
                                <p class="p-text mb-2"><b class=""><?php echo __('messages.common.from') ?>:</b></p>
                                <p class="p-text mb-1"><strong><?php echo __('messages.common.address')  ?>:</strong> <span>{{:companyAddress}}</span></p>
                                <p class="p-text mb-1"><strong><?php echo __('messages.user.phone')  ?>:</strong> <span>{{:companyPhone}}</span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="overflow-auto w-100"">
                <table class="table w-100" style="border-bottom: 1px solid {{:invColor}};">
                    <thead style="border-bottom: 1px solid {{:invColor}} !important;  border-top: 1px solid {{:invColor}};">
                        <tr>
                            <th class="py-1" style="width:5%;"><strong>#</strong></th>
                            <th class="py-1"><strong><?php echo __('messages.item') ?></strong></th>
                            <th class="py-1 text-center" style="width:8%;"><strong><?php echo __('messages.invoice.qty') ?></strong></th>
                            <th class="py-1 text-center"  style="width:12%;"><strong><?php echo __('messages.product.unit_price') ?></strong></th>
                            <th class="py-1 text-center"  style="width:12%;"><strong><?php echo __('messages.invoice.tax') . '(in %)' ?></strong></th>
                            <th class="py-1 text-end" style="width:12%;"><strong><?php echo __('messages.invoice.amount') ?></strong></th>
                        </tr>
                    </thead>
                    <tbody style="border: 0px solid white !important;">
                        <tr>
                            <td><span>1</span></td>
                            <td><p class="mb-0"><?php echo __('messages.item') ?> 1</p><?php echo __('messages.Description') ?></td>
                            <td class="text-center"> 1</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="py-1 text-center">N/A</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr>
                            <td><span>2</span></td>
                            <td><p class="mb-0"><?php echo __('messages.item') ?> 2</p><?php echo __('messages.Description') ?></td>
                            <td class="text-center"> 1</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="py-1 text-center">N/A</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr>
                            <td><span>3</span></td>
                            <td><p class="mb-0"><?php echo __('messages.item') ?> 3</p><?php echo __('messages.Description') ?></td>
                            <td class="text-center"> 1</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="py-1 text-center">N/A</td>
                            <td class="text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <table class="w-100">
                <tr>
                    <td  class="w-65" style="vertical-align:bottom !important;>
                        <div class="">
                            <small style="font-size: 15px; margin-bottom: 3px"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></small><br>
                            <img style="margin-left: 8px" src="<?php echo asset('images/qrcode.png') ?>" height="110" width="110">
                        </div>
                    </td>
                    <td class="text-end" style="width:35%;">
                        <table class="total-table table w-100">
                            <tbody>
                                <tr style="border-bottom: 1px solid {{:invColor}} !important;">
                                    <td>
                                        <strong><?php echo __('messages.invoice.amount') ?>:</strong>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo getCurrencyAmount(300, true) ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid {{:invColor}} !important;">
                                    <td>
                                        <strong><?php echo __('messages.invoice.discount') ?>:</strong>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo getCurrencyAmount(50, true) ?>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid {{:invColor}} !important;">
                                    <td>
                                        <strong ><?php echo __('messages.invoice.tax') ?>:</strong>
                                    </td>
                                    <td>N/A</td>
                                </tr>

                                <tr style="border-bottom: 1px solid {{:invColor}} !important;">
                                    <td class=""><strong ><?php echo __('messages.invoice.total') ?>:</strong></td>
                                    <td class="text-nowrap">
                                        <?php echo getCurrencyAmount(250, true) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <div  style="margin-top: 40px !important;">
                <p><b><?php echo __('messages.client.notes') ?>:</b></p>
                <p class="font-color-gray">
                    Paypal , Stripe & manual payment method accept. Net 10 – Payment due in 10 days from invoice date. Net 30 – Payment due in 30 days from invoice date.
                </p>
            </div>
            <div>
                <p mb5"><b><?php echo __('messages.invoice.terms') ?>:</b></p>
                <p class="font-color-gray">Invoice payment <?php echo __('messages.invoice.total') ?> ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
            </div>
            <div class="regards">
            <p><b><?php echo __('messages.setting.regards') ?>:</b><br>
                <b style="color:{{:invColor}} !important;">{{:companyName}}</b>
            </p>
        </div>
        </div>
    </div>

</script>

<script id="torontoTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="">
                <div class="mb-8 p-5" style="background-color:#F9F9F9; ">
                    <table >
                        <tr>
                            <td class="position-relative w-50" style="vertical-align:top;">
                                <div>
                                    <img src="<?php echo getLogoUrl() ?>" class="img-logo">

                                </div>
                                <div class="position-absolute bottom-0 left-0 mb-5">
                                    <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                                </div>
                            </td>
                            <td>
                                <table>
                                    <thead class="">
                                        <tr>
                                            <th class="f-b">
                                                <p  style="color:{{:invColor}};"><strong><?php echo __('messages.common.invoice') ?></strong></p>
                                            </th>
                                            <th class="f-b"><p  style="color:{{:invColor}};">#01234</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="m-0 fw-bold fs-6"><?php echo __('messages.invoice.invoice_date') ?></p>
                                                <p>2022-01-01</p>
                                            </td>
                                            <td>
                                                <p class="m-0 fw-bold fs-6"><?php echo __('messages.invoice.due_date') ?></p>
                                                <p>2022-01-01</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:top;>
                                                <span class="m-0 fw-bold fs-6"><strong><?php echo __('messages.common.from') ?></strong></span><br>
                                                <address>
                                                    {{:companyAddress}}
                                                </address>
                                            </td>
                                            <td style="vertical-align:top;>
                                                <span class="m-0 fw-bold fs-6"><strong><?php echo __('messages.common.to') ?></strong></span><br>
                                                <span>&lt<?php echo __('messages.invoice.client_name')  ?>&gt</span><br>
                                                <span>&lt<?php echo __('messages.invoice.client_email')  ?>&gt</span><br>
                                                <address>
                                                <p>&lt<?php echo __('messages.client_address')  ?>&gt</p>
                                                </address>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="m-0 fw-bold fs-6">Phone</p>
                                                <p>{{:companyPhone}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive-sm p-5">
                    <table class="">
                        <thead style="border-bottom: 1px solid {{:invColor}};">
                            <tr>
                                <th  style="color:{{:invColor}};" class="py-1"<strong>#<strong/></th>
                                <th  style="color:{{:invColor}};" class="py-1 w-47 text-uppercase"><strong><?php echo __('messages.item') ?><strong/></th>
                                <th  style="color:{{:invColor}};" class="py-1 text-uppercase"><strong><?php echo __('messages.invoice.qty') ?></strong></th>
                                <th  style="color:{{:invColor}};" class="py-1 text-center text-uppercase text-nowrap"><strong><?php echo __('messages.product.unit_price') ?></strong></th>
                                <th  style="color:{{:invColor}};" class="py-1 text-center text-uppercase text-nowrap"><strong><?php echo __('messages.invoice.tax') . '(in %)' ?></strong></th>
                                <th  style="color:{{:invColor}};" class="py-1 text-end text-uppercase text-nowrap"><strong><?php echo __('messages.invoice.amount') ?></strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="py-1"><span>1</span></td>
                                <td class="py-1 w-47"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 1</p><?php echo __('messages.Description') ?></td>
                                <td class="py-1">1</td>
                                <td class="py-1 text-center text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                                <td class="py-1 text-center">N/A</td>
                                <td class="py-1 text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            </tr>
                            <tr>
                                <td class="py-1"><span>2</span></td>
                                <td class="py-1 w-47"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 2</p><?php echo __('messages.Description') ?></td>
                                <td class="py-1">1</td>
                                <td class="py-1 text-center text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                                <td class="py-1 text-center">N/A</td>
                                <td class="py-1 text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            </tr>
                            <tr>
                                <td class="py-1"><span>3</span></td>
                                <td class="py-1 w-47"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 3</p><?php echo __('messages.Description') ?></td>
                                <td class="py-1">1</td>
                                <td class="py-1 text-center text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                                <td class="py-1 text-center">N/A</td>
                                <td class="py-1 text-end text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="ms-auto m-5 mt-0 "  style="width:47%; border-top: 1px solid {{:invColor}};">
                    <tbody>
                        <tr>
                            <td class="py-1">
                                <strong><?php echo __('messages.invoice.amount') ?></strong>
                            </td>
                            <td class="text-end py-1 text-nowrap">
                                <?php echo getCurrencyAmount(300, true) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <strong><?php echo __('messages.invoice.discount') ?></strong>
                            </td>
                            <td class="text-end py-1 text-nowrap">
                                <?php echo getCurrencyAmount(50, true) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold py-1">
                                <strong><?php echo __('messages.invoice.tax') ?></strong>
                            </td>
                            <td class="text-end py-1">
                                N/A
                            </td>
                        </tr>
                    </tbody>
                    <tfoot style="border-top: 1px solid {{:invColor}};">
                        <tr>
                            <td class="pt-2">
                                <strong><?php echo __('messages.invoice.total') ?></strong>
                            </td>
                            <td class="text-end pt-2 text-nowrap">
                                <strong><?php echo getCurrencyAmount(250, true) ?></strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="p-5">
                    <div class="mb-8">
                        <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h4>
                        <p class="font-color-gray" style="font-size: 13px;">
                        Paypal , Stripe & manual payment method accept. Net 10 – Payment due in 10 days from invoice date. Net 30 – Payment due in 30 days from invoice date.</p>
                    </div>
                    <div class="mb-8">
                        <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h4>
                        <p class="font-color-gray"  style="font-size: 13px;">
                            Invoice payment Total ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.
                        </p>
                    </div>
                    <div class="">
                        <h5 class="d-fancy-title mb5"><b><?php echo __('messages.setting.regards') ?>:</b></h5>
                        <p class="font-color-gray" style="color:{{:invColor}} !important;">
                        <b>{{:companyName}}</b> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="rioTemplate" type="type/x-jsrender"><strong>
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <table class="mb-8"  style="width: 100%;">
                <tr>
                    <td style="vertical-align:top; width:30%;">
                        <img src="<?php echo getLogoUrl() ?>"class="img-logo">
                    </td>
                    <td style="width:30%;">
                        <p class="p-text mb-0">Invoice ID: <strong>#01234</strong></p>
                        <p class="p-text mb-0"><?php echo __('messages.invoice.invoice_date') ?>: <strong>2022-01-01 </strong></p>
                        <p class="p-text mb-0"><?php echo __('messages.invoice.due_date') ?>: <strong>2022-01-02</strong></p>
                    </td>
                    <td class="in-w-4" style="background-color: {{:invColor}};">
                        <h1 class="fancy-title tu text-center mb-auto p-3" style="color:white;  font-size: 34px"><?php echo __('messages.common.invoice') ?></h1>
                    </td>
                </tr>
            </table>
            <table style="width:75%;" class="mb-8">
                <tr>
                <td class="w-50">
                        <p class="fs-6 mb-2"><strong><?php echo __('messages.common.to') ?>:</strong></p>
                        <p class=" m-0 font-color-gray fs-6"><?php echo __('messages.common.name')  ?>: <span class="text-dark fw-bold">&lt<?php echo __('messages.invoice.client_name')  ?>&gt</span></p>
                        <p class=" m-0 font-color-gray fs-6"><?php echo __('messages.common.email')  ?>: <span class="text-dark fw-bold">&lt<?php echo __('messages.invoice.client_email')  ?>&gt</span></p>
                        <p class=" m-0  font-color-gray fs-6"><?php echo __('messages.common.address')  ?>: <span class="text-dark fw-bold">&lt<?php echo __('messages.client_address')  ?>&gt</span></p>
                    </td>
                    <td class="w-50">
                        <p class="fs-6 mb-2"><strong>From:</strong></p>
                        <p class=" m-0 font-color-gray fs-6"><?php echo __('messages.common.address')  ?>: <span class="text-dark fw-bold">{{:companyAddress}}</span></p>
                        <p class=" m-0 font-color-gray fs-6"><?php echo __('messages.user.phone')  ?>: <span class="text-dark fw-bold">{{:companyPhone}}</span></p>
                    </td>
                </tr>
            </table>
            <div class="table-responsive-sm table-striped">
                <table class="">
                    <thead style="background-color: {{:invColor}};">
                        <tr>
                            <th class="px-2 py-1 text-white text-center fw-bold"><strong>#</strong></th>
                            <th class="px-2 py-1 text-white in-w-2 fw-bold text-uppercase"><strong><?php echo __('messages.item') ?></strong></th>
                            <th class="px-2 py-1 text-white text-center fw-bold text-uppercase text-nowrap"><strong><?php echo __('messages.invoice.qty') ?></strong></th>
                            <th class="px-2 py-1 text-white text-center fw-bold text-uppercase text-nowrap"><strong><?php echo __('messages.product.unit_price') ?></strong></th>
                            <th class="px-2 py-1 text-white text-center fw-bold text-uppercase text-nowrap"><strong><?php echo __('messages.invoice.tax') . '(in %)' ?></strong></th>
                            <th class="px-2 py-1 text-white text-end fw-bold text-uppercase text-nowrap"><strong><?php echo __('messages.invoice.amount') ?></strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b-gray">
                            <td class="p-2 text-center bg-gray fw-bold">1</td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 1</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center fw-bold">1</td>
                            <td class="p-2 text-center bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center fw-bold">N/A</td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr class="border-b-gray">
                            <td class="p-2 text-center bg-gray fw-bold">2</td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 2</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center fw-bold">1</td>
                            <td class="p-2 text-center bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center fw-bold">N/A</td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr class="border-b-gray">
                            <td class="p-2 text-center bg-gray fw-bold">3</td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 3</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center fw-bold">1</td>
                            <td class="p-2 text-center bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center fw-bold">N/A</td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="p-2 text-center fw-bold text-nowrap"><?php echo __('messages.invoice.amount') ?></td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(300, true) ?></td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="p-2 text-center fw-bold text-nowrap"><?php echo __('messages.invoice.discount') ?></td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap"><?php echo getCurrencyAmount(50, true) ?></td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="p-2 text-center fw-bold text-nowrap"><?php echo __('messages.invoice.tax') ?></td>
                            <td class="p-2 text-end bg-gray fw-bold text-nowrap">N/A</td>
                        </tr>
                        <tr class="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="p-2 text-center fw-bold text-nowrap"><strong><?php echo __('messages.invoice.total') ?></strong></td>
                            <td class="p-2 text-end text-white fw-bold text-nowrap" style="background-color: {{:invColor}};"><?php echo getCurrencyAmount(250, true) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="position-relative" style="top:-50px;">
                <p class="m-0 fs-6" style="color:{{:invColor}};"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></p>
                <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
            </div>
            <div class="mb-8">
                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h4>
                <p class="font-color-gray">
                    Paypal , Stripe & manual payment method accept. Net 10 – Payment due in 10 days from invoice date. Net 30 – Payment due in 30 days from invoice date.
                </p>
            </div>

            <table>
                <tr>
                    <td class="w-75">
                        <div class="mb-8">
                            <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h4>
                            <p class="font-color-gray">
                                Invoice payment Total ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.
                            </p>
                        </div>
                    </td>
                    <td class="w-25 text-end">
                        <div class="">
                            <h4 class="d-fancy-title mb5"  style="color:{{:invColor}}"><?php echo __('messages.setting.regards') ?>:</h4>
                            <p class="font-color-gray"><b>{{:companyName}} </b></p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</script>

<script id="londonTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
    <div class="d" id="boxes">
        <div class="d-inner">
            <div class="header-section pt-10 mb-10" style="background-color: {{:invColor}};">
                <table class="">
                    <tr>
                        <td class="bg-gray-100"  >
                           <div class="px-sm-3 px-2">
                           <img src="<?php echo getLogoUrl() ?>" class="img-logo">
                           </div>
                        </td>
                        <td class=" invoice-text"  style="width:40%;">
                            <div class="text-end">
                            <h1 class="m-0 p-sm-3 p-2"><?php echo __('messages.common.invoice') ?></h1>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-white text-end px-sm-3 px-2 py-2 " style="font-size:12px;"><strong>#AB2324-01</strong></td>
                    </tr>
                </table>
            </div>
            <table class="mb-8">
                <tbody>
                    <tr style="vertical-align:top;">
                    <td width="43.33%;">
                    <p class="fs-6 mb-2"><strong><?php echo __('messages.common.from') ?></strong></p>
                        <p class=" m-0 font-color-gray fw-bold fs-6"><strong><?php echo __('messages.common.address')  ?>: </strong>{{:companyAddress}}</p>
                        <p class=" m-0 font-color-gray  fw-bold fs-6"><strong><?php echo __('messages.user.phone')  ?>: </strong> {{:companyPhone}}</p>
                    </td>
                    <td width="23.33%;">
                        <p class="fs-6 mb-2"><strong><?php echo __('messages.common.to') ?></strong></p>
                        <p class=" m-0 font-color-gray fs-6"><strong><?php echo __('messages.common.name')  ?>: </strong>&lt<?php echo __('messages.invoice.client_name')  ?>&gt</p>
                        <p class=" m-0 font-color-gray fs-6"><strong><?php echo __('messages.common.email')  ?>: </strong>&lt<?php echo __('messages.invoice.client_email')  ?>&gt</p>
                        <p class=" m-0  font-color-gray fs-6"><strong><?php echo __('messages.common.address')  ?>: </strong> &lt<?php echo __('messages.client_address')  ?>&gt</p>
                    </td>
                    <td width="33.33%;" class="text-end">
                        <p class="mb-2 font-color-gray fs-6"><strong><?php echo __('messages.invoice.invoice_date') ?>: </strong>2022-01-01</p>
                        <p class="  font-color-gray fs-6"><strong><?php echo __('messages.invoice.due_date') ?>: </strong>2022-01-02</p>
                        <img class="mt-4" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                    </td>
                    </tr>
                </tbody>
            </table>
            <div class="w-100 overflow-auto">
            <table class="border-b-gray">
                    <thead class="bg-gray-100  text-dark">
                        <tr>
                            <th class="p-2"><strong>#</strong></th>
                            <th class="p-2 in-w-2 text-uppercase"><strong><?php echo __('messages.item') ?></strong></th>
                            <th class="p-2 text-center text-uppercase"><strong><?php echo __('messages.invoice.qty') ?></strong></th>
                            <th class="p-2 text-center text-nowrap text-uppercase"><strong><?php echo __('messages.product.unit_price') ?></strong></th>
                            <th class="p-2 text-center text-nowrap text-uppercase"><strong><?php echo __('messages.invoice.tax') . '(in %)' ?></strong></th>
                            <th class="p-2 text-end text-uppercase"><strong><?php echo __('messages.invoice.amount') ?></strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2"><span>1</span></td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 1</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center">1</td>
                            <td class="p-2 text-center"> <?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center">N/A</td>
                            <td class="p-2 text-end"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr>
                        <td class="p-2"><span>2</span></td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 2</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center">1</td>
                            <td class="p-2 text-center"> <?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center">N/A</td>
                            <td class="p-2 text-end"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                        <tr>
                        <td class="p-2"><span>3</span></td>
                            <td class="p-2 in-w-2"> <p class="fw-bold mb-0"><?php echo __('messages.item') ?> 3</p><?php echo __('messages.Description') ?></td>
                            <td class="p-2 text-center">1</td>
                            <td class="p-2 text-center"><?php echo getCurrencyAmount(100, true) ?></td>
                            <td class="p-2 text-center">N/A</td>
                            <td class="p-2 text-end"><?php echo getCurrencyAmount(100, true) ?></td>
                        </tr>
                    </tbody>
            </table>
            </div>
            <table class="ms-auto mb-8" style="width:40%; ">
                <tbody>
                    <tr>
                        <td class="py-1 px-2 text-nowrap">
                            <strong><?php echo __('messages.invoice.amount') ?></strong>
                        </td>
                        <td class="text-nowrap text-end font-color-gray py-1 px-2 fw-bold">
                            <?php echo getCurrencyAmount(300, true) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-2 text-nowrap">
                            <strong><?php echo __('messages.invoice.discount') ?></strong>
                        </td>
                        <td class="text-nowrap text-end font-color-gray py-1 px-2 fw-bold">
                            <?php echo getCurrencyAmount(50, true) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold py-1 px-2 text-nowrap">
                            <strong><?php echo __('messages.invoice.tax') ?></strong>
                        </td>
                        <td class="text-end py-1 px-2 fw-bold">
                            N/A
                        </td>
                    </tr>
                </tbody>
                <tfoot class="text-white" style="background-color: {{:invColor}};">
                     <tr>
                        <td class="p-2 text-nowrap">
                            <strong> <?php echo __('messages.invoice.total') ?></strong>
                        </td>
                        <td class="text-end p-2 text-nowrap">
                            <strong> <?php echo getCurrencyAmount(250, true) ?></strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="mb-8">
                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h4>
                <p class="font-color-gray"><span class="me-1"> <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 0C0.895431 0 0 0.89543 0 2V8C0 9.10457 0.89543 10 2 10H8C9.10457 10 10 9.10457 10 8V2C10 0.895431 9.10457 0 8 0H2ZM4.72221 2.95508C4.72221 2.7825 4.58145 2.64014 4.41071 2.66555C3.33092 2.82592 2.5 3.80797 2.5 4.99549V7.01758C2.5 7.19016 2.63992 7.33008 2.8125 7.33008H4.40971C4.58229 7.33008 4.72221 7.19016 4.72221 7.01758V5.6021C4.72221 5.42952 4.58229 5.2896 4.40971 5.2896H3.61115V4.95345C3.61115 4.41687 3.95035 3.96422 4.41422 3.82285C4.57924 3.77249 4.72221 3.63715 4.72221 3.4645V2.95508ZM7.5 2.95508C7.5 2.7825 7.35924 2.64014 7.18849 2.66555C6.1087 2.82592 5.27779 3.80797 5.27779 4.99549V7.01758C5.27779 7.19016 5.41771 7.33008 5.59029 7.33008H7.1875C7.36008 7.33008 7.5 7.19016 7.5 7.01758V5.6021C7.5 5.42952 7.36008 5.2896 7.1875 5.2896H6.38885V4.95345C6.38885 4.41695 6.72813 3.96422 7.19193 3.82285C7.35703 3.77249 7.5 3.63715 7.5 3.4645V2.95508Z" fill="#8B919E"/>
                    </svg></span>Paypal , Stripe & manual payment method accept. Net 10 – Payment due in 10 days from invoice date. Net 30 – Payment due in 30 days from invoice date.
                 </p>
            </div>
            <table>
                <tr>
                    <td class="w-75">
                        <div class="mb-8">
                            <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h4>
                            <p class="font-color-gray">
                                Invoice payment Total ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.
                            </p>
                        </div>
                    </td>
                    <td class="w-25 text-end">
                        <div class="">
                            <h4 class="d-fancy-title mb5"><?php echo __('messages.setting.regards') ?>:</h4>
                            <p class="fw-bold text-purple" style="color:{{:invColor}}"><b>{{:companyName}}</b> </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</script>

<script id="istanbulTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="col-66">
                        <h1 class="i-fancy-title tu mb5" style="background:{{:invColor}};color : white;"><?php echo __('messages.common.invoice') ?></h1>
                    </div>
                    <div class="col-33">
                        <img src="<?php echo getLogoUrl() ?>"
                             class="img-logo">
                        <div class="break-25"></div>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-lg-9">
                        <strong class="tu mb5 to-font-size"><?php echo __('messages.common.to') ?></strong>
                        <p class="p-text">
                            &lt<?php echo __('messages.invoice.client_name')  ?>&gt;<br>
                            &lt<?php echo __('messages.invoice.client_email')  ?>&gt;<br>
                            &lt<?php echo __('messages.client_address')  ?>&gt;
                        </p>


                            <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb"><?php echo __('messages.invoice.invoice_id') ?>:</td>
                                <td class="text-right">#22DA93</td>
                            </tr>
                            <tr>
                                <td class="tu fwb"><?php echo __('messages.invoice.invoice_date') ?>:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb"><?php echo __('messages.invoice.due_date') ?>:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        <div class="col-lg-3 d-flex align-items-end">
                            <div class="text-center">
                                <strong  style="font-size:15px ;"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></strong><br>
                                 <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                            </div>
                        </div>
                    </div>

                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2"><?php echo __('messages.item') ?></div>
                        <div class="d-table-th in-w-3"><?php echo __('messages.invoice.qty') ?></div>
                        <div class="d-table-th in-w-4 text-right"><?php echo __('messages.invoice.amount') ?></div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr" style="border-bottom: 1px solid #ffffff;">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 1px solid #ffffff;">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.amount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.discount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.tax') ?>:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item" style="border-bottom: 2px solid {{:invColor}};">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.total') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="d-header-50">
                        <br><p><strong class="b text-black"><?php echo __('messages.common.regards') ?>:</strong></p>
                        <span>{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>





</script>

<script id="mumbaiTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner" style="border-top: 15px solid {{:invColor}}">
                <div class="row">
                    <div class="d-col-3">
                        <h1 class="fancy-title mb5"><?php echo __('messages.common.invoice') ?></h1>
                    </div>
                    <div class="d-col-1" style="padding-left: 10px !important">
                    <img  src="<?php echo getLogoUrl() ?>"
                                              class="img-logo">
                    </div>
                </div>
                <div class="break-50"></div>
                <div class="row">
                    <div class="d-col-2 mb-2">
                        <strong class="from-font-size"><?php echo __('messages.common.from') ?></strong><br>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="row">
                    <div class="col-lg-9">
                        <div class="col-66">
                            <strong style="margin-bottom: 3px" class="to-font-size mb-3"><?php echo __('messages.common.to') ?></strong><br>

                            <p class="p-text mb-2"> &lt<?php echo __('messages.invoice.client_name')  ?>&gt;<br></p>
                            <p class="p-text mb-2"> &lt<?php echo __('messages.invoice.client_email')  ?>&gt;<br></p>
                            <p class="p-text mb-2">  &lt<?php echo __('messages.client_address')  ?>&gt;</p>
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex align-items-end">
                            <div class="text-center">
                                <strong  style="font-size:15px ;"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></strong><br>
                                 <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="background:{{:invColor}}">
                <div class="row">
                    <div class="d-col-66">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.invoice_id') ?>:</td>
                                <td class="text-right">#5F2I93</td>
                            </tr>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.invoice_date') ?>:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.due_date') ?>:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>

                    </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2"><?php echo __('messages.item') ?></div>
                        <div class="d-table-th in-w-3"><?php echo __('messages.invoice.qty') ?></div>
                        <div class="d-table-th in-w-4 text-right"><?php echo __('messages.invoice.amount') ?></div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.amount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.discount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.tax') ?>:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.total') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="break-25"></div>
                    <div class="d-header-50">
                        <p style="color:{{:invColor}}"><strong class="b"><?php echo __('messages.common.regards') ?>:</strong></p>
                        <span>{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>







</script>

<script id="hongKongTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner d-no-pad">
                <div class="row hk-grey-box1">
                    <div class="col-33">
                    <img src="<?php echo getLogoUrl() ?>"
                                             class="img-logo"  style="max-width: 150px;"><br><br>
                        <p class="p-text mb-o" style="color:{{:invColor}}">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="col-33">&nbsp;</div>
                    <div class="col-33">
                        <h1 class="fancy-title mb5" style="color:{{:invColor}}"><?php echo __('messages.common.invoice') ?></h1><br><br>
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.invoice_id') ?>:</td>
                                <td class="text-right">#51ET78</td>
                            </tr>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.invoice_date') ?>:</td>
                                <td class="text-right">25 Nov 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="fwb"><?php echo __('messages.invoice.due_date') ?>:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row hk-grey-box">
                    <div class="col-lg-9">
                        <strong class="to-font-size"><?php echo __('messages.common.to') ?></strong><br>

                            <p class="p-text mb-2"> &lt<?php echo __('messages.invoice.client_name')  ?>&gt;<br></p>
                            <p class="p-text mb-2"> &lt<?php echo __('messages.invoice.client_email')  ?>&gt;<br></p>
                            <p class="p-text mb-2"> &lt<?php echo __('messages.client_address')  ?>&gt;</p>
                        </p>
                    </div>
                        <div class="col-lg-3 d-flex align-items-end">
                            <div class="text-center">
                                <strong  style="font-size:15px ;"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></strong><br>
                                 <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                            </div>
                        </div>
                </div>
                    <div class="table hk-table">
                        <div class="tu d-table-tr">
                            <div class="d-table-th in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;">#</div>
                            <div class="d-table-th in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;"><?php echo __('messages.item') ?></div>
                            <div class="d-table-th in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;"><?php echo __('messages.invoice.qty') ?></div>
                            <div class="d-table-th in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><?php echo __('messages.invoice.amount') ?></div>
                        </div>
                        <div class="<d-table-body">
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>1</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre><?php echo __('messages.item') ?> 1</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>2</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre><?php echo __('messages.item') ?> 2</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>3</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre><?php echo __('messages.item') ?> 3</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                        </div>
                        <div class="d-table-footer">
                            <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.amount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.discount') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.tax') ?>:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.total') ?>:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="hk-header-50">
                        <p class="b"><strong><?php echo __('messages.common.regards') ?>:</strong></p>
                        <span style="color:{{:invColor}}">{{:companyName}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>






</script>

<script id="tokyoTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner" style="border-top: 15px solid {{:invColor}}; border-bottom: 15px solid {{:invColor}};">
                <div class="row">
                    <div class="col-66">
                        <img  src="<?php echo getLogoUrl() ?>"
                              class="img-logo" style="max-width: 100px;">
                        <br><h6 class="p-text mb-0" style="color:{{:invColor}}">{{:companyName}}</h6>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="col-33">
                        <h1 class="fancy-title mb5" style="color:{{:invColor}}"><?php echo __('messages.common.invoice') ?></h1>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-lg-9">
                        <strong class="mb5 to-font-size" style="color:{{:invColor}}"><?php echo __('messages.common.to') ?></strong>
                        <p class="p-text ">
                            &lt<?php echo __('messages.invoice.client_name')  ?>&gt;<br>
                            &lt<?php echo __('messages.invoice.client_email')  ?>&gt;<br>
                            &lt<?php echo __('messages.client_address')  ?>&gt;
                        </p>
                            <table class="summary-table mt-3">
                                <tbody>
                                <tr>
                                    <td class="fwb mb5"><?php echo __('messages.invoice.invoice_id') ?>:</td>
                                    <td class="text-right">#24GD74</td>
                                </tr>
                                <tr>
                                    <td class="fwb mb5"><?php echo __('messages.invoice.invoice_date') ?>:</td>
                                    <td class="text-right">25 Nov 2020 8:03 AM</td>
                                </tr>
                                <tr>
                                    <td class="fwb"><?php echo __('messages.invoice.due_date') ?>:</td>
                                    <td class="text-right">26 Nov 2020</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                          <div class="col-lg-3 d-flex align-items-end">
                            <div class="text-center">
                                <strong  style="font-size:15px ;"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></strong><br>
                                 <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2"><?php echo __('messages.item') ?></div>
                        <div class="d-table-th in-w-3"><?php echo __('messages.invoice.qty') ?></div>
                        <div class="d-table-th in-w-4 text-right"><?php echo __('messages.invoice.amount') ?></div>
                    </div>
                    <div class="<d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                        <div class="d-table-summary">
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.amount') ?>:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.discount') ?>:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.tax') ?>:</strong></div>
                                <div class="d-table-value">0%</div>
                           </div>
                           <div class="d-table-summary-item" style="border-bottom: 2px solid {{:invColor}};">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.total') ?>:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                <div class="d-header-50">
                    <p class="b"><strong><?php echo __('messages.common.regards') ?>:</strong></p>
                    <span style="color: {{:invColor}}">{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>





</script>

<script id="parisTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="col-33">
                        <h1 class="p-fancy-title tu mb5" style="border-bottom: 10px solid {{:invColor}};"><?php echo __('messages.common.invoice') ?></h1>
                    </div>
                    <div class="col-33"></div>
                    <div class="col-33">
                        <img src="<?php echo getLogoUrl() ?>"
                                             class="img-logo" style="max-width: 150px;"></div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-66">
                        <strong class="tu mb5 from-font-size" style="color:{{:invColor}}"><?php echo __('messages.common.from') ?></strong>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb text-black"><?php echo __('messages.invoice.invoice_id') ?>:</td>
                                <td class="text-right">#56PC98</td>
                            </tr>
                            <tr>
                                <td class="tu fwb text-black"><?php echo __('messages.invoice.invoice_date') ?>:</td>
                                <td class="text-right">25 Nov 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb text-black"><?php echo __('messages.invoice.due_date') ?>:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="break-25"></div>
                <div class="row ">
                        <div class="col-lg-9 ">
                            <div class="mb-2"><strong class="tu to-font-size" style="color:{{:invColor}}"><?php echo __('messages.common.to') ?></strong></div>

                            <p class="p-text mb-2">&lt<?php echo __('messages.invoice.client_name')  ?>&gt;<br></p>
                            <p class="p-text mb-2">&lt<?php echo __('messages.invoice.client_email')  ?>&gt;<br></p>
                            <p class="p-text mb-2">&lt<?php echo __('messages.client_address')  ?>&gt;</p>
                        </div>
                    <div class="col-lg-3 d-flex align-items-end">
                            <div class="text-center">
                                <strong  style="font-size:15px ;"><b><?php echo __('messages.payment_qr_codes.payment_qr_code') ?></b></strong><br>
                                 <img class="mt-2" src="<?php echo asset('images/qrcode.png') ?>" height="100" width="100">
                            </div>
                        </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="color: {{:invColor}};border-top: 2px solid {{:invColor}};border-bottom: 2px solid {{:invColor}}">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2"><?php echo __('messages.item') ?></div>
                        <div class="d-table-th in-w-3"><?php echo __('messages.invoice.qty') ?></div>
                        <div class="d-table-th in-w-4 text-right"><?php echo __('messages.invoice.amount') ?></div>
                    </div>
                    <div class="<d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre><?php echo __('messages.item') ?> 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                        <div class="d-table-summary">
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.amount') ?>:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.discount') ?>:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.tax') ?>:</strong></div>
                                <div class="d-table-value">0%</div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong ><?php echo __('messages.invoice.total') ?>:</strong></div>
                                <div class="d-table-value" style="color: {{:invColor}};"><?php echo getCurrencyAmount(250, true); ?></div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.client.notes') ?>:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5"><?php echo __('messages.invoice.terms') ?>:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                <div class="d-header-50">
                        <p><strong class="b"><?php echo __('messages.common.regards') ?>:</strong></p>
                        <span style="color:{{:invColor}}">{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>

</script>
