@extends('layouts.mastersiswa')
@section('title', 'Riwayat Konseling Saya')
@section('content')


<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">Riwayat Konseling saya</h6>
      </div>
      <div class="card-body">
        <ul class="list-group">
            @foreach($riwayat as $i => $rwt)
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm">{{$rwt->keterangan_siswa}}</h6>
                <span class="mb-2 text-xs">Hari/Tanggal: <span class="text-dark font-weight-bold ms-sm-2">{{getDates($rwt->detailjk->hari,$rwt->detailjk->jadwal->minggu,$rwt->detailjk->jadwal->bulan,$rwt->detailjk->jadwal->tahun,"hari")}} , {{getDates($rwt->detailjk->hari,$rwt->detailjk->jadwal->minggu,$rwt->detailjk->jadwal->bulan,$rwt->detailjk->jadwal->tahun)}}</span></span>
                <span class="mb-2 text-xs">Jam: <span class="text-dark ms-sm-2 font-weight-bold">{{$rwt->detailjk->dari}} - {{$rwt->detailjk->sampai}}</span></span>
                <span class="mb-2 text-xs">Konselor: <span class="text-dark ms-sm-2 font-weight-bold">{{$rwt->detailjk->jadwal->konselor->name}}</span></span>
               <span class="mb-2 text-xs">Status: <span class="badge {{renderStatusReservasi($rwt->status)}}">{{$rwt->status}}</span></span>
               @if($rwt->status == 'Reschedule') <span class="text-xs">Keterangan Reschedule: <span class="text-dark ms-sm-2 font-weight-bold">{{$rwt->detailjk->keterangan_reschedule}}</span></span>@endif
              </div>
              <div class="ms-auto text-end">
                @if($rwt->status=="Dipesan" or $rwt->status=="Reschedule")
                <a class="btn btn-link text-danger btn-batalkan text-gradient px-3 mb-0" href="javascript:;" data-id="{{$rwt->id_bk}}"><i class="far fa-trash-alt me-2"></i>Batalkan</a>
                @endif
              </div>

            </li>
            @endforeach
        </ul>
      </div>
</div>




@endsection

@push("js")
<script>
    $(document).ready(function() {
        $(".btn-batalkan").click(function() {
            var id = $(this).data("id")
            Swal.fire({
                title: 'Apakah anda ingin membatalkan konseling?'
                , showCancelButton: true
                , confirmButtonText: 'Batalkan'
                ,cancelButtonText: "Tutup"
                , denyButtonText: `Don't save`
            , }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('siswa.batalkonseling')}}",
                        data: {
                            id: id
                        },
                        type: "get",
                        success: function(){
                            window.location = "{{route('siswa.riwayatkonseling')}}";
                        },
                        error: function(err){
                            alert(err.responseText);
                        }
                    })
                }
            })
        })
    })

</script>
@endpush
