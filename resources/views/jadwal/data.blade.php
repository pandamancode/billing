@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Jadwal Pemeliharaan')
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
            @include('jadwal.filter') <!-- Filter form -->
            @if ($showTable)
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6 panel-title">Jadwal Pemeliharaan</div>
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
                                        <th class="text-center">RS ID</th>
                                        <th class="text-center">Maintener ID</th>
                                        <th class="text-center">Aset ID</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataJadwal as $key)
                                        <tr class="odd gradeX">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <a href="javascript:;" data-id="{{ $key->id }}" title="Edit"
                                                    class="btn btn-primary btn-xs btn-update">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" data-id="{{ $key->id }}" title="Detail"
                                                    class="btn btn-success btn-xs btn-detail">
                                                    <i class="fa fa-list-alt"></i>
                                                </a>
                                                <a href="javascript:;" data-id="{{ $key->id }}" title="Hapus"
                                                    class="btn btn-danger btn-xs btn-delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">{{ $key->rs_id }}</td>
                                            <td class="text-center">{{ $key->maintener_id }}</td>
                                            <td class="text-center">{{ $key->aset_id }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($key->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-center">
                                                @if ($key->STATUS == 'Aktif')
                                                    <span class="label label-success"><i class="fa fa-check"></i>
                                                        Aktif</span>
                                                @elseif($key->STATUS == 'Non-Aktif')
                                                    <span class="label label-warning"><i class="fa fa-times"></i>
                                                        Non-Aktif</span>
                                                @else
                                                    <span class="label label-danger"><i class="fa fa-ban"></i> Tidak
                                                        Aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $key->catatan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
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
                    var url = "{{ route('inventaris.create') }}";
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
                    var url = "{{ route('inventaris.edit', ':id_data') }}";
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
                    var url = "{{ route('inventaris.show', ':id_data') }}";
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
                $(document).on("click", ".btn-detail", function() {
                    var id = $(this).attr("data-id");
                    var url = "{{ route('inventaris-detail', ':id_data') }}";
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
