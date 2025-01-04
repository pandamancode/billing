<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan";
        return view('laporan.filter', compact(
            'title',
        ));
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
        $dari = $request->dari;
        $sampai = $request->sampai;
        $caption = Carbon::parse($request->dari)->format('d/m/Y')." s/d ".Carbon::parse($request->sampai)->format('d/m/Y');
        if ($request->kategori == 'RENTAL') {
            $data = Rent::where("payment","sudah")->whereBetween('tanggal', [$dari, $sampai])->get();
            $view = 'laporan.rental';
        } else {
            $data = Pembayaran::whereBetween('tanggal', [$dari, $sampai])->get();
            $view = 'laporan.penjualan';
        }

        return view($view, compact(
            'data',
            'caption'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
