<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cabang;
use Illuminate\Support\Facades\Hash;

class AkunpenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Pengguna";
        $dataUser = User::all();
        return view('user.data', compact(
            'title',
            'dataUser'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = "Tambah Pengguna";
        $dataPerusahaan = RumahSakit::all();
        $view = view('user.create',compact('judul','dataPerusahaan'))->render();
        return response()->json([
            'success' => true, 
            'html'=> $view
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
        $user = User::where("email",$request->email)->count();
        if($user>0){
            return back()->with(['msg' => 'Username Sudah Digunakan','class'=>'alert-danger']);
        }else{
            $rsId = $request->rs !=null ? $request->rs : null;
            User::create([
                'email' => $request->email,
                'name' => $request->nama,
                'level' => $request->level,
                'rs_id' => $rsId,
                'password' => Hash::make($request->password),
            ]);
            return back()->with(['msg' => 'Berhasil Menambah Pengguna','class'=>'alert-success']);
        }
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
        User::where("id",$id)->update([
            'password' => Hash::make('clarion'),
        ]);
        return back()->with(['msg' => 'Password direset menjadi clarion','class'=>'alert-success']);
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
