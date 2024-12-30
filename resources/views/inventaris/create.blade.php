<div class="modal fade" id="modal_show" role="dialog" data-backdrop="static" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('inventaris.store') }}" id="idForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="barang_id" id="barang_aset" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($dataBarang as $key)
                                <option value="{{ $key->id }}">{{ $key->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SN</label>
                        <input type="text" name="sn" class="form-control form-control-sm"
                            placeholder="Serial Number" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pengadaan</label>
                        <input type="date" name="tanggal_pengadaan" class="form-control form-control-sm"
                            placeholder="Tanggal Pengadaan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Tahun Pembuatan</label>
                        <input type="text" maxlength="4" name="tahun_pembuatan"
                            class="form-control form-control-sm" placeholder="Tahun Pembuatan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>No. Izin Edar</label>
                        <input type="text" name="no_izin_edar" class="form-control form-control-sm"
                            placeholder="No. Izin Edar" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-control">
                            <option value="Layak Pakai">Layak Pakai</option>
                            <option value="Butuh Tindakan">Butuh Tindakan</option>
                            <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto Aset</label>
                        <input type="file" name="image" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Lokasi Barang</label>
                        <select name="ruangan" id="ruangan" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($dataRuangan as $key)
                                <option value="{{ $key->id }}">{{ $key->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#barang_aset,#ruangan').select2({
        width: '100%',
        dropdownParent: $("#modal_show")
    });
</script>
