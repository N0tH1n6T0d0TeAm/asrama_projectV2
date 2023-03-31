@extends('layouts.master')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            Cari Konselor
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="konselor-searcher">
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="container-konselor">
    </div>
</div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="
            "></form>
        </div>
    </div>
</div>

@push("js")
<script>
    $(document).ready(function() {
        const myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: false
        })
        $("#konselor-searcher").keyup(function() {
            var kw = $(this).val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
                }
                , url: "{{route('siswa.carikonselor')}}"
                , data: {
                    kw: kw
                }
                , type: "get"
                , dataType: "json"
                , success: function(data) {
                    var card = data["konselor"].map(function(e) {
                        return `<div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="https://img.freepik.com/free-photo/senior-man-face-portrait-wearing-bowler-hat_53876-148154.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">${e['name']}</h5>
                  <a href="#" class="btn btn-primary btn-ajukan" data-id=${e['id']}>Ajukan Konseling</a>
                </div>
              </div>
        </div>`
                    });
                    $("#container-konselor").html(card);
                }
                , error: function(err) {
                    alert(err.responseText);
                }
            })
        });

        $(document).delegate(".btn-ajukan","click", function(){
            
        });
    })

</script>
@endpush
@endsection