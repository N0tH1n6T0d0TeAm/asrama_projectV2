@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <img src="{{asset('https://www.worldphoto.org/sites/default/files/default-media/Piercy.jpg')}}" alt="" class="img-fluid">
    </div>
    <div class="col-sm-8">
        <div class="container">
            <h3>{{$siswa->nama_siswa}}</h3>
            <table class="table">
                <tr>
                    <th>Kelas</th>
                    <td>{{$siswa->kelasdanjurusan()}}</td>
                </tr>
                <tr>
                    <th>Tempat Tanggal Lahir</th>
                    <td>{{$siswa->tempat_lahir}} {{$siswa->tanggal_lahir}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{$siswa->jenis_kelamin == "P" ? "Perempuan" : "Laki-laki"}}</td>
                </tr>
            </table>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil Lengkap</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sikap Positif</button>
                  <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="overflow-y: scroll; max-height: 300px">
                   <div class="card mt-3">
                    <div class="card-body px-0 py-0">
                        <div class="responsive-table px-0 py-0">
                            <table class="table px-0 py-0">
                                <tr>
                                    <th class="text-center" colspan="2">Data Pribadi</th>
                                </tr>
                                <tr>
                                    <th>NIS</th>
                                    <td>{{$siswa->nis}}</td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td>{{$siswa->nisn}}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{$siswa->detail->nik}}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{$siswa->agama}}</td>
                                </tr>
                                <tr>
                                    <th>Hobi</th>
                                    <td>{{$siswa->detail->hobi}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">Data Orang Tua</th>
                                </tr>
                                <tr>
                                    <th>Nama Ayah</th>
                                    <td>{{$siswa->detail->nama_ayah}}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah</th>
                                    <td>{{$siswa->pekerjaan_ayah}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Ayah</th>
                                    <td>{{$siswa->alamat_ayah}}</td>
                                </tr>
                                <tr>
                                    <th>No.Telp Ayah</th>
                                    <td>{{$siswa->telp_ayah}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <td>{{$siswa->detail->nama_ibu}}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu</th>
                                    <td>{{$siswa->pekerjaan_ibu}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Ibu</th>
                                    <td>{{$siswa->alamat_ibu}}</td>
                                </tr>
                                <tr>
                                    <th>No.Telp Ibu</th>
                                    <td>{{$siswa->telp_ibu}}</td>
                                </tr>
                                <tr>
                                    <th>Nama Wali</th>
                                    <td>{{$siswa->detail->nama_wali}}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu</th>
                                    <td>{{$siswa->pekerjaan_wali}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Ibu</th>
                                    <td>{{$siswa->alamat_wali}}</td>
                                </tr>
                                <tr>
                                    <th>No.Telp Ibu</th>
                                    <td>{{$siswa->telp_wali}}</td>
                                </tr>
                                <tr>
                                    <th>Hubungan dengan Wali</th>
                                    <td>{{$siswa->hub_Wali}}</td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">Alamat Lengkap Siswa</th>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>{{$siswa->alamat->alamat}}</th>
                                </tr>
                                <tr>
                                    <th>RT/RW</th>
                                    <th>{{$siswa->alamat->rt}}/{{$siswa->alamat->rw}}</th>
                                </tr>
                                <tr>
                                    <th>Dusun</th>
                                    <th>{{$siswa->alamat->dusun}}</th>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <th>{{$siswa->alamat->kelurahan}}</th>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>{{$siswa->alamat->kecamatan}}</th>
                                </tr>
                                <tr>
                                    <th>Kode Pos</th>
                                    <th>{{$siswa->alamat->kode_pos}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                   </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card mt-3">
                        <div class="card-body px-0 py-0">
                            <div class="responsive-table">
                                <table class="table">
                                    @foreach($catataneraport as $ce)
                                        <tr>
                                            <th colspan="2">Penilaian dari {{$ce->parent->penilai->name}}</th>
                                        </tr>
                                        @foreach($ce->aspek_dpg as $i => $adpg)
                                        <tr>
                                            <th>@if($i == 0) Aspek Yang dinilai @endif</th> 
                                            <th>{{$adpg->aspek4B->keterangan}}</th>
                                        </tr>
                                        @endforeach
                                        
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
              </div>
        </div>

    </div>
</div>
@endsection
