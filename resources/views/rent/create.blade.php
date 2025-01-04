<div class="modal fade" id="modal_show" role="dialog" data-backdrop="static" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('rent.store') }}" id="idForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" name="tanggal" placeholder="Tanggal" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" name="customer" placeholder="Nama Customer" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="kategori" id="kategori-id" class="form-control" required>
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach($category as $key)
                                    <option value="{{ $key->id }}">{{ $key->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product</label>
                                <select name="produk" id="produk-id" onchange="pilihProduk()" class="form-control" required>
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach($product as $key)
                                    <option value="{{ $key->id }}" class="{{ $key->kategori_id }}">{{ $key->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control form-control-sm"
                            placeholder="Jam Mulai" autocomplete="off" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Qty<sup>Jam</sup></label>
                        <input type="number" name="qty" class="form-control form-control-sm"
                            placeholder="Berapa Jam?" autocomplete="off" required>
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
    $('#produk-id').chained("#kategori-id");
</script>