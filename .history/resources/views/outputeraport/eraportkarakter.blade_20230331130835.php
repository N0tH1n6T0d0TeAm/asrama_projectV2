<div class="card mt-3">
    <div class="card-header pb-0">
        <h6>Output Eraport Karakter {{$kelas}} {{$jurusan}}</h6>
      </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table-custom m-3">
                <tr>
                    <td rowspan="3">No</td>
                    <td rowspan="3">Faktor Penilaian Karakter</td>
                    @foreach($siswa as $i => $siswas)
                    <td colspan=4 align="center">{{$siswas->nama_siswa}}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($siswa as $i => $siswas)
                    <td align="center" colspan="4">{{$siswas->no_absen}}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach($siswa as $i => $siswas)
                        <td>Sekolah(1000%)</td>
                        <td>Nilai Akhir</td>
                        <td>Nilai Huruf</td>
                    @endforeach
        
                </tr>
                <tbody>
                    @php
                        
                        $no_aspek = "";
                        $no_subpoint = "";
                        $no_point = "";
                    @endphp
                    @foreach($rekaplist as $j => $lsr)
                        @php
                            
                            list($no,$subpoint,$point) = explode(":",$j);
                        @endphp
                        @if($no_point != $point)
                            <tr>
                                <td>{{$point}}</td>
                                <td>{{$lsr['point']}}</td>
                                @foreach($siswa as $s => $sws)
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforeach
                            </tr>
                            @php
                                $no_point = $point;
                            @endphp
                        @endif
                        @if($no_subpoint != $subpoint)
                            <tr>
                                <td>{{$subpoint}}</td>
                                <td>{{$lsr["subpoint"]}}</td>
                                @foreach($siswa as $s => $sws)
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforeach
                            </tr>
                            @php
                                $no_subpoint = $subpoint;
                            @endphp
                        @endif
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$lsr['aspek']}}</td>
                            @foreach($lsr["siswa"] as $key => $sis)
                                <td class="has-tooltips" data-header="Jumlah Penilai" data-jumlah="{{$sis["nilai_asrama"]['jumlah'] }}">{{$sis["nilai_asrama"]["jumlah_akumulatif"]}}
                                </td>
                                <td class="has-tooltips" data-header="Jumlah Penilai" data-jumlah="{{$sis["nilai_sekolah"]['jumlah'] }}">{{$sis["nilai_sekolah"]["jumlah_akumulatif"]}}</td>
                                <td></td>
                                <td></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
   