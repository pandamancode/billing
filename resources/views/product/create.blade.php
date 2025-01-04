<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('product.store') }}" id="idForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="kategori" id="kategori_id" onchange="pilihKategori()" class="form-control" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach($category as $key)
                            <option value="{{ $key->id }}">{{ $key->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product</label>
                        <input type="text" name="produk" class="form-control form-control-sm"
                            placeholder="Nama Produk" autocomplete="off" required>
                    </div>

                    <div class="form-group" id="modal">
                        <label>Modal</label>
                        <input type="number" name="modal" class="form-control form-control-sm"
                            placeholder="Harga Modal" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="harga" class="form-control form-control-sm"
                            placeholder="Harga" autocomplete="off" required>
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
<script>
    $('#modal').hide();
    function pilihKategori() {
        var pilih = $('#kategori_id').val();
        if (pilih == '1') {
            $('#modal').show();
        } else {
            $('#modal').hide();
        }
    }
</script>