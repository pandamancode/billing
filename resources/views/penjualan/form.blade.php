@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Transaksi')
@section('content')
    <div class="row">
        <div id="respon">
            @if (session()->has('msg'))
                <div class="alert {{ session('class') }} alert-dark">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('msg') }}
                </div>
            @endif
        </div>
        <div class="col-md-12 text-right" style="margin-bottom: 5px;">
            <a href="{{ route('penjualan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-history"></i> Data Penjualan</a>
        </div>
        <form method="post" action="{{ route('penjualan.store') }}">
            @csrf
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Transaksi</div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>No Transaksi</label>
                                        <input type="text" value="{{ $invoice }}" class="form-control"
                                            name="no_invoice" readonly>
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label>Tanggal</label>
                                        <input type="date" value="{{ $tanggal }}" class="form-control"
                                            name="tanggal" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" name="customer" placeholder="Nama Customer"
                                        class="form-control"required>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label>Produk</label>
                                    <select name="produk" id="produk_id" onchange="pilihProduk()" class="form-control form-control-sm select2" style="width: 100%"
                                        required>
                                        <option value="" selected disabled>Pilih</option>
                                        @foreach ($produk as $key)
                                            <option value="{{ $key->id }}" data-harga="{{ $key->harga }}" data-modal="{{ $key->modal }}">{{ $key->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" id="harga_satuan"
                                            placeholder="Harga" readonly>
                                            <input type="hidden" class="form-control" name="modal" id="harga_modal"
                                            placeholder="Harga" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Qty</label>
                                        <input type="number" class="form-control" onkeyup="hitung()" name="qty"
                                            id="qty" placeholder="Qty" required>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Total Harga</label>
                                    <input type="number" class="form-control" name="total_harga" id="total_harga"
                                        placeholder="Total Harga" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Save & Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">Cart</div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="bg bg-warning">
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                <td colspan="6"><em>Tidak Ada Data</em></td>
                               </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            setTimeout(function() {
                document.getElementById('respon').innerHTML = '';
            }, 2000);

            $('.select2').select2();

            function hitung() {
                var hSatuan = $("#harga_satuan").val();
                var quantity = $("#qty").val();

                var calculate = parseInt(hSatuan) * parseInt(quantity);
                $("#total_harga").val(calculate);
            }

            function pilihProduk(){
                var harga = $('#produk_id').find(':selected').attr('data-harga');
                var modal = $('#produk_id').find(':selected').attr('data-modal');
                $('#harga_satuan').val(harga);
                $('#harga_modal').val(modal);
            }
        </script>
    @endpush
@endsection
