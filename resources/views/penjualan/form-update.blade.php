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
        <form method="post" action="{{ route('penjualan.update',$cart->no_transaksi) }}">
            @csrf
            @method('patch')
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
                                        <input type="text" value="{{ $cart->no_transaksi }}" class="form-control"
                                            name="no_invoice" readonly>
                                    </div>

                                    <div class="form-group  col-md-6">
                                        <label>Tanggal</label>
                                        <input type="date" value="{{ $cart->tanggal }}" class="form-control"
                                            name="tanggal" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Customer</label>
                                    <input type="text" name="customer" value="{{ $cart->customer }}"
                                        placeholder="Nama Customer" class="form-control" readonly>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label>Produk</label>
                                    <select name="produk" id="produk_id" onchange="pilihProduk()"
                                        class="form-control form-control-sm select2" style="width: 100%" required>
                                        <option value="" selected disabled>Pilih</option>
                                        @foreach ($produk as $key)
                                            <option value="{{ $key->id }}" data-harga="{{ $key->harga }}"
                                                data-modal="{{ $key->modal }}">{{ $key->nama_produk }}</option>
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
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add to
                            Cart</button>
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
                                    <th class="text-center" width="10%">Action</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($dataCart as $key)
                                    @php
                                        $total += $key->total;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                Hapus</a>
                                        </td>
                                        <td>{{ $key->produk->nama_produk ?? '' }}</td>
                                        <td class="text-right">{{ number_format($key->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $key->qty }}</td>
                                        <td class="text-right">{{ number_format($key->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"><strong>Total</strong></td>
                                    <td class="text-right"><strong>{{ number_format($total, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="javascript:;" class="btn btn-info btn-sm btn-bayar" data-id="{{ $cart->no_transaksi }}"><i class="fa fa-fax"></i> Bayar Sekarang</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div id="tempat-modal"></div>
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

            function pilihProduk() {
                var harga = $('#produk_id').find(':selected').attr('data-harga');
                var modal = $('#produk_id').find(':selected').attr('data-modal');
                $('#harga_satuan').val(harga);
                $('#harga_modal').val(modal);
            }

            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).on("click", ".btn-bayar", function() {
                    var id = $(this).attr("data-id");
                    var url = "{{ route('penjualan.show', ':id_data') }}";
                    url = url.replace(":id_data", id);
                    $.ajax({
                            method: "GET",
                            url: url,
                        })
                        .done(function(data) {
                            $('#tempat-modal').html(data.html);
                            $('#modal_show').modal('show');
                        })
                })
            });
        </script>
    @endpush
@endsection
