@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="card-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            @foreach($jadwalkonseling["detail"] as $i=> $jk)
                                <td>{{$i}}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for($j = 0;$j < 5;$j++)
                        <tr>
                            @foreach($jadwalkonseling["detail"] as $k => $jk)
                                <td>@if(isset($jk[$j]))
                                    <div class="row">
                                        <div class="col"></div>
                                        <div class="col"></div>
                                    </div>
                                     <input type="time" class="form-control">
                                     <input type="time" class="form-control">@endif</td>
                            @endforeach
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection