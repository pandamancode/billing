<html>
<title>Laporan Rental</title>
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
            <td align="center"><strong style="font-size:13pt;">LAPORAN RENTAL</strong><br>{{ $caption }}</td>
            <td width="20%">&nbsp;</td>
        </tr>
    </table>
    <hr style="border: 1px solid #000;">
    <div style="text-align: right;">Tanggal Print : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</div>

    <table id="table" cellspacing="0">
        <tr style="background-color: #b8b9bb;">
            <td class="bottom" style="text-align: center;"><strong>No</strong></td>
            <td class="bottom" style="text-align: center;"><strong >Tanggal</strong></td>
            <td class="bottom"><strong>Customer</strong></td>
            <td class="bottom"><strong>Nama Produk</strong></td>
            <td class="bottom" style="text-align: center;"><strong>Lama /Jam</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Harga /Jam</strong></td>
            <td class="bottom" style="text-align: right;"><strong>Total</strong></td>
        </tr>
        @php
            $total =0;
        @endphp
        @foreach ($data as $key)
        @php
        $total += $key->harga_setelah_diskon;
        @endphp
            <tr>
                <td class="bottom" style="text-align: center;">{{ $loop->iteration }}</td>
                <td class="bottom" style="text-align: center;">{{ \Carbon\Carbon::parse($key->tanggal)->format('d/m/Y') }}</td>
                <td class="bottom">{{ $key->customer }}</td>
                <td class="bottom">{{ $key->product->nama_produk }}</td>
                <td class="bottom" style="text-align: center;">{{ $key->qty }}</td>
                <td class="bottom" style="text-align: right;">{{ number_format($key->harga_perjam, 0, ',', '.') }}</td>
                <td class="bottom" style="text-align: right;">{{ number_format($key->harga_setelah_diskon, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="bottom" colspan="6"><strong><em>Total</em></strong></td>
            <td class="bottom" style="text-align: right;"><strong><em>{{ number_format($total, 0, ',', '.') }}</em></strong></td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
