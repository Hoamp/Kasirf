@extends('home')
@section('title','Update Pengguna')
@section('content')

  <div class="col-md-12 grid-margin stretch-card">
      <div class="card shadow">
        <div class="card-body">
          <p class="card-description">
            Form update pengguna
          </p>
          <form class="forms-sample" action=" {{ route('updatepengguna', $pengguna->id)}}" method="POST">
          @csrf
          @method ('PUT')
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Name</span>
            </div>
            <input type="text" name ="name" value="{{ old('name', $pengguna->name) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Username</span>
            </div>
            <input type="text" name ="username" value="{{ old('username', $pengguna->username) }}"  class="form-control">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Level</span>
            </div>
            <select name="level" class="form-control" >
              <option value="Administrator" <?php if($pengguna->level=='Administrator'){echo"selected";}?>>Administrator</option>
              <option value="Kasir" <?php if($pengguna->level=='Kasir'){echo"selected";}?>>Kasir</option>
            </select>
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