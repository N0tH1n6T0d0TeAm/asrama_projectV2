@extends('layouts.mastersiswa')
@section('content')
<div class="row">
    @foreach($riwayat as $i => $rwt)
    <div class="col-md">
        <div class="card">
            <div class="card-header d-inline">
                <h5>{{$rwt->tanggal}}</h5><span class="badge {{renderStatusReservasi($rwt->status)}}">{{$rwt->status}}</span>
            </div>
            <div class="card-body py-0">
                <p>{{$rwt->keterangan}}</p>
            </div>
            <div class="card-footer py-1">
                <button class="btn  bg-gradient-danger"><i class="fa fa-trash"></i>Batalkan</button>
            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection
