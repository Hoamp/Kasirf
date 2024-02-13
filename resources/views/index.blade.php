@extends('home')
@section('content')
@section('title','Dashboard')
<div class="col-lg-12 ">
  <div class="card shadow ">
    <div class="card-body d-flex align-items-center ">
      <div>
        <h1 class="card-title text-info">Congratulations</h1>
        {{ auth()->user() }}
        <p>
          Hallo, Selamat datang admin! <span class="fw-bold"> </span> For more information, let see at
          your profile!
        </p>
      </div>
      <div class="ms-auto">
        <img src="/assets/images/products/work.png" width="250" class="img-fluid">
      </div>
    </div>
  </div>
</div>

@endsection