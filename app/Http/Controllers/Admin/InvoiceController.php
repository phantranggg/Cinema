<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Invoice;
use App\Services\InvoiceServiceInterface;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    protected $productService;

    public function __construct(InvoiceServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = $this->productService->index($request);
        return view('admin/invoice/index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->productService->rulesCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $this->productService->store($request);
        return redirect()->route('admin.setting.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = $this->productService->find($id);
        if (is_null($invoice)) {
            abort(404);
        }
        return view('admin/invoice/show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = $this->productService->find($id);
        if (is_null($invoice)) {
            abort(404);
        }
        return view('admin/invoice/edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), $this->productService->rulesUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $this->productService->update($request, $id);
            return redirect()->route('admin.setting.product.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->back();
    }
}


