<div class="modal fade" id="modal_show" role="dialog" data-backdrop="static" style="padding:0;">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $judul }}</h4>
            </div>
            <form method="post" action="{{ route('payment.update', $cart->no_transaksi) }}" id="idForm">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <input type="hidden" name="payment" value="ok">
                    <table class="table table-stripped">
                        <tr>
                            <td width="30%">No Transaksi</td>
                            <td width="5%">:</td>
                            <td>{{ $cart->no_transaksi }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($cart->tanggal)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td>:</td>
                            <td>{{ $cart->customer }}</td>
                        </tr>
                        <tr>
                            <td>Product</td>
                            <td>:</td>
                            <td>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($dataCart as $key)
                                    @php
                                        $total += $key->total;
                                    @endphp
                                    <li style="display: block;"><i class="fa fa-tag"></i> {{ $key->produk->nama_produk ?? '' }} | Qty: {{ $key->qty }} | Harga : {{ number_format($key->harga, 0, ',', '.') }}</li>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td>
                                {{ number_format($total, 0, ',', '.') }}
                                <input type="hidden" name="total_harga" value="{{ $total }}" id="hargaTotal">
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
                    <input type="hidden" name="tanggal" value="{{ $cart->tanggal }}">
                    <button type="submit" class="btn btn-sm btn-primary" disabled><i class="fa fa-save"></i>
                        Bayar Sekarang</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                            class="fa fa-times"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="bayar"]').on('input', function() {
            
            var bayar = parseInt($(this).val());
            var totalHarga = parseInt($('#hargaTotal').val());

            // Handle empty input case
            if (isNaN(bayar)) {
                $('input[name="kembalian"]').val('');
                $('button[type="submit"]').prop('disabled', true);
                return; // Exit the function if bayar is empty
            }

            var kembalian = bayar - totalHarga;

            if (!isNaN(kembalian)) {
                $('input[name="kembalian"]').val(kembalian);
            } else {
                $('input[name="kembalian"]').val('');
            }

            if (kembalian >= 0) {
                $('button[type="submit"]').prop('disabled', false);
            } else {
                $('button[type="submit"]').prop('disabled', true);
            }
        });
    });
</script>
