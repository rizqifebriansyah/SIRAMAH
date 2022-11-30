<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header bg-teal" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-dark text-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Riwayat Tindakan
                </button>
            </h2>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <th>Unit</th>
                        <th>Nama Tarif / Tindakan</th>
                    </thead>
                    <tbody>
                        @foreach($last_rajal_detail as $d)
                        <tr>
                            <td>{{ $d->nama_unit}}</td>
                            <td>{{ $d->nama_tarif}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-teal" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Hasil Pemeriksaan
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if(count($last_rajal_asskep) > 0)
                        <table class="table table-sm">
                            <tr>
                                <td>Tekanan Darah</td>
                                <td>{{ $last_rajal_asskep[0]->tekanandarah }}</td>
                            </tr>
                        </table>
                        @else
                        Tidak ada hasil pemeriksaan ...
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-teal" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Hasil Pemeriksaan Penunjang
                </button>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
            </div>
        </div>
    </div>
</div>