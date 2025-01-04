@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Category')
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
                        <div class="col-sm-6 panel-title">Data Category</div>
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
                                    <th class="text-center">Nama Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $key)
                                    <tr class="odd gradeX">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if ($key->id != 1)
                                                <a href="javascript:;" data-id="{{ $key->id }}"
                                                    class="btn btn-primary btn-xs btn-update">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:;" data-id="{{ $key->id }}"
                                                    class="btn btn-danger btn-xs btn-delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $key->nama_kategori }}</td>
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
                    var url = "{{ route('category.create') }}";
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
                    var url = "{{ route('category.edit', ':id_data') }}";
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
                    var url = "{{ route('category.show', ':id_data') }}";
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
