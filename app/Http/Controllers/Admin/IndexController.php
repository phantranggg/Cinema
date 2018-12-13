<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use App\Services\ProductServiceInterface;
use App\Services\InvoiceServiceInterface;
use App\Services\InvoiceItemServiceInterface;

class IndexController extends Controller
{
    protected $userService;
    protected $productService;
    protected $invoiceService;
    protected $invoiceItemService;

    public function __construct(UserServiceInterface $userService, ProductServiceInterface $productService, InvoiceServiceInterface $invoiceService, InvoiceItemServiceInterface $invoiceItemService) {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->invoiceService = $invoiceService;
        $this->invoiceItemService = $invoiceItemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $userNum = $this->userService->count();
        $productNum = $this->productService->count();
        $invoiceNum = $this->invoiceService->count();
        $latestInvoices = $this->invoiceService->getLatestInvoices(7);
        $monthlyOrderedInvoiceNum = $this->invoiceService->getMonthlyOrderedInvoiceNum();
        $monthlyPaidInvoiceNum = $this->invoiceService->getMonthlyPaidInvoiceNum();
        $bestSellerProductList = $this->invoiceItemService->getBestSellerProductList(10);
        $monthlyRevenue = $this->invoiceService->getMonthlyRevenue();
        // echo $monthlyPaidInvoiceNum;
        return view('admin/index', compact('userNum', 'productNum', 'invoiceNum','latestInvoices', 
        'monthlyOrderedInvoiceNum', 'monthlyPaidInvoiceNum', 'bestSellerProductList', 'monthlyRevenue'));
    }
    
}
