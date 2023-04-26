@extends('layouts.master')
@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<style>

 .overlay h2{
    font-size: 20px;
    margin-left: 5px;
}
.overlay{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.8);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 2148;
}
.overlay:target{
    visibility: visible;
    opacity: 1;
    transition: 0.3s ease-in-out;
}
.overlay .info input{
    margin: 5px 10px auto;
    width: 90%;
}
.overlay .info select{
    margin: 5px 10px auto;
    width: 90%;
}
.overlay .info label{
    margin-left: 5px;
}
.info .lol{
    position: fixed;
    margin: 5% 30% auto;
    background: #fff;
    width: 40%;
    border-radius: 3px;
    padding: 10px 0;
}
.lol button{
    float: right;
    margin: 10px;
}
a.keluar{
    float: right;
    color: black;
    text-decoration: none;
}


.info .lol .up_kats{
        width: 90%;
    }
    .info .lol .update{
        margin: -6.7% 19% auto;
    }
    .info .lol .hapus_kat{
        position: relative;
        top: -40px;
        margin: 0 85% auto;
    }

    @media(max-width: 400px){
         .info .lol .update{
            padding: 6px;
            position: relative;
            top: -1.2em;
        margin: -13% 22% auto;
    }
    .info .lol .hapus_kat{
        position: relative;
        top: -30px;
        padding: 6px;
        margin: -15% 82% auto;
    }
    }

    @media(max-width: 416px){
         .info .lol .update{
            padding: 6px;
            position: relative;
            top: -1.2em;
        margin: -13% 22% auto;
    }
    .info .lol .hapus_kat{
        position: relative;
        top: -30px;
        padding: 6px;
        margin: -15% 82% auto;
    }
    }

    @media(max-width: 281px){
         .info .lol .update{
            padding: 6px;
            position: relative;
            top: -1.2em;
        margin: -13% 22% auto;
    }
    .info .lol .hapus_kat{
        position: relative;
        top: -30px;
        padding: 6px;
        margin: -15% 82% auto;
    }
    }

</style>

<div class="card">
  <div class="card-header">
    <form action="/beri_catatan" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="ids" value="{{$data->id_perkembangan}}">
   <input type="text" value="{{$data->judul_buku}}" name="judul_buku" style="width: 50%" placeholder="Judul Catatan" class="form-control"> 
   <select class="form-control" name="id_kategori" style="width: 20%; float:right; margin-top: -40px;">
    <option value="">Kategori</option>
    @foreach ($data2 as $d)
    <option value="{{$d->id_kategori}}">{{$d->level_kategori}}</option>
    @endforeach
   </select>
   <br>
   <a href="/catatan_perkembangan/{{$data->id_perkembangan}}" class="btn btn-info">Kembali</a>
   {{-- <a href="#tambah_kategori" class="btn btn-success">Tambah Kategori</a>
   <a href="#edit_kategori" class="btn btn-warning">Edit Kategori</a> --}}
  </div>
  <div class="card-body">
   <textarea name="isi_buku" class="form-control" style="height: 50em" placeholder="Catatan Anda...">{{$data->isi_buku}}</textarea><br>
   <center>
   <button class="btn btn-success">Simpan</button>
   </center>
</form>
  </div>
</div>

{{-- <div id="tambah_kategori" class="overlay">
    <div class="info">
        <div class="lol">
    <form action="/tambah_kategori" method="POST">
    @csrf
    <h2>Tambah Kategori <a href="#" class="keluar">&times</a></h2>

    <hr style="border: 1px solid black;margin-top: -3px;">
    <label>Level</label><br>
    <select name="level_kategori" class="form-control">
        <option value="Positifz">Positif</option>
        <option value="Negatif">Negatif</option>
    </select>

    <label>Kategori</label><br>
    <input class="form-control" type="text" name="nama_kategori" placeholder="Kategori" required />

    <button class="btn btn-primary">Tambah</button>
    </form>
        </div>
    </div>
</div>

<div id="edit_kategori" class="overlay">
    <div class="info">
        <div class="lol">
    
    <h2>Edit Kategori <a href="/edit_catatan/{{$data->id_perkembangan}}" class="keluar">&times</a></h2>

    <hr style="border: 1px solid black;margin-top: -3px;">
    <label>Edit Kategori</label><br>
    <div class="alert alert-success d-none">Update Data Berhasil!</div>
    @foreach($data2 as $d)
     <input class="form-control up_kats inputs" style="width: 50%;" ids="{{ $d->id_kategori }}"  type="text" id="{{ $d->id_kategori }}" name="kategori" value="{{ $d->nama_kategori }}" placeholder="Kategori" required />
     <button class="btn btn-success update" id_kats="{{ $d->id_kategori }}"><i class="fa fa-check"></i></button> 
     <a href="#" class="btn btn-danger hapus_kat" id_h="{{ $d->id_kategori }}"><i class="fas fa-trash"></i></a><br>
    @endforeach
        </div>
    </div>
</div>

<script>
$('.update').click(function(){
    var ids = $(this).attr('id_kats');
    var lol2 = $('#'+ids).val();
    $.ajax({
        url : '/update_kategori/'+ids+'/'+lol2+'/',
        method: 'get',
        success: function(result){
            $('.alert-success').removeClass('d-none');
            setTimeout(function(){
                $('.alert-success').addClass('d-none');
            },3000);
        }
    })
})

$(document).on('click','.hapus_kat',function(e){
    e.preventDefault();
    var id_hapus = $(this).attr('id_h');
    swal({
        title: "Apakah Anda Ingin Menghapus Kategori Ini?",
        text: "Jika Anda Menghapus Data Ini Maka Data Ini Akan Hilang Selamanya!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((kategori_hapus) => {
        if(kategori_hapus){
            $.ajax({
                url: "/hapus_kategori/" +id_hapus,
                type: "DELETE",
                data:{
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    swal("Data Berhasil Dihapus",{icon: "success"});
                    window.location.reload();
                }
            })
        }else{
            swal("Data Anda Aman!",{icon: "info"});
        }
    })
})
</script> --}}
@endsection