<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Data Penjualan";
        $cart = Cart::groupBy("no_transaksi")->get();
        return view('penjualan.data', compact(
            'title',
            'cart',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Form Penjualan";
        $invoice = time();
        $produk = Product::where("kategori_id","1")->get();
        $tanggal = Carbon::now()->format('Y-m-d');
        return view('penjualan.form', compact(
            'title',
            'invoice',
            'tanggal',
            'produk'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::firstOrCreate([
            'no_transaksi' => $request->no_invoice,
            'tanggal' => $request->tanggal,
            'customer' => $request->customer,
            'produk_id' => $request->produk,
            'qty' => $request->qty,
            'modal' => $request->modal,
            'harga' => $request->harga,
            'total_modal' => $request->modal * $request->qty,
            'total' => $request->harga * $request->qty,
        ]);

        return redirect()->route('penjualan.edit',$request->no_invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $judul = "Payment";
        $cart = Cart::where("no_transaksi",$id)->first();
        $dataCart = Cart::where("no_transaksi",$id)->get();
        $view = view('penjualan.payment', compact('judul', 'cart','dataCart'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Form Penjualan";
        $invoice = $id;
        $produk = Product::where("kategori_id","1")->get();
        $cart = Cart::where('no_transaksi',$id)->first();
        $dataCart = Cart::where('no_transaksi',$id)->get();
        return view('penjualan.form-update', compact(
            'title',
            'invoice',
            'cart',
            'dataCart',
            'produk'
        ));
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
        $cart = Cart::where("no_transaksi",$id)->where("produk_id",$request->produk);
        if($cart->count()>0){
            Cart::where("no_transaksi",$id)->where("produk_id",$request->produk)->update([
                'qty' => $request->qty,
                'modal' => $request->modal,
                'harga' => $request->harga,
                'total_modal' => $request->modal * $request->qty,
                'total' => $request->harga * $request->qty,
            ]);
        }else{
            Cart::firstOrCreate([
                'no_transaksi' => $id,
                'tanggal' => $request->tanggal,
                'customer' => $request->customer,
                'produk_id' => $request->produk,
                'qty' => $request->qty,
                'modal' => $request->modal,
                'harga' => $request->harga,
                'total_modal' => $request->modal * $request->qty,
                'total' => $request->harga * $request->qty,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
