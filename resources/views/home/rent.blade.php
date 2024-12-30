<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">Transaksi Hari Ini {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}</div>
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
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $key)
                @php
                    $time = \Carbon\Carbon::parse($key->jam_mulai);
                    $selesai = $time->addHours($key->qty);
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $key->customer }}</td>
                    <td class="text-center">{{ $key->product->category->nama_kategori ?? '' }} - {{ $key->product->nama_produk ?? '' }}</td>
                    <td class="text-center">{{ $key->qty }} Jam</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($key->jam_mulai)->format('H:i') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($selesai)->format('H:i') }}</td>
                    <td class="text-center">
                        @if($key->payment=='sudah')
                            <span class="label label-success"><i class="fa fa-check"></i> Sudah</span>
                        @else
                        <span class="label label-warning"><i class="fa fa-refresh fa-spin"></i> Belum</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>