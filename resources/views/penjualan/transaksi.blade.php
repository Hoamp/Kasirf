@extends('home')
@section('content')
@section('title','Daftar Penjualan')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card ">
        <div class="card shadow">
          <div class="card-body">
            <p class="card-description">
              Pilih produk yang akan dijual
            </p>
            <form action="{{ route('tambahkeranjang', 'PelangganID=> $pelangganId') }}" method="POST">
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
                        <input type="number" class="form-control" name="jumlah"  placeholder="Masukan jumlah...">
                    </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary mt-2">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <h4 class="card-description">
                #{{ $nota }}
            </h4>
            <form action="" method="POST">
                @csrf
                    <div>
                        <label class="form-label">Nota</label>
                        <input type="text" class="form-control" name="KodePenjualan" value="{{ $nota }}" readonly>
                        <input type="hidden" class="form-control" name="PelangganID" value="{{ $PelangganID }}" readonly>
                    </div>
                    <div>
                        <label class="form-label">Nama pelanggan</label>
                        {{-- <input type="hidden" class="form-control" name="PelangganID" value="{{ $PelangganID ->NamaPelanggan}}" readonly> --}}
                    </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary mt-2">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<div class="col-md-12 grid-margin stretch-card ">
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
            @forelse ($detail as $item)          
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->KodeProduk }}</td>
                    <td>{{ $item->NamaProduk }}</td>
                    <td>{{ $item->Jumlah }}</td>
                    <td>{{ $item->Harga }}</td>
                    <td>{{ $item->Jumlah * $item->Harga }}</td>
                    <td>
                        <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
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
          </tbody>
      </table>
      </div>
    </div>
</div>
@endsection