<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('produk.update',$dataProduk->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ $dataProduk->nama_produk }}" class="form-control form-control-sm"
                            placeholder="Nama Produk" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ $dataProduk->price }}" class="form-control form-control-sm"
                            placeholder="Price" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select name="kategori" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($kategoriProduk as $key)
                                <option value="{{ $key->id }}" {{ ($dataProduk->kategori_id==$key->id) ? 'selected' : '' }}>{{ $key->nama_kategori }}</option>
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
