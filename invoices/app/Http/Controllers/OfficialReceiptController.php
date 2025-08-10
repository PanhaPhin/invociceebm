<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as AppBaseController;
use Laracasts\Flash\Flash;

class OfficialReceiptController extends AppBaseController
{
    protected SettingRepository $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display the invoice template settings page.
     */
    public function invoiceTemplateView(): View
    {
        $invoiceTemplate = InvoiceSetting::all()->toArray();
        $defaultTemplate = Setting::where('key', 'default_invoice_template')->first();

        return view('settings.setting-invoice', compact('invoiceTemplate', 'defaultTemplate'));
    }

    /**
     * Update invoice template settings.
     */
    public function invoiceTemplateUpdate(Request $request): RedirectResponse
    {
        $this->settingRepository->updateInvoiceSetting($request->all());

        Flash::success(__('messages.flash.invoice_template_updated_successfully'));

        return redirect()->route('invoiceTemplate');
    }

    /**
     * Display the official receipt view for a given invoice.
     */
    public function showInvoice(string $invoiceId): View
    {
        $data = DB::table('invoices')
            ->join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id')
            ->select(
                'invoices.id as invoice_db_id',
                'invoices.invoice_id',
                'invoices.invoice_date',
                'invoices.due_date',
                'invoices.amount',
                'invoices.address as invoice_address',
                'invoices.final_amount',
                'invoices.status',

                'clients.id as client_id',
                'clients.address as client_address',
                'clients.postal_code',
                'clients.user_id',

                'users.first_name as client_name',
                'users.contact as phone_number',

                'products.id as product_id',
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
            ->where('invoices.invoice_id', $invoiceId)
            ->get();

        if ($data->isEmpty()) {
            abort(404, 'Invoice not found.');
        }

        return view('invoices.invoice_template_pdf.OfficialReceipt', compact('data'));
    }
}
