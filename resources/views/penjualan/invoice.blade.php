@extends('home')
@section('content')
@section('title','invoice')
    <div class="col-md-12 grid-margin stretch-card ">
        <div class="card shadow">
          <div class="card-body">
            <h4 class="card-description">Kasir sanjaya |   
            </h4>
          
          <div class="row mt-3">
              <div class="col-md-4">
                Form
                <address>
                    <strong>SANJAYA</strong><br>
                    Jl.Mjbanana no 483 Karanganyar <br>
                    Phone: 012345678 <br>
                    Email: Sanjaya@gmail.com <br>
                </address>
              </div>
              <div class="col-md-4" >
                To
                <address>
                    @if($penjualan->isNotEmpty())
                    <strong>{{ $penjualan->first()->NamaPelanggan }}</strong><br>
                    Contact person:   <strong>{{ $penjualan->first()->NomorTelepon }}</strong> <br>
                </address>
              </div>
              <div class="col-md-4" >
                <address>
                    <strong><h4>#<strong>{{ $penjualan->first()->KodePenjualan }}</strong><br></h4></strong><br>
                    @endif
                </address>
              </div>
          </div>

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
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; $no = 1; ?>
                    @forelse ($detail as $item)          
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->KodeProduk }}</td>
                            <td>{{ $item->NamaProduk }}</td>
                            <td>{{ $item->Jumlah }}</td>
                            <td>{{ $item->Harga }}</td>
                            <td>{{ rupiah($item->Jumlah * $item->Harga) }}</td>
                        </tr>
                        <?php $total += $item->Jumlah * $item->Harga; $no++; ?>
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
        </div>
        </div>
        <a href="/penjualan" class="btn btn-primary">Back</a>
    </div>
@endsection