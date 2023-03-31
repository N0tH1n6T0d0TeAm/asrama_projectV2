@extends('layouts.master')
@section('title', 'DataSiswa')

@section('content')

<div class="container ">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="text" placeholder="Nama Siswa" class="form-control" name="nama">
                </div>
                <div class="col">
                    <select name="" id="" class="form-select">
                        @foreach($angkatan as $akt)
                            <option value="">{{$akt->id_angkatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="" id="" class="form-select">
                        @foreach($jurusan as $jrs)
                            <option value="{{$jrs->id_jurusan}}">{{$jrs->jurusan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center">
        @foreach($kelas as $i => $kls)
        <div class="col-md-4">
            @php
                $jumlahsiswa = $kls["jumlahsiswa"];
                $labelkelas = $i;
                $angkatan = $kls["angkatan"];
            @endphp

            @include('components.superApp.cardkelas')
        </div>
        @endforeach
    </div>

</div>



@endsection
