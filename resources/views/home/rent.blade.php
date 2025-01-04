<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">Monitoring Data Sewa {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}</div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered" id="datatables">
            <thead>
                <tr class="bg bg-warning">
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Lama Sewa</th>
                    <th class="text-center">Mulai Pukul</th>
                    <th class="text-center">Selesai Pukul</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $key)
                @php
                    $time = \Carbon\Carbon::parse($key->jam_mulai);
                    $time2 = \Carbon\Carbon::parse($key->jam_mulai);
                    $selesai = $time->addHours($key->qty);
                    $zelesai = $time2->addHours($key->qty);
                    $limamenitLagi = $zelesai->subMinutes(5);
                    $now = \Carbon\Carbon::now();
                    if($now>=$limamenitLagi){
                        $style = "background-color:red;color:white;";
                    }else{
                        $style ="";
                    }
                @endphp
                <tr style="{{ $style }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $key->customer }}</td>
                    <td class="text-center">{{ $key->product->category->nama_kategori ?? '' }} - {{ $key->product->nama_produk ?? '' }}</td>
                    <td class="text-center">{{ $key->qty }} Jam</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($key->jam_mulai)->format('H:i') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($selesai)->format('H:i') }}</td>
                    <td class="text-center">
                        @if($key->payment=='sudah')
                            <span class="label label-success">Sudah</span>
                        @else
                        <span class="label label-warning">Belum</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($now>=$selesai)
                            <span class="label label-default"><i class="fa fa-check"></i> Selesai</span>
                        @else
                        <span class="label label-info"><i class="fa fa-refresh fa-spin"></i> Sedang Aktif</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>