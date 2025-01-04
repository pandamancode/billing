<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Data Product";
        $product = Product::all();
        return view('product.data', compact(
            'title',
            'product',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = "Add Product";
        $category = Category::all();
        $view = view('product.create', compact('judul','category'))->render();
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
        Product::create([
            'kategori_id' => $request->kategori,
            'nama_produk' => $request->produk,
            'modal' => $request->modal,
            'harga' => $request->harga,
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
        $judul = "Delete Product";
        $product = Product::findOrFail($id);
        $view = view('product.delete', compact('judul', 'product'))->render();
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
        $product = Product::findOrFail($id);
        $category = Category::all();
        $view = view('product.update', compact('judul', 'product','category'))->render();
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
        Product::where("id", $id)->update([
            'kategori_id' => $request->kategori,
            'nama_produk' => $request->produk,
            'harga' => $request->harga,
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
        Product::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }
}
