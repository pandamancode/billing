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
                            <td width="25%">Tanggal</td>
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
                                    <input type="number" name="total_harga_billing" id="total_harga_billing"
                                        value="{{ $rent->harga_setelah_diskon }}" class="form-control"
                                        placeholder="Total Harga">
                                </div>
                                <input type="hidden" name="total_harga" class="form-control"
                                    value="{{ $rent->harga_setelah_diskon }}">
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
    $('#tidak-billing').show();
    $('#ya-billing').hide();

    function billing() {
        var status = $('#open_billing').find(":selected").val();
        if (status == 'ya') {
            $('#tidak-billing').hide();
            $('#ya-billing').show();
            updateTotalHargaBilling();
        } else {
            $('#tidak-billing').show();
            $('#ya-billing').hide();
        }
    }

    //document.addEventListener("DOMContentLoaded", function () {
    // Pastikan fungsi berjalan setelah modal terbuka
    $('#modal_show').on('shown.bs.modal', function() {
        // Ambil elemen input berdasarkan name
        const totalHargaInput = document.querySelector("input[name='total_harga']");
        var totalHargaBillingInput = document.querySelector("input[name='total_harga_billing']");
        const bayarInput = document.querySelector("input[name='bayar']");
        const kembalianInput = document.querySelector("input[name='kembalian']");
        const submitButton = document.querySelector("button[type='submit']");

        const status = $('#open_billing').find(":selected").val();

        function updateButtonState() {
            const kembalian = parseFloat(kembalianInput.value);
            if (kembalian >= 0) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function updateTotalHargaBilling() {
            const hargaBilling = $('#total_harga_billing').val();

            totalHargaBillingInput.value = hargaBilling; // Update nilai total_harga_billing
        }

        if (status == 'ya') {
            
            // Tambahkan event listener ke input bayar
            bayarInput.addEventListener("input", function() {
                updateTotalHargaBilling();
                // Ambil nilai total harga dan bayar
                const totalHarga = parseFloat(totalHargaInput.value) || 0; // Default ke 0 jika kosong
                const totalHargaBilling = parseFloat(totalHargaBillingInput.value) || 0;
                const bayar = parseFloat(bayarInput.value) || 0;

                // Hitung kembalian
                let kembalian = bayar - totalHargaBilling;

                // Tampilkan hasil di input kembalian
                //kembalianInput.value = kembalian >= 0 ? kembalian : 0;
                kembalianInput.value = kembalian;
                updateButtonState();
            });
        } else {
            // Tambahkan event listener ke input bayar
            bayarInput.addEventListener("input", function() {
                // Ambil nilai total harga dan bayar
                const totalHarga = parseFloat(totalHargaInput.value) || 0; // Default ke 0 jika kosong
                const totalHargaBilling = parseFloat(totalHargaBillingInput.value) || 0;
                const bayar = parseFloat(bayarInput.value) || 0;

                // Hitung kembalian
                let kembalian = bayar - totalHarga;

                // Tampilkan hasil di input kembalian
                //kembalianInput.value = kembalian >= 0 ? kembalian : 0;
                kembalianInput.value = kembalian;
                updateButtonState();
            });
        }
        updateButtonState();
    });
</script>
