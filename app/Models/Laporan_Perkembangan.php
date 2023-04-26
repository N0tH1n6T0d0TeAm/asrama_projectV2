<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Perkembangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_perkembangan';
    protected $primaryKey = 'id_perkembangan';

    public function pengguna(){
        return $this->belongsTo(User::class,"id_pengguna");
    }

    public function kategori(){
        return $this->belongsTo(KategoriMasalah::class,"id_kategori");
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class,'nis_siswas');
    }
}