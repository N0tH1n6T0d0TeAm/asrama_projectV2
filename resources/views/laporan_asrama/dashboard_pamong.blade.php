@extends('layouts.master')
@section('title','Silahkan Lihat Tugas Anda!')
@section('content')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

@if($hitung == 0)

<div class="tugas" style="position: relative; top: 4em; font-size: 40px;">
<center>
    <i class="bi bi-list-task"></i> Tidak Ada Tugas
</center>
</div>

@else

@foreach($data as $d)



@php
        $sudah_dikerjakan = $d->isi->where('id_workspace',$d->isi->id_workspace)->where('status','Sudah Dikerjakan')->count();

        $dibatalkan = $d->isi->where('id_workspace',$d->isi->id_workspace)->where('status','Pending')->count();

        $belum_dikerjakan = $d->isi->where('id_workspace',$d->isi->id_workspace)->where('status','Belum Dikerjakan')->count();

        $total_data =  $sudah_dikerjakan + $d->isi->where('id_workspace',$d->isi->id_workspace)->where('status','Belum Dikerjakan')->count(); 

        $detail_tugas = $d->isi->where('id_workspace',$d->isi->id_workspace)->get();
        
   @endphp 


@if($d->isi->cek == 0)


<div class="card">
  <div class="card-header">
    {{tgl_indo($d->tanggal)}} 
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$d->tugas}}</h5>
    @if(round($sudah_dikerjakan / $total_data * 100) == 0) <p class="card-text" style="color:red">{{$d->isi->status}}</p> @elseif(round($sudah_dikerjakan / $total_data * 100) <= 99 || $dibatalkan) <p class="card-text" style="color:orange">On Going</p> @elseif($d->isi->status == "Tugas Dibatalkan") <p style="color: orange"><b style="color: green; font-weight: 700">Selesai!</b> Tetapi Ada Tugas Yang Dibatalkan</p> @else <p class="card-text" style="color:green">{{$d->isi->status}}</p> @endif
   

    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{round($sudah_dikerjakan / $total_data * 100)}}%; height: 500%;">{{round($sudah_dikerjakan / $total_data * 100)}}%

        </div>
    </div><br>

        
   <table style="width: 100%;text-align: center;">
                
                    <thead>
                        <th></th>
                        <th><label>Detail Tugas</label></th>
                        <th><label>Status</label></th>
                        <th><label>Deskripsi</label></th>
                        <th><label>Simpan Deskripsi</label></th>

                    @foreach ($detail_tugas as $d)
                    @if($d->status == "Sudah Dikerjakan")
                    <tbody>
                        <td><input type="checkbox" value="Belum Dikerjakan" class="form-checkbox check" id_asli="{{$d->id_workspace}}" id_check="{{$d->id_bagian}}" checked></td>
                        <td>{{$d->isi_tugas}}</td>
                        <td>{{$d->status}}</td>
                        <td><input type="text" name="deskripsi" id="{{$d->id_bagian}}" value="{{$d->deskripsi}}" class="form-control deskripsi" placeholder="Deskripsi Tugas"></td>
                        <td><a href="#" id_desk="{{$d->id_bagian}}" class="simpan_desk" style="color:green"><i class="fa fa-check"></i></a></td>
                    </tbody>
                    @elseif($d->status == "Pending")
                    <tbody style="color: orange;">
                        <td><input type="checkbox" value="Sudah Dikerjakan" class="form-checkbox check" id_asli="{{$d->id_workspace}}" id_check="{{$d->id_bagian}}" checked/></td>
                        <td>{{$d->isi_tugas}}</td>
                        <td>{{$d->status}}</td>
                        <td><input type="text" name="deskripsi" id="{{$d->id_bagian}}" value="{{$d->deskripsi}}" class="form-control deskripsi" placeholder="Kendala"></td>
                        <td><a href="#" id_desk="{{$d->id_bagian}}" class="dibatalkan" style="color:green"><i class="fa fa-check"></i></a></td>
                    </tbody>
                    @elseif($d->status == "Tugas Dibatalkan")
                    <tbody style="color: red;">
                        <td><input type="checkbox" value="Sudah Dikerjakan" class="form-checkbox check" id_asli="{{$d->id_workspace}}" id_check="{{$d->id_bagian}}" disabled/></td>
                        <td>{{$d->isi_tugas}}</td>
                        <td>{{$d->status}}</td>
                    </tbody>
                    @else
                    <tbody>
                        <td><input type="checkbox" value="Sudah Dikerjakan" class="form-checkbox check" id_asli="{{$d->id_workspace}}" id_check="{{$d->id_bagian}}" /></td>
                        <td>{{$d->isi_tugas}}</td>
                        <td>{{$d->status}}</td>
                        <td><input type="text" name="deskripsi" id="{{$d->id_bagian}}" value="{{$d->deskripsi}}" class="form-control deskripsi" placeholder="Kendala" ></td>
                        <td><a href="#" id_desk="{{$d->id_bagian}}" class="dibatalkan" style="color:green"><i class="fa fa-check"></i></a></td>
                    </tbody>
                    @endif
                    @endforeach
                </table><br>
     
    
    @if($belum_dikerjakan) @else <a href="#" class="ubah_status" id_bagian="{{$d->id_bagian}}" id_status="{{$d->id_workspace}}"><button class="btn btn-success">Bersihkan Tugas</button></a>  @endif
 @endif
  </div>
</div><br>
@endforeach
@endif

<script>

    $('.simpan_desk').click(function(){
    var ids = $(this).attr('id_desk');
    var lol2 = $('#'+ids).val();
    $.ajax({
        url : '/update_deskripsi/'+ids+'/'+lol2+'/',
        method: 'get',
        success: function(result){
            swal("Menambahkan Deskripsi Berhasil",{icon: "success"})
        }
    })
})

$('.dibatalkan').click(function(){
    var id_desk = $(this).attr('id_desk');
    var isi_desk = $('#'+id_desk).val();

    if(isi_desk == ""){
        swal("Error!","Masukan Deskripsi Anda Jika Terdapat Kendala!","error");
    }else{
        swal("Tugas Berhasil Dibatalkan!",{icon: "info"});
        window.location = '/update_status_deskripsi/'+id_desk+'/'+isi_desk+'/';
    }
    
})
  
$('.check').on('click',function(){
  var id_asli = $(this).attr('id_asli');
  var ids = $(this).attr('id_check');
  var inputs = $(this).val();

  
 window.location = '/update_detail/'+id_asli+ '/' + ids + '/' + inputs + '/';

})

$('.ubah_status').on('click',function(){
    var ids = $(this).attr('id_status');
    var id_bagian = $(this).attr('id_bagian');
    
     swal({
        title: "Apakah Anda Yakin?",
        text: "Ingin Membersihkan Tugas Ini Dari Halaman Anda?",
        icon: "warning",
        dangerMode: true,
        buttons: true,
    }).then((sudahSelesai) => {
        if(sudahSelesai){
            swal('Tugas Selesai',{icon: "success"});
            window.location = '/udah_selesai/' +ids+ '/';
        }else{
            swal("Pembersihan Dibatalkan",{icon: "info"});
        }
    })

   
})
</script>
@endsection