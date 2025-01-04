<style type="text/css">
    .page{
        height:200mm;
        width:44mm;
        page-break-after:always;
    }

    @media print {
      html, body{
        width: 48mm;
        height: 200mm;
      }
    }
</style>
<style type="text/css">
    .page{
        margin: 0px;
    }
</style>
<body onload="window.print()">
<div class="page">
<table width="100%" style="font-family: arial;font-size: 6pt;">
    <tr>
        <td style="border-bottom: 1px dashed;" align="center">
            <span style="color: black;">
                <b>{{ env('OUTLET') }}</b><br>
                {{ env('ADDRESS') }}
            </span>
        </td>
    </tr>
</table>

<table width="100%" style="font-family: arial;font-size: 6pt;">
    <tr>
        <td width="5%" style="border-bottom: 1px dashed;">No</td>
        <td style="border-bottom: 1px dashed;" colspan="2">{{ $payment->no_transaksi }}</td>
        <td style="border-bottom: 1px dashed;" align="right">{{ date('d-m-Y H:i',strtotime($payment->created_at)) }}</td>
    </tr>
</table>

<table width="100%" style="font-family: arial;font-size: 6pt;">
    @foreach($dataCart as $key)
        
    <tr>
        <td width="5%">{{ $loop->iteration }}.</td>
        <td colspan="3">{{ $key->produk->nama_produk ?? '' }}</td>
    </tr>
    <tr>
        <td width="10%">x{{ $key->qty }}</td>
        <td width="40%" align="right">{{ $key->harga }}</td>
        <td width="50%" align="right">{{ $key->total }}</td>
    </tr>
    @endforeach
</table>

<table width="100%" style="font-family: arial;font-size: 6pt;">
    <tr>
        <td width="60%" style="border-top: 1px dashed;"  align="right">Sub Total</td>
        <td width="10%" style="border-top: 1px dashed;"  align="center">:</td>
        <td width="30%" style="border-top: 1px dashed;"  align="right">{{ $payment->total_harga }}</td>
    </tr>
    <tr>
        <td width="60%" align="right">Bayar</td>
        <td width="10%" align="center">:</td>
        <td width="30%" align="right">{{ $payment->bayar }}</td>
    </tr>
    <tr>
        <td width="60%" style="border-bottom: 1px dashed;" align="right">Kembali</td>
        <td width="10%" style="border-bottom: 1px dashed;" align="center">:</td>
        <td width="30%" style="border-bottom: 1px dashed;" align="right">{{ ($payment->bayar - $payment->total_harga) }}</td>
    </tr>
</table>

<table width="100%" style="font-family: arial;font-size: 6pt;">
    <tr>
        <td align="center">Terimakasih Atas Kunjungan Anda</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 5pt;">Powered By <strong>Kalotech.</strong></td>
    </tr>
</table>
</div>
</body>