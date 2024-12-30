<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('ruangan.update',$dataRuangan->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_ruangan">Kode Ruangan</label>
                        <input type="text" name="kode_ruangan" value="{{ $dataRuangan->kode_ruangan}}" class="form-control form-control-sm" id="kode_ruangan"
                            placeholder="Kode Ruangan" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_ruangan">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" value="{{ $dataRuangan->nama_ruangan}}" class="form-control form-control-sm" id="nama_ruangan"
                           placeholder="Nama RUangan" required>
                    </div>

                    {{-- <div class="form-group">
                        <label for="poli_id">Poliklinik</label>
                        <select name="poli_id" class="form-control form-control-sm" id="poli_id" required>
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($poli as $key)
                                <option value="{{ $key->id }}" {{ ($dataRuangan->poli_id==$key->id) ? "selected" : "" }}>{{ $key->nama_poli }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
