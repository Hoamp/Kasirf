@extends('home')
@section('content')
@section('title','Daftar Produk')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
   + Daftar Produk
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form tambah produk</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/tambahproduk" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="nama" class="form-label">Nama produk</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama produk...">
                </div>
                <div>
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga"  placeholder="Masukan harga...">
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukan stok...">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="kode" class="form-label">Kode produk</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukan kode produk...">
                        </div>
                    </div>      
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    </div>
  </div>
<table class="table shadow mt-2">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode Produk</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Harga</th>
        <th scope="col">Stok</th>
        <th scope="col">Aksi</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        @forelse ($produk as $item)          
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->KodeProduk }}</td>
            <td>{{ $item->NamaProduk }}</td>
            <td>{{ $item->Harga }}</td>
            <td>{{ $item->Stok }}</td>
            <td class="center">
              <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('delete_product', $item->ProdukID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            
            </td>
        </tr>
        @empty
        <div class="alert alert-danger col-12">
            Data Belum tersedia
        </div> 
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
@endsection