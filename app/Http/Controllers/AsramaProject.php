<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\isi_workspace;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\LaporanPost;
use App\Models\ModelRole;
use App\Models\Roles;
use App\Models\Siswa;
use App\Models\Laporan_Perkembangan;
use App\Models\KategoriMasalah;
use App\Models\ModelHasRoles;
use App\Models\Workspace;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Model;
use Image;
use IsiWorkspace;
use Kategori;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf as PdfDompdf;

class AsramaProject extends Controller
{

    public function tambah_laporan(Request $req)
    {
        $foto = array();
        foreach ($req->file('gambar') as $file) {
            $nama = $file->getClientOriginalName();

            $image =  Image::make($file);
            $image->save(public_path('postingan/' . $file->getClientOriginalName()), 50);
            $foto[] = $nama;
        }

        $tabel = new LaporanPost();
        $tabel->gambar = implode('|', $foto);
        $tabel->id_roles = $req->id_roles;
        $tabel->id_pengguna = $req->id_pengguna;
        $tabel->deskripsi = NULL;
        $tabel->nama_siswass = NULL;
        $tabel->save();


        return redirect()->route("asrama.laporanharian", ["id_saja" => $tabel->id_laporan]);
    }


    public function lihat_post($id)
    {
        $tabel = LaporanPost::find($id);
        $murid = Siswa::all();
        return view('laporan_asrama.postingan', ["data" => $tabel, "murid" => $murid]);
    }

    public function kembali_home($id)
    {
        $tabel = LaporanPost::find($id);

        $gambar = $tabel->gambar;

        $gambarArray = explode("|", $gambar);

        $folder = public_path('/postingan/');

        foreach ($gambarArray as $files) {
            if (file_exists($folder . $files)) {
                unlink($folder . $files);
            };
        };

        $tabel->delete();

        return redirect()->route('laporan_harian');
    }

    public function tambah_siswa(Request $req)
    {
        $ids = $req->idnya;
        $tabel = LaporanPost::find($ids);
        $tabel->deskripsi = $req->deskripsi;
        $tabel->nama_siswass = $req->tags;
        $tabel->update();
        return redirect('laporan_harian');
    }

    public function tampil_laporan_harian()
    {
        $tabel = LaporanPost::all();
        $tabel2 = ModelRole::where('model_id', auth()->user()->id)->get();
        return view('laporan_asrama.laporan_harian', ["datas" => $tabel, "datas2" => $tabel2]);
    }

    public function edit_post($id)
    {
        $tabel = LaporanPost::find($id);
        return response()->json([
            'status' => 200,
            'tampil' => $tabel,
        ]);
    }

    public function detail_siswa()
    {
        $tabel = Siswa::where('jenis_kelamin','L')->Where('status','aktif')->get();
        $tabel2 = Jurusan::all();
        $tabel3 = Angkatan::all();
        return view('laporan_asrama.laporan_perkembangan', ['data' => $tabel, 'data2' => $tabel2,'data3' => $tabel3]);
    }

    public function cari_siswa(Request $req)
    {


        $siswa = new Siswa();

        $tabel2 = Jurusan::all();

        $tabel3 = Angkatan::all();

        if ($req->filled("nama")) {
            $siswa = $siswa->where("nama_siswa", "LIKE", "%" . $req->nama . "%")->where('jenis_kelamin', 'L')->Where('status', 'aktif');
        }

        if ($req->filled("angkatan")) {
            $siswa = $siswa->where("id_angkatan", $req->angkatan)->where('jenis_kelamin', 'L')->Where('status', 'aktif');
        }

        if ($req->filled("jurusan")) {
            $siswa = $siswa->where("id_jurusan", $req->jurusan)->where('jenis_kelamin', 'L')->Where('status', 'aktif');
        }

        // dd($siswa->get());
        return view("laporan_asrama.laporan_perkembangan", ["data" => $siswa->get(), 'data2' => $tabel2, 'data3' => $tabel3]);
    }

    public function detail_perkembangan($nis){
        $tabel = Siswa::find($nis);
        $tabel2 = Laporan_Perkembangan::where("nis_siswas",$nis)->get();
        return view('laporan_asrama.detail_laporan',["data" => $tabel,"data2"=>$tabel2]);
    }

    public function rentang_tanggal(Request $req, $nis)
    {
        $dari = $req->dari;
        $sampai = $req->sampai;

        $tabel = Siswa::find($nis);
        if ($req->has('dari')) {
            $tabel2 = Laporan_Perkembangan::with('kategori')->where("nis_siswas", $nis)->WhereBetween('tanggal', [$dari, $sampai])
                ->orWhereBetween('tanggal', [$sampai, $dari])
                ->orWhere('tanggal', $dari)
                ->orWhere('tanggal', $sampai)
                ->get();
        } else {
            $tabel2 = Laporan_Perkembangan::where("nis_siswas", $nis)->get();
        }
        $html = view('laporan_asrama.laporan-pdf', ["data" => $tabel, "data2" => $tabel2])->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream('laporan.pdf');
    }

    public function tambah_perkembangan(Request $req){
        $tabel = new Laporan_Perkembangan();
        $tabel->judul_buku = $req->judul;
        $tabel->id_pengguna = $req->id_pengguna;
        $tabel->nis_siswas = $req->nis_siswa;
        $tabel->tanggal = $req->tanggal;
        $tabel->save();
        return back();
    }

    public function catatan_perkembangan($id){
        $tabel = Laporan_Perkembangan::find($id);
        return view('laporan_asrama.catatan_perkembangan', ["data" => $tabel]);
    }
    

    public function tambah_kategori(Request $req){
        $tabel = new KategoriMasalah;
        $tabel->level_kategori = $req->level_kategori;
        $tabel->save();
        return back();
    }

    public function edit_catatan($id){
        $tabel = Laporan_Perkembangan::find($id);
        $tabel2 = KategoriMasalah::all();
        return view('laporan_asrama.edit_catatan', ["data" => $tabel,"data2" => $tabel2]);
    }

    public function beri_catatan(Request $req){
        $ids = $req->ids;
        $tabel = Laporan_Perkembangan::find($ids);
        $tabel->judul_buku = $req->judul_buku;
        $tabel->id_kategori = $req->id_kategori;
        $tabel->isi_buku = $req->isi_buku;
        $tabel->id_kategori = $req->id_kategori;
        $tabel->update();
        return back();
    }

    // public function update_kategori($ids,$lol2){
    //     $tabel = KategoriMasalah::find($ids);
    //     $tabel->nama_kategori = $lol2;
    //     $tabel->update();
    //     return 'success';
    // }

    public function hapus_kategori($id_hapus)
    {
        $tabel = KategoriMasalah::find($id_hapus);
        $tabel->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Di Hapus',
        ]);
    }

    public function hapus_info($id){
        $tabel = Laporan_Perkembangan::find($id);
        $tabel->delete();
        return back();
    }

    public function update_status($ids,$status_siswa){
        $tabel = Siswa::find($ids);
        $tabel->status = $status_siswa;
        $tabel->update();
        return back();   
    }

    public function update_alumni($id_alumni)
    {
        $tabel = Siswa::find($id_alumni);
        $tabel->status = "alumni";
        $tabel->update();
        return back();
    }

    public function status_siswa(){
        $tabel = Siswa::where('status','tidak aktif')->get();
        $tabel2 = Siswa::where('status','alumni')->get();
        return view('laporan_asrama.status_siswa', ["data" => $tabel,'data2' => $tabel2]);
    }

    public function status_aktif($ids){
        $tabel = Siswa::find($ids);
        $tabel->status = "aktif";
        $tabel->update();
        return back();
    }

    public function profil_postingan($id_pengguna){
        $tabel = LaporanPost::where('id_pengguna',$id_pengguna)->get();
        $hitungPost = LaporanPost::where('id_pengguna',$id_pengguna)->count();
        return view('laporan_asrama.profil_postingan',['data' => $tabel,'hitung' => $hitungPost]);
    }

    public function workspace(){
        $tabel = ModelHasRoles::where('role_id','6')->get();
        $tabel2 = Workspace::all();
        return view('laporan_asrama.workspace',['data' => $tabel,'data2' => $tabel2]);
    }

    public function tambah_tugas(Request $req){
        $tabel = new Workspace;
        $tabel->id_pamong = $req->id_pamong;
        $tabel->tugas = $req->judul_tugas;
        $tabel->tanggal = $req->tanggal;
        $tabel->save();
        
        foreach($req->isi_tugas as $key => $value){
            $tabel2 = new isi_workspace();
            $tabel2->id_workspace = $tabel->id_workspace;
            $tabel2->isi_tugas = $req->isi_tugas[$key];
            $tabel2->status = "Belum Dikerjakan";
            $tabel2->cek = "0";
            $tabel2->deskripsi = NULL;
            $tabel2->save();
        }
        
            
        return back();
    }


    public function lihat_tugas_pamong(){
        $tabel = Workspace::where("id_pamong", auth()->user()->id)->get();
        $tabel2 = isi_workspace::where('cek','0')->count();
        return view('laporan_asrama.dashboard_pamong',['data' => $tabel,'hitung'=>$tabel2]);
    }

    public function udah_selesai($id){
        $tabel = isi_workspace::find($id);
        $tabel->cek = 1;
        $tabel->update();
        return back();
    }

    public function kembalikan_tugas($id){
        $tabel = Workspace::find($id);
        $tabel->status = "belum dikerjakan";
        $tabel->update();
        return back();
    }

    public function hapus_tugas($id)
    {
        $tabel = isi_workspace::find($id);
        $tabel->workspace->delete();
        $tabel->delete();
        return back();
    }

    public function update_detail_tugas($id_asli,$ids,$inputs){
         isi_workspace::where('id_bagian', $ids)
            ->where('id_workspace', $id_asli)
            ->update(['status' => $inputs]);
            
        return back();
    }

    public function update_deskripsi($ids, $lol2){
        isi_workspace::where('id_bagian',$ids)->update(['deskripsi' => $lol2]);
        return 'success';
    }

    public function update_status_deskripsi($id_desk,$isi_desk){
        isi_workspace::where('id_bagian',$id_desk)->update(['status' => 'Pending','deskripsi' => $isi_desk]);
        return back();
    }

    public function update_status_dibatalkan($ids){
        isi_workspace::where('id_bagian',$ids)->update(['status' => 'Tugas Dibatalkan','cek' => '0']);
        return back();
    }

    public function update_status_belum_dikerjakan($ids,$inputs,$id_workspace)
    {
        isi_workspace::where('id_workspace', $id_workspace)->update(['cek' => '0']); 
        isi_workspace::where('id_bagian', $ids)->update(['status' => $inputs]);
        return back();
    }
    
}