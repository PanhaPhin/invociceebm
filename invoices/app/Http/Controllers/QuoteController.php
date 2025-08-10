<?php

namespace App\Http\Controllers;


use App\Exports\AdminQuotesExport;
use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Quote;
use App\Repositories\QuoteRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class QuoteController extends AppBaseController
{
    /** @var QuoteRepository */
    protected $quoteRepository;

    public function __construct(QuoteRepository $quoteRepo)
    {
        $this->quoteRepository = $quoteRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     * @throws Exception
     */
    public function index(Request $request): View
    {
        $statusArr = Quote::STATUS_ARR;
        $status = $request->status;

        return view('quotes.index', compact('statusArr', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $data = $this->quoteRepository->getSyncList();

        return view('quotes.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateQuoteRequest $request
     * @return JsonResponse
     */
    public function store(CreateQuoteRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $request->status = Quote::DRAFT;
            $quote = $this->quoteRepository->saveQuote($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($quote, __('messages.flash.quote_saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param Quote $quote
     * @return View
     */
    public function show(Quote $quote): View
    {
        $quoteData = $this->quoteRepository->getQuoteData($quote);

        return view('quotes.show')->with($quoteData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quote $quote
     * @return RedirectResponse|View
     */
    public function edit(Quote $quote)
    {
        if ($quote->status == Quote::CONVERTED) {
            Flash::error(__('messages.flash.converted_quote_can_not_editable'));
            return redirect()->route('quotes.index');
        }

        $data = $this->quoteRepository->prepareEditFormData($quote);

        return view('quotes.edit', compact('quote'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQuoteRequest $request
     * @param Quote $quote
     * @return JsonResponse
     */
    public function update(UpdateQuoteRequest $request, Quote $quote): JsonResponse
    {
        $input = $request->all();
        try {
            DB::beginTransaction();
            $quote = $this->quoteRepository->updateQuote($quote->id, $input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($quote, __('messages.flash.quote_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quote $quote
     * @return JsonResponse
     */
    public function destroy(Quote $quote): JsonResponse
    {
        $quote->delete();
        return $this->sendSuccess(__('messages.flash.quote_deleted_successfully'));
    }

    /**
     * Get product details by product ID.
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function getProduct(int $productId): JsonResponse
    {
        $product = Product::pluck('unit_price', 'id')->toArray();
        return $this->sendResponse($product, __('messages.flash.product_price_retrieved_successfully'));
    }

    /**
     * Convert the quote to PDF.
     *
     * @param Quote $quote
     * @return Response
     */


public function convertToPdf(Quote $quote): Response
{
    // Fetch quote data with joins
    $data = DB::table('quotes')
        ->join('clients', 'quotes.client_id', '=', 'clients.id')
        ->join('quote_items', 'quotes.id', '=', 'quote_items.quote_id')
        ->join('products', 'quote_items.product_id', '=', 'products.id')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id')
        ->select(
            'quotes.id as quotes_db_id',
            'quotes.quote_id',
            'quotes.quote_date',
            'quotes.due_date',
            'quotes.amount',
            'quotes.description as quote_description',
            'quotes.rate',
            'quotes.final_amount',
            'quotes.status',
            'clients.id as client_id',
            'clients.address',
            'clients.postal_code',
            'clients.user_id',
            'users.first_name as client_name',
            'users.contact as phone_number',
            'products.id as product_id',
            'products.name as product_name',
            'products.code as product_code',
            'products.description as product_description',
            'products.unit_price',
            'quote_items.quantity',
            'quote_items.price as item_price',
            'quotations.description as quotation_description',
            'quotations.rate as quotation_rate',
            'quotations.date as quotation_date'
        )
        ->where('quotes.id', $quote->id)
        ->get();

    // Return the PDF view
    return response()->view('quotes.quote_template_pdf.defaultTemplate', [
        'data' => $data,
        'quote' => $quote,
    ]);
}


    /**
     * Convert quotes to a specific format.
     *
     * @param Request $request
     * @return mixed
     */
   public function convertToquotes(Request $request): mixed
{
    $quotesId = $request->input('quotes_id');
    

    // Fetch all related data
    $rawData = DB::table('quotes')
        ->join('clients', 'quotes.client_id', '=', 'clients.id')
        ->join('quote_items', 'quotes.id', '=', 'quote_items.quote_id')
        ->join('products', 'quote_items.product_id', '=', 'products.id')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->leftJoin('quotations', 'quotations.client_id', '=', 'clients.id')
        ->select(
            'quotes.id as quotes_db_id',
            'quotes.quote_id',
            'quotes.quote_date',
            'quotes.due_date',
            'quotes.amount',
            'quotes.description as quote_description',
            'quotes.rate',
            'quotes.final_amount',
            'quotes.status',
            'clients.id as client_id',
            'clients.address',
            'clients.postal_code',
            'clients.user_id',
            'clients.company_name',
            'users.first_name as client_name',
            'users.contact as phone_number',
            'products.id as product_id',
            'products.name as product_name',
            'products.code as product_code',
            'products.description as product_description',
            'products.unit_price',
            'quote_items.quantity',
            'quote_items.price as item_price',
            'quotations.description as quotation_description',
            'quotations.rate as quotation_rate',
            'quotations.date as quotation_date'
        )
        ->where('quotes.id', $quotesId)
        ->get();

    // If no data found
    if ($rawData->isEmpty()) {
        abort(404, 'Quote not found');
    }

    // Extract quote and client data from first item
    $first = $rawData->first();

    $client = (object)[
        'id' => $first->client_id,
        'address' => $first->address,
        'postal_code' => $first->postal_code,
        'user_id' => $first->user_id,
        'company_name' => $first->company_name ?? $first->client_name,
        'phone_number' => $first->phone_number
    ];

    $quote = (object)[
        'id' => $first->quotes_db_id,
        'quote_id' => $first->quote_id,
        'quote_date' => $first->quote_date,
        'due_date' => $first->due_date,
        'description' => $first->quote_description,
        'rate' => $first->rate,
        'amount' => $first->amount,
        'final_amount' => $first->final_amount,
        'status' => $first->status
    ];

    // Extract item details
    $quoteItems = $rawData->map(function ($item) {
        return (object)[
            'product_name' => $item->product_name,
            'product_description' => $item->product_description,
            'item_price' => $item->item_price,
            'quantity' => $item->quantity,
        ];
    });

    // Return the Blade view
    return view('quotes.quote_template_pdf.defaultTemplate', compact('client', 'quote', 'quoteItems'));
}



    /**
     * Export quotes to an Excel file.
     *
     * @return BinaryFileResponse
     */
    public function exportQuotesExcel(): BinaryFileResponse
    {
        return Excel::download(new AdminQuotesExport(), 'quote-excel.xlsx');
    }

    /**
     * Get public quote PDF by quote ID.
     *
     * @param string $quoteId
     * @return Response
     */
    public function getPublicQuotePdf(string $quoteId): Response
    {
        $quote = Quote::whereQuoteId($quoteId)->firstOrFail();
        $quote->load('client.user', 'invoiceTemplate', 'quoteItems.product', 'quoteItems');
        $quoteData = $this->quoteRepository->getPdfData($quote);
        $invoiceTemplate = $this->quoteRepository->getDefaultTemplate($quote);
        $pdf = Pdf::loadView("quotes.quote_template_pdf.$invoiceTemplate", $quoteData);

        return $pdf->stream('quote.pdf');
    }

    /**
     * Show public quote by quote ID.
     *
     * @param string $quoteId
     * @return View|Factory|Application
     */
    public function showPublicQuote(string $quoteId): View|Factory|Application
    {
        $quote = Quote::with('client.user')->whereQuoteId($quoteId)->first();
        $quoteData = $this->quoteRepository->getQuoteData($quote);
        $quoteData['statusArr'] = Quote::STATUS_ARR;
        $quoteData['status'] = $quote->status;
        $quoteData['userLang'] = $quote->client->user->language;

        return view('quotes.public-quote.public_view')->with($quoteData);
    }

    /**
     * Export all quotes to a PDF file.
     *
     * @return Response
     */
    public function exportQuotesPdf(): Response
    {
        ini_set('max_execution_time', 3);
        $data['quotes'] = Quote::with('client.user')->orderBy('created_at', 'desc')->get();
        $quotesPdf = Pdf::loadView('quotes.export_quotes_pdf', $data);

        return $quotesPdf->download('Quotes.pdf');
    }
}
