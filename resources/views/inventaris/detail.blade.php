<div class="modal fade" id="modal_show" role="dialog" data-backdrop="static" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('barang') }}/{{ $aset->foto }}" width="100%">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-stripped">
                            <tr>
                                <td width="30%">Faskes</td>
                                <td>: {{ $aset->rs->nama_rs ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Poliklinik</td>
                                <td>: {{ $aset->ruangan->nama_ruangan ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Nama Perangkat</td>
                                <td>: {{ $aset->barang->nama_barang ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Merk</td>
                                <td>: {{ $aset->barang->merk ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>SN</td>
                                <td>: {{ $aset->sn }}</td>
                            </tr>
                            <tr>
                                <td>Kondisi</td>
                                <td>:
                                    @if ($aset->kondisi == 'Layak Pakai')
                                        <span class="label label-success"><i class="fa fa-check"></i> Layak Pakai</span>
                                    @elseif($aset->kondisi == 'Butuh Tindakan')
                                        <span class="label label-warning"><i class="fa fa-warning"></i> Butuh Tindakan</span>
                                    @else
                                        <span class="label label-danger"><i class="fa fa-times"></i> Tidak Layak Pakai</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tahun Pembuatan</td>
                                <td>: {{ $aset->tahun_pembuatan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengadaan</td>
                                <td>: {{ date('d-m-Y', strtotime($aset->tanggal_pengadaan)) }}</td>
                            </tr>
                            <tr>
                                <td>No Izin</td>
                                <td>: {{ $aset->no_izin_edar }}</td>
                            </tr>
                            <tr>
                                <td>Riwayat Pemeliharaan</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td>Riwayat Perbaikan</td>
                                <td>:</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
