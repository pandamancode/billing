<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">List 10 Produk Terlaris</div>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="bg bg-warning">
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Kategori Produk</th>
                </tr>
            </thead>
            <tbody>
                @if (count($produkTerlaris) > 0)
                    @foreach ($produkTerlaris as $key)
                        @php
                            $produk = DB::table('produks')
                                ->join('kategoriproduks', 'kategoriproduks.id', '=', 'produks.kategori_id')
                                ->where('produks.id', $key->produk_id)
                                ->select('kategoriproduks.nama_kategori')
                                ->first();
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $key->produk->nama_produk }}</td>
                            <td>{{ $produk->nama_kategori ?? 'Uncategories' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3"><em>Tidak Ada Data!</em></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
