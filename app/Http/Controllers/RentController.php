<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Rent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Data Rent";
        $rent = Rent::all();
        return view('rent.data', compact(
            'title',
            'rent',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = "Create New";
        $category = Category::where("id","<>","1")->get();
        $product = Product::all();
        $view = view('rent.create', compact('judul','category','product'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->produk);
        $harga = $product->harga ?? 0;
        Rent::create([
            'produk_id' => $request->produk,
            'customer' => $request->customer,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->tanggal." ".$request->jam_mulai,
            'qty' => $request->qty,
            'harga_perjam' => $harga,
            'diskon' => 0,
            'harga_sebelum_diskon' => $harga * $request->qty,
            'harga_setelah_diskon' => $harga * $request->qty,
        ]);
        return back()->with(['msg' => 'Berhasil Menambah Data', 'class' => 'alert-success']);
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
        $rent = Rent::findOrFail($id);
        $view = view('rent.payment', compact('judul', 'rent'))->render();
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
        $judul = "Edit";
        $category = Category::where("id","<>","1")->get();
        $product = Product::all();
        $rent = Rent::findOrFail($id);
        $view = view('rent.update', compact('judul','category','product','rent'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
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
        if($request->has('payment')){
            if($request->open_billing=='ya'){
                Rent::where("id",$id)->update([
                    'open_billing' => $request->open_billing,
                    'harga_setelah_diskon' => $request->total_harga,
                    'bayar' => $request->bayar,
                    'kembalian' => $request->kembalian,
                    'payment' => 'sudah'
                ]);
            }else{
                Rent::where("id",$id)->update([
                    'open_billing' => $request->open_billing,
                    'bayar' => $request->bayar,
                    'kembalian' => $request->kembalian,
                    'payment' => 'sudah'
                ]);
            }
            
            return back()->with(['msg' => 'Berhasil Melakukan Pembayaran', 'class' => 'alert-success']);
        }else{
            $product = Product::findOrFail($request->produk);
            $harga = $product->harga ?? 0;
            Rent::where("id",$id)->update([
                'produk_id' => $request->produk,
                'customer' => $request->customer,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'qty' => $request->qty,
                'harga_perjam' => $harga,
                'diskon' => 0,
                'harga_sebelum_diskon' => $harga * $request->qty,
                'harga_setelah_diskon' => $harga * $request->qty,
            ]);
            return back()->with(['msg' => 'Berhasil Merubah Data', 'class' => 'alert-success']);
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
        //
    }
}
