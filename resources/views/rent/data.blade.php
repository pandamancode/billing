@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Rent (Penyewaan)')
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
                    <div class="row">
                        <div class="col-sm-6 panel-title">Data Rent (Penyewaan)</div>
                        <div class="col-sm-6 card-tools text-right">

                            <a href="javascript:;" class="btn btn-xs btn-primary btn-add">
                                <i class="fa fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="table-default">
                        <table class="table table-striped table-bordered" id="datatables">
                            <thead>
                                <tr class="bg bg-warning">
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="15%">Action</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Produk</th>
                                    <th class="text-center">Harga<sup>Jam</sup></th>
                                    <th class="text-center">Qty<sup>Jam</sup></th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rent as $key)
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if($key->payment=='sudah')
                                            <button class="btn btn-primary btn-xs" disabled>
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            @else
                                            <a href="javascript:;" data-id="{{ $key->id }}"
                                                class="btn btn-primary btn-xs btn-update">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @endif
                                            <a href="javascript:;" data-id="{{ $key->id }}"
                                                class="btn btn-success btn-xs btn-payment">
                                                <i class="fa fa-fax"></i> Bayar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span>
                                                {{ date('d/m/Y',strtotime($key->tanggal)) }}<br>
                                                Mulai Pukul : <strong>{{ \Carbon\Carbon::parse($key->jam_mulai)->format('H:i') }}</strong>
                                            </span>
                                        </td>
                                        <td>{{ $key->customer }}</td>
                                        <td>
                                            <span>
                                                {{ $key->product->category->nama_kategori ?? ''}}<br>
                                                {{ $key->product->nama_produk ?? '' }}
                                            </span>
                                        </td>
                                        <td class="text-right">{{ number_format($key->harga_perjam, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $key->qty }}<sup>Jam</sup></td>
                                        <td class="text-right">{{ number_format($key->qty * $key->harga_perjam, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if($key->payment=='sudah')
                                            <span class="label label-success"><i class="fa fa-check"></i> Sudah Bayar</span>
                                            @else
                                            <span class="label label-warning"><i class="fa fa-refresh fa-spin"></i> Belum Bayar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="tempat-modal"></div>

    @push('js')
        <script>
            setTimeout(function() {
                document.getElementById('respon').innerHTML = '';
            }, 2000);
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).on("click", ".btn-add", function() {
                    var url = "{{ route('rent.create') }}";
                    $.ajax({
                            method: "GET",
                            url: url,
                        })
                        .done(function(data) {
                            $('#tempat-modal').html(data.html);
                            $('#modal_show').modal('show');
                        })
                })
                $(document).on("click", ".btn-update", function() {
                    var id = $(this).attr("data-id");
                    var url = "{{ route('rent.edit', ':id_data') }}";
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
                $(document).on("click", ".btn-payment", function() {
                    var id = $(this).attr("data-id");
                    var url = "{{ route('rent.show', ':id_data') }}";
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
