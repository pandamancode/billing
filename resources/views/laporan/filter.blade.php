@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Laporan')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">Filter Laporan</div>
                </div>
                <form method="post" target="_blank" action="{{ route('laporan.store') }}">
                    @csrf
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Kategori Laporan</label>
                                <select class="form-control" name="kategori" required>
                                    <option value="" selected disabled>Pilih</option>
                                    <option value="RENTAL">RENTAL</option>
                                    <option value="PENJUALAN">PENJUALAN</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Dari Tanggal</label>
                                <input type="date" class="form-control" name="dari" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sampai Tanggal</label>
                                <input type="date" class="form-control" name="sampai" required>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="action" value="cetak" class="btn btn-primary"><i
                                class="fa fa-print"></i> Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
