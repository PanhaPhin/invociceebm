<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use App\Models\Product;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as AppBaseController;

use Carbon\Carbon;

class InvoiceTemplateController extends AppBaseController
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function invoiceTemplateView(): \Illuminate\View\View
    {
        $invoiceTemplate = InvoiceSetting::all()->toArray();
        $defaultTemplate = Setting::where('key', 'default_invoice_template')->first();

        return view('settings.setting-invoice', compact('invoiceTemplate', 'defaultTemplate'));
    }

    public function invoiceTemplateUpdate(Request $request): RedirectResponse
    {
        $this->settingRepository->updateInvoiceSetting($request->all());
        Flash::success(__('messages.flash.invoice_template_updated_successfully'));

        return redirect()->route('invoiceTemplate');
    }


public function showInvoice($invoiceId)
{
    $data = DB::table('invoices')
    ->join('clients', 'invoices.client_id', '=', 'clients.id')
    ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
    ->join('products', 'invoice_items.product_id', '=', 'products.id')
    ->join('users', 'clients.user_id', '=', 'users.id')
    ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id') // ✅ Join with quotations
    
    ->select(
        'invoices.id as invoice_db_id',
        'invoices.invoice_id',
        'invoices.invoice_date',
        'invoices.due_date',
        'invoices.amount',
        'invoices.address as invoice_address',
        'invoices.final_amount',
        'invoices.status',
        'invoices.exchange_rate', // Assuming you want to include exchange rate
        'invoices.exchange_currency', // Assuming you want to include exchange currency

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

         'quotations.description as quotation_description', // optional
            'quotations.rate as quotation_rate',
            'quotations.date as quotation_date'

    )
    ->where('invoices.invoice_id', $invoiceId)
        
    ->get();
        //  dd($data);
    return view('invoices.invoice_template_pdf.defaultTemplate', compact(
        'data',
       
    ));

    
   

}




}
