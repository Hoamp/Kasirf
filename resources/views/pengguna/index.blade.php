@extends('home')
@section('content')
@section('title','Daftar Pengguna')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
   + Pengguna
</button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form tambah pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/tambahpengguna" method="POST">
            @csrf
            <div class="modal-body">
                <div>
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukan nama...">
                </div>
                <div>
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username"  placeholder="Masukan username...">
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password...">
                        </div>
                    </div>
            
                    <div class="col">
                        <div class="form-group">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-control" id="level" name="level">
                                <option value="Administrator">Administrator</option>
                                <option value="Kasir">Kasir</option>
                            </select>
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
        <th scope="col">Nama</th>
        <th scope="col">Username</th>
        <th scope="col">Level</th>
        <th scope="col">Aksi</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        @forelse ($pengguna as $item)          
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->level }}</td>
            <td class="center">
              <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('delete', $item->id) }}"" method="POST">
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
    </tbody>
  </table>
  <script>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
  </script>

@endsection