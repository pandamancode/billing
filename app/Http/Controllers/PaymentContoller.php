<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Cetak Nota";
        $payment = Pembayaran::where("no_transaksi",$id)->first();
        $dataCart = Cart::where("no_transaksi",$id)->get();
        return view('penjualan.nota', compact(
            'title',
            'payment',
            'dataCart',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        DB::beginTransaction();
        try {
            $checkPembayaran = Pembayaran::where("no_transaksi", $id);
            if ($checkPembayaran->count() <= 0) {
                Pembayaran::firstOrCreate([
                    'no_transaksi' => $id,
                    'tanggal' => $request->tanggal,
                    'total_harga' => $request->total_harga,
                    'bayar' => $request->bayar,
                    'user_id' => Auth::user()->id,
                ]);
            }
            DB::commit();
            //return redirect()->route('payment.show', $id);
            return redirect()->route('penjualan.create');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['msg' => 'Gagal Melakukan Pembayaran', 'class' => 'alert-warning']);
        
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
