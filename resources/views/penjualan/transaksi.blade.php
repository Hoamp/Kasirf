@extends('home')
@section('content')
@section('title','Daftar Penjualan')
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <p class="card-description">
              Pilih produk yang akan dijual
            </p>
            <h4 class="card-description">
                #{{ $nota }}
            </h4>
            <input type="hidden" name="PelangganID" value="{{ $PelangganID }}">
            <div>
                <label class="form-label">Nota</label>
                <input type="text" class="form-control" name="KodePenjualan" value="{{ $nota }}" readonly>
            </div>
            <div>
                <label class="form-label">Nama pelanggan</label>
                <input type="text" class="form-control" name="KodePenjualan" value="{{ $namapelanggan }}" readonly>
            </div>
            <form action="{{ route('tambahkeranjang', ['PelangganID' => $PelangganID]) }}" method="POST">
                @csrf
                <div>
                    <label for="" class="form-label">Nama produk</label>
                    <input type="hidden" name="kode_penjualan" value="{{ $nota }}">
                    <select name="produk_id" id="" class="form-control">
                        @foreach ($produk as $item)
                            <option value="{{ $item->ProdukID }}">{{ $item->NamaProduk }} - {{ $item->KodeProduk }} ( {{ $item->Stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah"  placeholder="Masukan jumlah..." required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mt-2">Tambah keranjang</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card shadow">
            <div class="card-body shadow">
                <p class="card-description">
                    Daftar produk yang dipilih
                </p>
                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode barang</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @forelse ($detail as $item)          
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->KodeProduk }}</td>
                                <td>{{ $item->NamaProduk }}</td>
                                <td>{{ $item->Jumlah }}</td>
                                <td>{{ $item->Harga }}</td>
                                <td>{{ rupiah($item->Jumlah * $item->Harga) }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('hapus', ['DetailID' => $item->DetailID, 'ProdukID' => $item->ProdukID]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $total += $item->Jumlah * $item->Harga; ?>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="alert alert-danger">
                                        Data Belum tersedia
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <tr>
                            <td colspan="5">Total Harga</td>
                            <td>{{ rupiah($total) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <form action="{{ route('bayar', $nota) }}" method="POST">
                        @csrf
                        <input type="hidden" name="PelangganID" value="{{ $PelangganID }}">
                        <input type="hidden" name="KodePenjualan" value="{{ $nota }}">
                        <input type="hidden" name="TotalHarga" value="{{ $total }}">
                        @if($detail->count() > 0)
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
