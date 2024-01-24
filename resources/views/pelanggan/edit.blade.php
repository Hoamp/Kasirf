@extends('home')
@section('title','Update Pelanggan')
@section('content')

  <div class="col-md-12 grid-margin stretch-card">
      <div class="card shadow">
        <div class="card-body">
          <p class="card-description">
            Form update pelanggan
          </p>
          <form class="forms-sample" action=" {{ route('updatepelanggan', $pelanggan->PelangganID)}}" method="POST">
          @csrf
          @method ('PUT')
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Nama pelanggan</span>
            </div>
            <input type="text" name ="nama" value="{{ old('nama', $pelanggan->NamaPelanggan) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Alamat</span>
            </div>
            <input type="text" name ="alamat" value="{{ old('alamat', $pelanggan->Alamat) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">No Telepon</span>
            </div>
            <input type="text" name ="telp" value="{{ old('telp', $pelanggan->NomorTelepon) }}"  class="form-control">
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