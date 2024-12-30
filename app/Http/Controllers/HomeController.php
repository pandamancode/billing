<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Rent;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Halaman Home";
        $totalCategory = Category::count();
        $totalProduct = Product::count();
        $totalRent = Rent::count();
        $today = Carbon::now()->format('Y-m-d');
        $transaksi = Rent::where("tanggal",$today)->orderBy("id","desc")->get();
        return view('home.index', compact(
            'title',
            'totalCategory',
            'totalProduct',
            'totalRent',
            'today',
            'transaksi'
        )
        );
        

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

    public function perbarui_password()
    {
        $title = "Ubah Password";
        return view('auth.perbarui-password', compact('title'));
    }

    public function updatepw(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with(['msg' => 'Password Lama Salah', 'class' => 'alert-warning']);
        }

        if (strcmp($request->get('current-password'), $request->get('new_password')) == 0) {
            return redirect()->back()->with(['msg' => 'Masukkan Password Baru', 'class' => 'alert-warning']);
        }

        if (!(strcmp($request->get('new_password'), $request->get('new_password_confirm'))) == 0) {
            return redirect()->back()->with(['msg' => 'Ulangi Password Baru', 'class' => 'alert-warning']);
        }

        $user = User::findorfail(Auth::user()->id);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back()->with(['msg' => 'Berhasil Merubah Data', 'class' => 'alert-success']);
    }
}
