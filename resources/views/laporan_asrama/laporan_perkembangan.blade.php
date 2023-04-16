@extends('layouts.master')
@section('content')
    <div class="container ">
    <div class="card mb-3">
        <form action="{{route('carisiswa')}}" method="GET">
        <div class="card-header pb-2">
            <h5>Filter</h5>
        </div>
        <div class="card-body pt-0">
            <div class="row mb-3">
                <div class="col-6">
                    <input type="text" placeholder="Nama Siswa" class="form-control" name="nama">
                </div>
                <div class="col-3">
                    <select class="form-select">
                        <option>Angkatan</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                 <div class="col-3">
                    <select class="form-select">
                        <option>Jurusan</option>
                        @foreach($data2 as $t)
                        <option>{{$t->jurusan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row py-0">
                <div class="col">
                    <button class="btn btn-primary">Cari</button>
                </div>
                </div>
        </form>
        </div>
    </div>

    <div class="row">
    <div class="col-md-3 p-3">
        <div class="card" style="width: 18rem;">
            <img src="https://photowhoa.com/2015/wp-content/uploads/2016/08/photo-1523913507744-1970fd11e9ff.jpg" class="card-img-top" alt="..." style="object-fit: cover; height: 20rem">
            <div class="card-body">
              <h5 class="card-title">Miki</h5>
              <p class="card-text">12 RPL | A-10</p>
              <a href="" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
    </div>
</div>

</div>
@endsection