<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class InvoiceDetailExport implements FromView
{
    protected $invoiceId;

    public function __construct($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    public function view(): View
    {
        $data = DB::table('invoices')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id')
            ->select(
                'invoices.invoice_id',
                'invoices.invoice_date',
                'invoices.due_date',
                'invoices.amount',
                'invoices.final_amount',
                'invoices.status',
                'clients.address as client_address',
                'clients.postal_code',
                'users.first_name as client_name',
                'users.contact as phone_number',
                'products.id as product_id', // <-- Add this line
                'products.name as product_name',
                'products.code as product_code',
                'products.description as product_description',
                'products.unit_price',
                'invoice_items.quantity',
                'invoice_items.price as item_price',
                'quotations.description as quotation_description',
                'quotations.rate as quotation_rate',
                'quotations.date as quotation_date'
            )
            ->where('invoices.invoice_id', $this->invoiceId)
            ->get();

        return view('invoices.exports.invoice_details', [
            'data' => $data
        ]);
    }
}
// This class is used to export invoice details to an Excel file using a view.
