@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Rekening Pembayaran')
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
                        <div class="col-sm-6 panel-title">Data Rekening Pembayaran</div>
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
                                    <th class="text-center" width="10%">Aksi</th>
                                    <th class="text-center">Bank</th>
                                    <th class="text-center">No Rekening</th>
                                    <th class="text-center">Atas Nama</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Whatsapp Konfirmasi</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembayaran as $key)
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-id="{{ $key->id }}"
                                                class="btn btn-primary btn-xs btn-update">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="javascript:;" data-id="{{ $key->id }}"
                                                class="btn btn-danger btn-xs btn-delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $key->bank }}</td>
                                        <td class="text-center">{{ $key->no_rekening }}</td>
                                        <td class="text-center">{{ $key->atas_nama }}</td>
                                        <td class="text-center">{{ $key->nominal }}</td>
                                        <td class="text-center">{{ $key->whatsapp }}</td>
                                        <td class="text-center">
                                            @if ($key->status == 'aktif')
                                                <span class="label label-success"><i class="fa fa-check"></i> Aktif</span>
                                            @else
                                                <span class="label label-danger"><i class="fa fa-times"></i> Tidak
                                                    Aktif</span>
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
                    var url = "{{ route('pembayaran.create') }}";
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
                    var url = "{{ route('pembayaran.edit', ':id_data') }}";
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
                $(document).on("click", ".btn-delete", function() {
                    var id = $(this).attr("data-id");
                    var url = "{{ route('pembayaran.show', ':id_data') }}";
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
