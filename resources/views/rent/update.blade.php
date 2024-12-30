<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('rent.update',$rent->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" value="{{ $rent->tanggal }}" name="tanggal" placeholder="Tanggal" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" value="{{ $rent->customer }}" name="customer" placeholder="Nama Customer" required>
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
                                    <option value="{{ $key->id }}" {{ ($rent->product->kategori_id==$key->id) ? "selected" : "" }}>{{ $key->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product</label>
                                <select name="produk" id="produk-id" class="form-control" required>
                                    <option value="" selected disabled>Pilih</option>
                                    @foreach($product as $key)
                                    <option value="{{ $key->id }}" class="{{ $key->kategori_id }}" {{ ($rent->produk_id==$key->id) ? "selected" : "" }}>{{ $key->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="{{ $rent->jam_mulai }}" class="form-control form-control-sm"
                            placeholder="Jam Mulai" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>Qty<sup>Jam</sup></label>
                        <input type="number" name="qty" value="{{ $rent->qty }}" class="form-control form-control-sm"
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
