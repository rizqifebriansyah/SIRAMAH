 @extends('templates.erm.main')
 @section('container')
 <div class="content-wrapper">
    <input hidden id="kodekunjungan" type="text" class="form-control" value="{{ $datakunjungan[0]->kode_kunjungan }}">
    <input hidden id="nomorrm" type="text" class="form-control" value="{{ $datakunjungan[0]->no_rm }}">
     <div id="content" class="content">

     </div>
 </div>
 @endsection
