<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Support\Facades\DB;

class ExcelQuoteController extends Controller
{
    public function exportQuotation($quoteId)
    {
        // === Fetch Main Quote ===
        $quote = DB::table('quotes')
            ->join('clients', 'quotes.client_id', '=', 'clients.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select(
                'quotes.*',
                'clients.address as client_address',
                'users.first_name as client_name',
                'users.contact as phone_number'
            )
            ->where('quotes.id', $quoteId)
            ->first();

        if (!$quote) {
            return abort(404, 'Quote not found');
        }

        // === Fetch Quote Items ===
        $items = DB::table('quote_items')
            ->leftJoin('products', 'quote_items.product_id', '=', 'products.id')
            ->select(
                'quote_items.*',
                'products.description as product_description',
                'products.code as product_code'
            )
            ->where('quote_items.quote_id', $quoteId)
            ->get();

        // === Create Spreadsheet ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // === Logo ===
        $drawing = new Drawing();
        $drawing->setName('EBM Logo');
        $drawing->setPath(public_path('assets/images/infyom.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($sheet);

        // === Company Info ===
        $sheet->setCellValue('C1', 'EBM CO., LTD.');
        $sheet->mergeCells('C1:F1');
        $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('E26B0A');
        $sheet->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->setCellValue('C2', 'Your Benefit, Our Achievement');
        $sheet->mergeCells('C2:F2');
        $sheet->getStyle('C2')->getFont()->setSize(11)->getColor()->setRGB('003399');

        // === Customer Info ===
        $sheet->setCellValue('A7', $quote->client_name);
        $sheet->mergeCells('A7:F7');
        $sheet->setCellValue('A8', 'Address: ' . $quote->client_address);
        $sheet->mergeCells('A8:F8');
        $sheet->setCellValue('A9', 'Phone: ' . $quote->phone_number);
        $sheet->mergeCells('A9:F9');

        // === Quotation Title ===
        $sheet->setCellValue('C11', 'QUOTATION');
        $sheet->mergeCells('C11:E11');
        $sheet->getStyle('C11')->getFont()->setBold(true)->setSize(13);
        $sheet->getStyle('C11')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('F11', 'Date: ' . now()->format('d-M-Y'));

        // === Table Header ===
        $sheet->setCellValue('A13', 'ITEM');
        $sheet->setCellValue('B13', 'DESCRIPTION');
        $sheet->setCellValue('C13', 'RATE');
        $sheet->getStyle('A13:C13')->getFont()->setBold(true);
        $sheet->getStyle('A13:C13')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A13:C13')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $excelItems = [];
        foreach ($items as $index => $item) {
            $description = $item->product_code;
            if ($item->product_description) {
                $description .= "\n" . $item->product_description;
            }

            $rate = 'USD ' . number_format($item->price, 2); 

            $excelItems[] = [
                $index + 1,
                $description,
                $rate
            ];
        }

        $startRow = 14;
        foreach ($excelItems as $index => $item) {
            $row = $startRow + $index;
            $sheet->setCellValue("A$row", $item[0]);
            $sheet->setCellValue("B$row", $item[1]);
            $sheet->setCellValue("C$row", $item[2]);

            $sheet->getStyle("A$row:C$row")->getAlignment()->setWrapText(true);
            $sheet->getStyle("A$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("C$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle("A$row:C$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            $sheet->getRowDimension($row)->setRowHeight(35);
        }

        // === Terms & Conditions ===
        $tcRow = $startRow + count($excelItems) + 1;
        $sheet->setCellValue("A$tcRow", 'TERMS AND CONDITIONS');
        $sheet->getStyle("A$tcRow")->getFont()->setBold(true)->setUnderline(true);

        $sheet->setCellValue("A" . ($tcRow + 1), '1. Validity: This quotation will be valid 14 days from the date of this quotation.');
        $sheet->setCellValue("A" . ($tcRow + 2), '2. Remarks: All prices quoted herein are exclusive of the 10% Government VAT, Government fee and Tax fine.');
        $sheet->setCellValue("A" . ($tcRow + 3), '3. Payment: At the beginning of process.');

        // === Signature Section ===
        $sheet->setCellValue('A24', 'For and on behalf of');
        $sheet->setCellValue('A25', 'EBM Co., Ltd.');
        $sheet->setCellValue('A26', ''); // leave blank to overlay image
        $sheet->setCellValue('A30', 'General Manager');
        $sheet->setCellValue('A31', 'Ms. Sok Cheng');

        $sheet->setCellValue('E24', 'Confirmed and Accepted by');
        $sheet->setCellValue('E30', 'Authorized Signature & Chop');
        $sheet->setCellValue('E31', 'Date: ___________________');

        // === Insert Stamp/Signature Image at A26 ===
        $stampPath = public_path('assets/images/signeco_cleanup-removebg-preview.png'); // update with your actual image path
        if (file_exists($stampPath)) {
            $stamp = new Drawing();
            $stamp->setName('Stamp Signature');
            $stamp->setDescription('Official Stamp');
            $stamp->setPath($stampPath);
            $stamp->setHeight(70); // You can increase or reduce as needed
            $stamp->setCoordinates('A26'); // 👈 this is the target cell
            $stamp->setOffsetX(10);        // Optional: shift image inside the cell
            $stamp->setOffsetY(5);
            $stamp->setWorksheet($sheet);
        }

        // === Horizontal Line ===
        $sheet->getStyle('A34:F34')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THICK);

        // === Footer Text ===
        $sheet->setCellValue('A40', '#151, Street 376, Beoung Keng Kang III, Khan Chamkarmorn, Phnom Penh, Cambodia');
        $sheet->mergeCells('A40:F40');
        $sheet->getStyle('A40')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A40')->getFont()->setSize(10);

        $sheet->setCellValue('A41', 'Tel: (855) 23 311 972, (855) 23 213 919 • Website: www.ebmcambodia.com');
        $sheet->mergeCells('A41:F41');
        $sheet->getStyle('A41')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A41')->getFont()->setSize(10)->getColor()->setRGB('003399'); // optional color


        // === Global Styling ===
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(55);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);

        $sheet->getStyle('A1:F40')->getFont()->setSize(11);
        $sheet->getStyle('A1:F40')->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

        // === Output ===
        if (ob_get_contents()) ob_end_clean();

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'quotation_ebm.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
