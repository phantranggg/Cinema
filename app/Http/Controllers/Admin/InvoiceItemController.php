<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 22:30
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\InvoiceItem;
use App\Product;
use App\Services\InvoiceItemServiceInterface;
use App\Http\Controllers\Controller;

class InvoiceItemController extends Controller
{
    protected $invoiceItemService;
    //

    public function __construct(InvoiceItemServiceInterface $invoiceItemService)
    {
        $this->invoiceItemService = $invoiceItemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = $this->invoiceItemService->find($id);
        if (is_null($transaction)) {
            abort(404);
        }
        return view('admin/transaction/edit', compact('transaction'));
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
        $validator = \Validator::make($request->all(), $this->invoiceItemService->rulesUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $this->invoiceItemService->update($request, $id);
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
        $this->invoiceItemService->delete($id);
        return redirect()->back();
    }
    public function multiple_update(Request $request){
        $return = app('App\Http\Controllers\Admin\InvoiceController')->update($request,$request->invoiceid);

        for($i=0;$i<count($request->quantities);$i++){
            $transaction=$this->invoiceItemService->find($request->transaction_ids[$i]);
            $product=$transaction->product;
            $product->quantity= $product->quantity-($request->quantities[$i]-$transaction->quantity);
            $transaction->quantity=$request->quantities[$i];
            $transaction->save();
        }

        for($i=0;$i<count($request->new_product_id);$i++){
//            if($request->new_product_id $request->quantities)
            $quantity=$request->new_quantities[$i];
            $product_id=$request->new_product_id[$i];
            $product=Product::find($product_id);
            if(empty($product)||$product->quantity<$quantity){
                return redirect()->back();

            }
            $invoice_item=InvoiceItem::create(
                [ 'invoice_id'=>$request->invoiceid, 'product_id'=>$product_id,'quantity'=>$quantity]
            );
            $invoice_item->save();

        }

        return redirect()->back();

    }
}


