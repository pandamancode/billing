<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('barang.update',$dataBarang->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ $dataBarang->kode_barang }}" class="form-control form-control-sm"
                            placeholder="Kode Barang" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control form-control-sm"
                            placeholder="Nama Barang" value="{{ $dataBarang->nama_barang }}" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" value="{{ $dataBarang->merk }}" class="form-control form-control-sm" placeholder="Merk"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <input type="text" name="tipe" value="{{ $dataBarang->tipe }}" class="form-control form-control-sm" placeholder="Tipe"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="spesifikasi">Spesifikasi</label>
                        <textarea name="spesifikasi" class="form-control form-control-sm" placeholder="Spesifikasi">{{ $dataBarang->spesifikasi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="klasifikasi_id">Klasifikasi</label>
                        <select name="klasifikasi_id" id="klasifikasi_id" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach($klasifikasi as $key)
                            <option value="{{ $key->id }}" {{ ($key->id==$dataBarang->klasifikasi_id) ? "selected" : "" }}>{{ $key->nama_klasifikasi }}</option>
                            @endforeach
                        </select>
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
