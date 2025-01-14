<div class="modal fade" id="modal_show" role="dialog" data-backdrop="static" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('rent.update', $rent->id) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <input type="hidden" name="payment" value="ok">
                    <table class="table table-stripped">
                        <tr>
                            <td width="30%">Tanggal</td>
                            <td width="5%">:</td>
                            <td>{{ \Carbon\Carbon::parse($rent->tanggal)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td>:</td>
                            <td>{{ $rent->customer }}</td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>:</td>
                            <td>{{ $rent->product->category->nama_kategori ?? '' }} -
                                {{ $rent->product->nama_produk ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Harga /Jam</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($rent->harga_perjam, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Lama Sewa</td>
                            <td>:</td>
                            <td>{{ $rent->qty }} Jam</td>
                        </tr>
                        <tr>
                            <td>Open Billing</td>
                            <td>:</td>
                            <td>
                                <select name="open_billing" onchange="billing()" id="open_billing" class="form-control">
                                    <option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td>
                                <span id="tidak-billing">Rp.
                                    {{ number_format($rent->harga_setelah_diskon, 0, ',', '.') }}</span>
                                <div id="ya-billing">
                                    <input type="number" name="total_harga" id="total_harga"
                                        value="{{ $rent->harga_setelah_diskon }}" class="form-control"
                                        placeholder="Total Harga">
                                </div>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Uang</td>
                            <td>:</td>
                            <td>
                                <input type="number" name="bayar" class="form-control" placeholder="Uang" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Kembalian</td>
                            <td>:</td>
                            <td><input type="number" name="kembalian" class="form-control" placeholder="Kembalian"
                                    readonly></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" disabled><i class="fa fa-save"></i>
                        Bayar Sekarang</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function billing() {
        var openBilling = $('#open_billing').val();
        var totalHarga = $('#total_harga').val();

        if (openBilling == 'ya') {
            $('#tidak-billing').hide();
            $('#ya-billing').show();
        } else {
            $('#tidak-billing').show();
            $('#ya-billing').hide();
            $('#total_harga').val(totalHarga); 
        }
    }

    $(document).ready(function() {
        billing(); // Initial state for open_billing

        $('input[name="bayar"]').on('input', function() {
            var bayar = parseInt($(this).val());
            var totalHarga = parseInt($('#total_harga').val()); 
            var kembalian = bayar - totalHarga;

            if (!isNaN(kembalian)) {
                $('input[name="kembalian"]').val(kembalian);
            } else {
                $('input[name="kembalian"]').val(''); 
            }

            // Enable/disable submit button based on kembalian
            if (kembalian >= 0) {
                $('button[type="submit"]').prop('disabled', false);
            } else {
                $('button[type="submit"]').prop('disabled', true);
            }
        });
    });
</script>
