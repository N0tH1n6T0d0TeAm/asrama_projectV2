@extends('layouts.mastersiswa')
@section('content')
<div class="card">
    <div class="card-header">
        Masuk
    </div>
    <form action="{{route("siswa.register.store")}}" method="POST">
        @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
    </div>
    <div class="card-header">
        <button class="btn bg-gradient-primary" type="submit" >
            Buka Akun
        </button>
    </div>
</form>
</div>
@endsection