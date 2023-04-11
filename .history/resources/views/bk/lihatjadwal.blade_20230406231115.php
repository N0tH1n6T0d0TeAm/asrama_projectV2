@extends('layouts.master')
@section("title","Lihat Jadwal")
@section('branch1', 'Guru BK')
@section('branch2', 'Lihat Jadwal')
@section('content')
<form action="{{route('bk.updatejadwal')}}" method="POST">
    @method('put')
    @csrf
    <div class="card">
        <div class="card-header">
            <h4>{{$jadwalkonseling["jadwal_konseling"]->keterangan}}</h4>
        </div>
        <div class="card-body">
            <input type="hidden" value="{{$jadwalkonseling["jadwal_konseling"]->id_jk}}" name="id_jk" required>
            <div class="form-group">
                <label for="" class="form-label">
                    Keterangan
                </label>
                <input type="text" name="keterangan" class="form-control" value="{{$jadwalkonseling["jadwal_konseling"]->keterangan}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">
                    Bulan
                </label>
                <select name="bulan" id="" class="form-control">
                    @foreach(bulans() as $i => $bln)
                    <option value="{{$i+1}}" @if($i+1==$jadwalkonseling["jadwal_konseling"]->bulan) selected @endif>{{$bln}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="form-label">
                    Minggu Ke
                </label>
                <input type="number" name="minggu" class="form-control" value="{{$jadwalkonseling["jadwal_konseling"]->minggu}}">
            </div>
            <div class="table-responsive">
                <div class="container">
                    <div class="row">
                        @foreach($jadwalkonseling["detail"] as $i=> $jk)
                        <div class="col">{{getDayName($i)}}</div>
                        @endforeach
                    </div>
                </div>
                @for($j = 0;$j < 5;$j++) <tr class="field-input-jam">
                    @foreach($jadwalkonseling["detail"] as $k => $jk)
                    @if(isset($jk[$j]))
                    <div class="p-3 col=1 @if($jk[$j]->bookedby_count > 0) border-booked @endif" data-status="{{$jk[$j]->bookedby_count > 0 ? "booked" : "ready"}}" data-html="true" data-html="true">
                        
                    </div>
                    @else
                    <div class="col-1">

                    </div>
                    @endif
                    @endforeach
                    </tr>
                    @endfor
            </div>
            <div class="container">
                <table class="table">
                    <tr>
                        <th>Siswa yang konseling minggu ini</th>
                        <td>
                            <div class="avatar-group mt-2">
                                @foreach($siswa as $j => $sws)
                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$sws->nama_siswa}}">
                                    <img src="{{$sws->getimageurl()}}" alt="team1" style="height: 50px; width: 70px">
                                </a>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-warning btn-edit"><i class="fa fa-edit"></i></button>
                <button type="submit" class="btn btn-warning btn-update"><i class="fa fa-send"></i>Perbarui</button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modal-reschedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atur Ulang Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('bk.editdetailjadwal')}}" method="POST">
                @method('put')
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="" class="form-label">
                            Atur Ulang Hari
                        </label>
                        <input type="hidden" value="" class="id-field" name="id_djk">
                        <select name="hari" id="hari-select" class="form-control">
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Atur Ulang Jam</label>
                        <div class="row">
                            <div class="col"><label for="" class="form-label">Dari</label></div>
                            <div class="col"><label for="" class="form-label">Sampai</label></div>
                        </div>
                        <div class="row">
                            <div class="col"><input type="time" class="form-control dari-field" name="dari"></div>
                            <div class="col"><input type="time" class="form-control sampai-field" name="sampai"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan_reschedule" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-reserv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Akhiri Konseling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('bk.selesaireservasi')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="id-bk" name="id_bk" required>
                    <div class="form-group">
                        <label for="
                " class="form-label">Tempat Konseling</label>
                        <input type="text" class="form-control" name="tempat" required>
                    </div>
                    <div class="form-group">
                        <label for="
                " class="form-label">Pendekatan Yang Digunakan</label>
                        <input type="text" class="form-control" name="pdg" required>
                    </div>
                    <div class="form-group">
                        <label for="
                " class="form-label">Proses Konseling</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push("js")
<script>
    $(document).ready(function() {
        $(".btn-update").hide();
        var selectedElement = null;
        var modalres = new bootstrap.Modal($("#modal-reschedule"));
        var modalreserv = new bootstrap.Modal($("#modal-reserv"));

        $(".btn-edit").click(function() {
            $(".btn-update").toggle();
            $(".jam-field").attr("readonly", function(index, attr) {
                if ($(this).closest("td").data("status") == "ready") {
                    return attr == "readonly" ? null : "readonly";
                }

            })
        })


        $("td[data-status=booked]").click(function() {
            var cardinfo = $(this).find(".card-info")


            cardinfo.toggle("fast")
        })

        $(".btn-edit-jadwal").click(function(e) {
            e.stopPropagation();

            $.ajax({
                url: "{{route('bk.getdetailjadwal')}}"
                , data: {
                    id: $(this).val()
                }
                , type: "get"
                , dataType: "json"
                , success: function(data) {
                    $("#hari-select").children("option").each(function() {
                        if ($(this).attr("value") == data["hari"]) {
                            $(this).attr("selected", "selected")
                        }
                    })

                    $(".id-field").val(data["id_djk"])
                    $(".dari-field").val(data["dari"])
                    $(".sampai-field").val(data["sampai"])

                    modalres.show();
                }
                , error: function(err) {
                    alert(err.responseText);
                }
            })
        })


        $(".btn-reserv-jadwal").click(function(e) {
            e.stopPropagation();
            $(".id-bk").val($(this).data('idb'));
            modalreserv.show();

        })
    })

</script>

@endpush
