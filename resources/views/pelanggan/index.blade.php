@extends('home')
@section('content')
@section('title','Daftar Pelanggan')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
   + Daftar Pelanggan
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form tambah pelanggan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/tambahpelanggan" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="nama" class="form-label">Nama pelanggan</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan nama pelanggan...">
                </div>
                <div>
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat"  placeholder="Masukan alamat...">
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="telp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukan no telepon...">
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
        <th scope="col">Nama pelanggan</th>
        <th scope="col">Alamat</th>
        <th scope="col">No Telepon</th>
        <th scope="col">Aksi</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        @forelse ($pelanggan as $item)          
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->NamaPelanggan }}</td>
            <td>{{ $item->Alamat }}</td>
            <td>{{ $item->NomorTelepon }}</td>
            <td class="center">
              <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('delete_pelanggan', $item->PelangganID) }}" method="POST">
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