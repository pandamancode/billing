<div class="modal fade" id="modal_show" role="dialog" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('user.store') }}" id="idForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" id="level" onchange="pilih_level()" class="form-control form-control-sm" required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="maintener">Maintener</option>
                            <option value="service">Service</option>
                            <option value="poli">Poli</option>
                            <option value="ipsrs">IPSRS</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>

                    <div class="form-group" id="perusahaan-form">
                        <label>Perusahaan</label>
                        <select class="form-control" name="rs" id="rs" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach ($dataPerusahaan as $key)
                                <option value="{{ $key->id }}">{{ $key->nama_rs }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="email" class="form-control form-control-sm"
                            placeholder="Username" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control form-control-sm"
                            placeholder="Nama" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control form-control-sm"
                            placeholder="Password" autocomplete="off" required>
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
    $('#perusahaan-form').hide();

    function pilih_level(){
        var level = $('#level').find(":selected").val();
        if(level=='poli' || level=='ipsrs' || level=='manager'){
            $('#perusahaan-form').show();
        }else{
            $('#perusahaan-form').hide();
        }
    }
 
    $('#rs').select2({
        width: '100%',
        dropdownParent: $("#modal_show")
    });
</script>