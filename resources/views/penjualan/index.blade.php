@extends('home')
@section('content')
@section('title','Daftar Penjualan')
<div class="col-lg-12 mb-4 order-0">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Penjualan
 </button>
   
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Form tambah penjualan</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="/tambahpelanggan" method="POST">
             @csrf
             <div class="modal-body">
                 <div class="row mt-2">
                     <div class="col">
                        <div class="table-responsive text-nowrap">
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
                                    <a href="{{ route('transaksi', $item->PelangganID) }}" class="btn btn-warning">Pilih</a>
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
</div>
<table class="table shadow mt-2">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">No Nota</th>
        <th scope="col">Nominal</th>
        <th scope="col">Pelanggan</th>
        <th scope="col">Daftar Produk</th>
        <th scope="col">Aksi</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        @forelse ($penjualan as $item)          
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->KodePenjualan }}</td>
            <td>{{ $item->TotalHarga }}</td>
            <td>{{ $item->PelangganID }}</td>
            <td></td>
            <td class="center">
            {{-- <form onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" action="{{ route('delete_pelanggan', $item->PelangganID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">HAPUS</button>
            </form> --}}
            <a href="{{ route('nota', $item->PenjualanID)}}" class="btn btn-primary">EDIT</a>
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