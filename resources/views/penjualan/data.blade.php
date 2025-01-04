@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Penjualan')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert {{ session('class') }} alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">Data Penjualan</div>
                </div>
                <div class="panel-body">

                    <div class="table-default">
                        <table class="table table-striped table-bordered" id="datatables">
                            <thead>
                                <tr class="bg bg-warning">
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="10%">Action</th>
                                    <th class="text-center">No Transaksi</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Produk</th>
                                    <th class="text-center">Status Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key)
                                @php
                                    $cart = DB::table("carts")->join("products","products.id","=","carts.id")->where("carts.no_transaksi",$key->no_transaksi)->get();
                                    $payment = DB::table("pembayarans")->where("no_transaksi",$key->no_transaksi);
                                @endphp
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if($payment->count()>0)
                                            <button type="button" disabled
                                                class="btn btn-primary btn-xs">
                                                <i class="fa fa-fax"></i> Bayar
                                        </button>
                                            @else
                                            <a href="{{ route('penjualan.edit',$key->no_transaksi) }}" 
                                                class="btn btn-primary btn-xs">
                                                <i class="fa fa-fax"></i> Bayar
                                            </a>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $key->no_transaksi }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($key->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $key->customer }}</td>
                                        <td>
                                            @foreach($cart as $r)
                                                <li>{{ $r->nama_produk }}</li>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if($payment->count()>0)
                                            <span class="label label-success">Sudah Bayar</span>
                                            @else
                                            <span class="label label-warning">Belum Bayar</span>
                                            @endif
                                        </td>
                                        {{-- <td class="text-center">{{ number_format($key->harga, 0, ',', '.') }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
