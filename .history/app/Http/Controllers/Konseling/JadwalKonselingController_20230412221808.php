<?php

namespace App\Http\Controllers\Konseling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKonseling;

class JadwalKonselingController extends Controller
{
    public function hapus(Request $req){
        $jadwal = JadwalKonseling::find($req->id);
        $jadwal->delete();
    }
}
