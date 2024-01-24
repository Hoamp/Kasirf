@extends('home')
@section('title','Update Produk')
@section('content')

  <div class="col-md-12 grid-margin stretch-card">
      <div class="card shadow">
        <div class="card-body">
          <p class="card-description">
            Form update produk
          </p>
          <form class="forms-sample" action=" {{ route('updateproduk', $produk->ProdukID)}}" method="POST">
          @csrf
          @method ('PUT')
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Kode produk</span>
            </div>
            <input type="text" name ="kode" value="{{ old('kode', $produk->KodeProduk) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Nama produk</span>
            </div>
            <input type="text" name ="nama" value="{{ old('nama', $produk->NamaProduk) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Harga</span>
            </div>
            <input type="number" name ="harga" value="{{ old('harga', $produk->Harga) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Stok</span>
            </div>
            <input type="number" name ="stok" value="{{ old('stok', $produk->Stok) }}"  class="form-control">
          </div>
          
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-info ms-2">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection