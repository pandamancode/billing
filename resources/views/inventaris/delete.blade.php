<div class="modal fade modal-alert modal-warning in" id="modal_show" data-backdrop="static" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><i class="fa fa-warning"></i></div>
            <div class="modal-title">Non-Aktifkan Aset Ini?</div>
            <div class="modal-body">Klik Button OK untuk Non-Aktifkan data.</div>
            <div class="modal-footer">
                <form method="post" action="{{ route('inventaris.destroy', $dataAset->id) }}" id="idForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>
