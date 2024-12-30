<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use App\Models\Ruangan;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Data Ruangan";
        $dataPerusahaan = RumahSakit::all();
        if ($request->has('rs')) {
            $rsId = $request->rs;
            $request->session()->put('sess_rsId',$rsId);
            $showTable = true;
            $dataRuangan = Ruangan::where("rs_id",$request->rs)->get();
        }else{
            $rsId = null;
            $showTable = false;
            $dataRuangan= [];
        }
        return view('master.ruangan.data', compact(
            'title',
            'dataPerusahaan',
            'dataRuangan',
            'showTable',
            'rsId'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = "Tambah Ruangan";
        $poli = Poliklinik::all();
        $view = view('master.ruangan.create', compact('judul','poli'))->render();
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
        Ruangan::create([
            'rs_id' => $request->session()->get('sess_rsId'),
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            // 'poli_id' => $request->poli_id,
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
        $judul = "Hapus Ruangan";
        $dataRuangan = Ruangan::where("id", $id)->first();
        $view = view('master.ruangan.delete', compact('judul', 'dataRuangan'))->render();
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
        $judul = "Edit Ruangan";
        $dataRuangan = Ruangan::where("id", $id)->first();
        $poli = Poliklinik::all();
        $view = view('master.ruangan.update', compact('judul', 'dataRuangan','poli'))->render();
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
        Ruangan::where("id", $id)->update([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            // 'poli_id' => $request->poli_id,
        ]);
        return back()->with(['msg' => 'Berhasil Merubah Data', 'class' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ruangan::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }
}
