<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">Filter</div>
    </div>
    <div class="panel-body">
        <form method="get">
            <div class="row">
                <div class="col-md-5">
                    <select class="form-control" placeholder="Nama Perusahaan" name="rs" id="rs" required>
                        <option value="" selected disabled>Pilih Perusahaan</option>
                        @foreach ($dataPerusahaan as $key)
                            <option value="{{ $key->id }}" {{ ($rsId==$key->id) ? "selected" : "" }}>{{ $key->nama_rs }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>

</div>
@push('js')
    <script>
        $('#rs').select2();
    </script>
@endpush
