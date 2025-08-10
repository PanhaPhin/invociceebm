<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExcelInvoiceController extends Controller
{
    public function exportInvoiceExcel($invoiceId)
    {
        $invoice = DB::table('invoices')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select(
                'invoices.invoice_id',
                'invoices.invoice_date',
                'clients.address as client_address',
                'users.first_name as client_name',
                'users.last_name as client_company',
                'users.contact as client_phone'
            )
            ->where('invoices.invoice_id', $invoiceId)
            ->first();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('EBM Logo');
        $drawing->setPath(public_path('assets/images/infyom.png'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($sheet);

        $sheet->setCellValue('A2', 'អ៊ី ប៊ី អិម ខូ អិលធីឌី');
        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A2')->getFont()->setName('Khmer Moul')->setSize(20)->setBold(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A3', 'EBM Co.,Ltd.');
        $sheet->mergeCells('A3:F3');
        $sheet->getStyle('A3')->getFont()->setName('Khmer Moul')->setSize(14)->setBold(true);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A4', 'លេខអត្តសញ្ញាណកម្ម អតប​(VATTIN) K002-1--149677');
        $sheet->mergeCells('A4:F4');
        $sheet->getStyle('A4')->getFont()->setName('Kh Battambang')->setSize(13);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A5', 'អាសយដ្ឋាន៖ ផ្ទះលេខ ១៥១ ផ្លូវ ៣៧៦ សង្កាត់បឹងកេងកង៣ ខណ្ឌចំការមន រាជធានីភ្នំពេញ ទូរស័ព្ទលេខ ០៨៥ ៥២៩ ៦៨០');
        $sheet->mergeCells('A5:F5');
        $sheet->getStyle('A5')->getFont()->setName('Kh Battambang')->setSize(13);
        $sheet->getStyle('A5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);

        $sheet->setCellValue('A6', 'Address: #151, Street 376, Sangkat Beoung Keng Kang 3, Khan Chamkarmorn, Phnom Penh, Cambodia. Tel: 085 529 680');
        $sheet->mergeCells('A6:F6');
        $sheet->getStyle('A6')->getFont()->setName('Kh Battambang')->setSize(13);
        $sheet->getStyle('A6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);

        $sheet->setCellValue('A7', 'វិក្កយបត្រ TAX INVOICE');
        $sheet->mergeCells('A7:F7');
        $sheet->getStyle('A7')->getFont()->setName('Khmer OS Muol Light')->setSize(16)->setBold(true);
        $sheet->getStyle('A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A8', "អតិថិជន/Customer Name: {$invoice->client_name}");
        $sheet->mergeCells('A8:F8');
        $sheet->setCellValue('A9', 'ឈ្មោះក្រុមហ៊ុន ប្ញ អតិថិជន: ' . ($invoice->client_name ?? ''));
        $sheet->mergeCells('A9:F9');
        $sheet->setCellValue('A10', 'Company name/ Customer Name: ' . ($invoice->client_name ?? ''));
        $sheet->mergeCells('A10:F10');
        $sheet->setCellValue('A11', $invoice->client_address);
        $sheet->mergeCells('A11:F11');
        $sheet->setCellValue('A12', 'Address: ' . $invoice->client_address);
        $sheet->mergeCells('A12:F12');
        $sheet->getStyle('A11:A12')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('A13', 'លេខទូរស័ព្ទ/Phone: ' . $invoice->client_phone);
        $sheet->mergeCells('A13:F13');

        $sheet->setCellValue('G8', 'លេខអត្តសញ្ញាណកម្ម អតប/VATTIN: K002-1--149677');
        $sheet->setCellValue('G9', 'លេខវិក្កយបត្រ/Invoice No: ' . $invoice->invoice_id);
        $sheet->setCellValue('G10', 'កាលបរិច្ឆេទ/Date: ' . $invoice->invoice_date);

        $exchangeRate = 4006;
        $data = DB::table('invoices')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id')
            ->select(
                'products.name as product_name',
                'products.unit_price',
                'invoice_items.quantity'
            )
            ->where('invoices.invoice_id', $invoiceId)
            ->get();

        $headerRow = 14;
        $sheet->setCellValue("A$headerRow", 'No.');
        $sheet->setCellValue("B$headerRow", 'Description');
        $sheet->setCellValue("C$headerRow", 'Unit Price');
        $sheet->setCellValue("D$headerRow", 'Qty');
        $sheet->setCellValue("E$headerRow", 'Amount (USD)');
        $sheet->setCellValue("F$headerRow", 'Amount (KHR)');

        $sheet->getStyle("A$headerRow:F$headerRow")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD9E1F2']
            ]
        ]);

        $row = $headerRow + 1;
        $index = 1;
        $totalSub = 0;

        foreach ($data as $item) {
            $unitPrice = (float) $item->unit_price;
            $quantity = (int) $item->quantity;
            $amountUsd = $unitPrice * $quantity;
            $amountKhr = $amountUsd * $exchangeRate;

            $sheet->setCellValue("A$row", $index);
            $sheet->setCellValue("B$row", $item->product_name);
            $sheet->setCellValue("C$row", number_format($unitPrice, 2));
            $sheet->setCellValue("D$row", $quantity);
            $sheet->setCellValue("E$row", number_format($amountUsd, 2));
            $sheet->setCellValue("F$row", number_format(round($amountKhr), 0));

            $sheet->getStyle("A$row:D$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("C$row:F$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getRowDimension($row)->setRowHeight(22);

            $totalSub += $amountUsd;
            $row++;
            $index++;
        }

        $vat = $totalSub * 0.10;
        $grandTotal = $totalSub + $vat;

        $sheet->setCellValue("A$row", "សរុប / Sub Total");
        $sheet->mergeCells("A$row:D$row");
        $sheet->setCellValue("E$row", number_format($totalSub, 2));
        $sheet->setCellValue("F$row", number_format(round($totalSub * $exchangeRate)));
        $sheet->getStyle("A$row:F$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row++;

        $sheet->setCellValue("A$row", "អាករលើតម្លៃបន្ថែម ១០% / VAT (10%)");
        $sheet->mergeCells("A$row:D$row");
        $sheet->setCellValue("E$row", number_format($vat, 2));
        $sheet->setCellValue("F$row", number_format(round($vat * $exchangeRate)));
        $sheet->getStyle("A$row:F$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row++;

        $sheet->setCellValue("A$row", "សរុបរួម / Grand Total");
        $sheet->mergeCells("A$row:D$row");
        $sheet->setCellValue("E$row", number_format($grandTotal, 2));
        $sheet->setCellValue("F$row", number_format(round($grandTotal * $exchangeRate)));
        $sheet->getStyle("E$row:F$row")->getFont()->setBold(true);
        $sheet->getStyle("A$row:F$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A$row:F$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $row += 2;

        $sheet->setCellValue("A$row", 'អត្រាប្តូរប្រាក់ / Exchange Rate: 1 USD = ' . number_format($exchangeRate) . ' KHR');
        $sheet->mergeCells("A$row:F$row");
        $sheet->getStyle("A$row")->getFont()->setSize(12);

        $sigRow = $row + 5;
        $sheet->setCellValue("B$sigRow", "ហត្ថលេខា និងឈ្មោះអ្នកទិញ\nCustomer Signature & Name");
        $sheet->mergeCells("B$sigRow:D$sigRow");
        $sheet->setCellValue("E$sigRow", "ហត្ថលេខា និងឈ្មោះអ្នកលក់\nSupplier's Signature & Name");
        $sheet->mergeCells("E$sigRow:F$sigRow");

        $signatureStyle = [
            'font' => ['bold' => true, 'name' => 'Kh Battambang', 'size' => 13],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle("B$sigRow:D$sigRow")->applyFromArray($signatureStyle);
        $sheet->getStyle("E$sigRow:F$sigRow")->applyFromArray($signatureStyle);

        $stampPath = public_path('assets/images/signeco_cleanup-removebg-preview.png');
        if (file_exists($stampPath)) {
            $stamp = new Drawing();
            $stamp->setName('Supplier Stamp');
            $stamp->setDescription('Supplier Stamp');
            $stamp->setPath($stampPath);
            $stamp->setHeight(80);
            $stamp->setCoordinates("E" . ($sigRow + 1));
            $stamp->setOffsetX(15);
            $stamp->setOffsetY(5);
            $stamp->setWorksheet($sheet);
        }

        // Manual column widths (better than autosize for layout control)
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(14);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(30);

        $sheet->getSheetView()->setZoomScale(110);
        $sheet->freezePane("A15");

        if (ob_get_contents()) ob_end_clean();

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'invoice_' . $invoiceId . '.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
