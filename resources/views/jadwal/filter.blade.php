<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">Filter</div>
    </div>
    <div class="panel-body">
        <form method="get">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" name="rs_id" id="rs_id" required>
                        <option value="" selected disabled>Pilih RS</option>
                        @foreach ($dataPerusahaan as $key)
                            <option value="{{ $key->id }}" {{ $rsId == $key->id ? 'selected' : '' }}>
                                {{ $key->nama_rs }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="maintener_id" id="maintener_id" required>
                        <option value="" selected disabled>Pilih Maintener</option>
                        @foreach ($dataMaintener as $key)
                            <option value="{{ $key->id }}" {{ $maintenerId == $key->id ? 'selected' : '' }}>
                                {{ $key->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
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
