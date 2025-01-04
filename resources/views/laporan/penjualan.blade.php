<html>
<title>Laporan Penjualan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<style>
    body {
        margin: 1cm;
    }

    #table {
        width: 100%;
    }

    .full {
        border: 1px solid #000;
    }

    .top {
        border-top: 1px solid #000;
    }

    .right {
        border-right: 1px solid #000;
    }

    .bottom {
        border-bottom: 1px solid #000;
    }

    .left {
        border-left: 1px solid #000;
    }
</style>

<body>
    <table width="100%">
        <tr>
            <td width="20%"><!--img src="{{ asset('logo.png') }}" width="120px" alt="Logo"--></td>
            <td align="center"><strong style="font-size:13pt;">LAPORAN PENJUALAN</strong><br>{{ $caption }}</td>
            <td width="20%">&nbsp;</td>
        </tr>
    </table>
    <hr style="border: 1px solid #000;">
    <div style="text-align: right;">Tanggal Print : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</div>

    <table id="table" cellspacing="0">
        <tr style="background-color: #b8b9bb;">
            <td class="bottom" style="text-align: center;"><strong>No</strong></td>
            <td class="bottom" style="text-align: center;"><strong >Tanggal</strong></td>
            <td class="bottom" style="text-align: center;"><strong>No. Transaksi</strong></td>
            <td class="bottom"><strong>Nama Produk</strong></td>
            <td class="bottom" style="text-align: center;"><strong>Qty</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Harga Modal</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Harga Jual</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Total Modal</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Total Jual</strong></td>
        </tr>
        @php
            $total =0;
            $modalTotal = 0; 
        @endphp
        @foreach ($data as $key)
        @php
        $total += $key->total_harga;
            $cart = DB::table("carts")
                ->join("products","products.id","=","carts.id")
                ->where("carts.no_transaksi",$key->no_transaksi)
                ->select("products.nama_produk","carts.qty","carts.harga","carts.modal")
                ->get();
        @endphp
            <tr>
                <td class="bottom" style="text-align: center;">{{ $loop->iteration }}</td>
                <td class="bottom" style="text-align: center;">{{ \Carbon\Carbon::parse($key->tanggal)->format('d/m/Y') }}</td>
                <td class="bottom" style="text-align: center;">{{ $key->no_transaksi }}</td>
                <td class="bottom">
                    @foreach($cart as $r)
                    <li style="display:block;">{{ $r->nama_produk }}</li>
                    @endforeach
                </td>
                <td class="bottom" style="text-align: center;">
                    @foreach($cart as $r)
                    <li style="display:block;">{{ $r->qty }}</li>
                    @endforeach
                </td>
                <td class="bottom" style="text-align: right;">
                    
                    @foreach($cart as $r)
                    @php
                    $modalTotal += $r->modal; 
                    @endphp
                    <li style="display:block;">{{ number_format($r->modal, 0, ',', '.') }}</li>
                    @endforeach
                </td>
                <td class="bottom" style="text-align: right;">
                    @foreach($cart as $r)
                    <li style="display:block;">{{ number_format($r->harga, 0, ',', '.') }}</li>
                    @endforeach
                </td>
                <td class="bottom" style="text-align: right;">{{ number_format($modalTotal, 0, ',', '.') }}</td>
                <td class="bottom" style="text-align: right;">{{ number_format($key->total_harga, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="bottom" colspan="8"><strong><em>Total</em></strong></td>
            <td class="bottom" style="text-align: right;"><strong><em>{{ number_format($total, 0, ',', '.') }}</em></strong></td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
