<?php

namespace App\Http\Controllers\Konseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKonseling;

class JadwalKonselingController extends Controller
{
    public function hapus(Request $req){
        $jadwal = JadwalKonseling::with(["detail_jk.bookedby"])->find("id_jk",$req->id);
        $jadwal->detail_jk->delete();
        $jadwal->detail_jk->delete();
    }
}
