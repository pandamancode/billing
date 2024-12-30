<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('pembayaran.store') }}" id="idForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Bank</label>
                        <input type="text" name="bank" class="form-control form-control-sm"
                            placeholder="Bank" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>No Rekening</label>
                        <input type="text" name="norek" class="form-control form-control-sm"
                            placeholder="No Rekening" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control form-control-sm"
                            placeholder="Atas Nama" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" class="form-control form-control-sm"
                            placeholder="Nominal" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Konfirmasi</label>
                        <input type="text" name="whatsapp" class="form-control form-control-sm"
                            placeholder="Nomor Konfirmasi" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
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
