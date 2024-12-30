<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('perusahaan.update',$dataPerusahaan->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" value="{{ $dataPerusahaan->nama_rs }}" class="form-control form-control-sm"
                            placeholder="Nama Kategori" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control form-control-sm">{{ $dataPerusahaan->alamat_rs }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" class="form-control" value="{{ $dataPerusahaan->telp_rs }}" placeholder="No Telp" name="no_telp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>
                        Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                            class="fa fa-times"></i>Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
