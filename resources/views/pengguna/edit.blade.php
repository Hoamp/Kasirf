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
            <div class="form-group mt-3">
              <label for="name">Name</label>
              <input type="text" name ="name" value="{{ old('name', $pengguna->name) }}"  class="form-control">
            </div>
            <div class="form-group mt-3">
              <label for="username">Username</label>
              <input type="text" name ="username" value="{{ old('username', $pengguna->username) }}"  class="form-control">
            </div>
            <div class="form-group mt-3">
              <label for="level">Level</label>
              <select name="level" class="form-control" >
                    <option value="Administrator">Administrator</option>
                    <option value="Kasir">Kasir</option>
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
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsi' );
</script>
@endsection