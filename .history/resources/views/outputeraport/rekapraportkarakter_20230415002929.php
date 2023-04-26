<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap</title>
</head>
<body>
    <div class="card mt-3">
                <table class="table-custom m-3">
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2" style="width: 400px">Faktor Penilaian Karakter</td>
                        @foreach($siswa as $i => $siswas)
                        <td colspan=2 align="center">{{$siswas->nama_siswa}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($siswa as $i => $siswas)
                        <td align="center" colspan="2">{{$siswas->no_absen}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($siswa as $i => $siswas)
                            <td>Sekolah</td>
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
                                    <td class="has-tooltips" data-header="Jumlah Penilai" data-jumlah="{{$sis["nilai_sekolah"]['jumlah'] }}">{{$sis["nilai_sekolah"]["jumlah_akumulatif"]}}</td>
                                    <td>{{hurufDari($sis["nilai_sekolah"]["jumlah_akumulatif"])["huruf"]}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
       
</body>
</html>