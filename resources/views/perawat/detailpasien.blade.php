<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Info Pasien</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('public/img/user.jpg') }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ $pasien[0]->nama_px }} | {{ $pasien[0]->no_rm }}</h3>
                        <h5 class="widget-user-desc">{{ $pasien[0]->alamat }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="text-dark nav-link">
                                    Tempat, Tanggal lahir <span class="float-right">{{ $pasien[0]->tempat_lahir }} , {{ $pasien[0]->tgl_lahir }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark nav-link">
                                    Umur <span class="float-right">{{ $pasien[0]->umur }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark nav-link">
                                    Jenis Kelamin <span class="float-right">@if ($pasien[0]->jenis_kelamin == 'L' ) Laki - Laki @else Perempuan @endif</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark nav-link">
                                    Penjamin <span class="float-right">{{$datakunjungan[0]->nama_penjamin }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="text-dark nav-link">
                                    Kunjungan ke - <span class="float-right badge bg-danger">{{$datakunjungan[0]->counter }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <div class="col-md-8">
                @if(count($last_rajal) > 0)
                <div class="card card-widget">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true">
                        <div class="user-block">
                            <img class="img-circle" src="{{ asset('public/img/user.jpg') }}" alt="User Image">
                            <span class="username"><a>{{ $last_rajal[0]->nama_unit}} | {{ $last_rajal[0]->nama_penjamin }}</a></span>
                            <span class="description mt-2">
                            <div class="external-event bg-warning"> Kunjungan rawat jalan terakhir - {{ $last_rajal[0]->tgl_masuk }}</div>
                           </span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
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
                            </div>
                            <div class="card">
                                <div class="card-header bg-teal" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn text-dark text-bold btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
                    </div>
                </div>
                @else
                <div style="opacity:0.8" class="alert alert-danger" role="alert">
                    <i class="bi bi-volume-up-fill mr-2"></i> Tidak ada riwayat kunjungan rawat jalan ...
                </div>
                @endif
                @if(count($last_ranap) > 0)
                <div class="card card-widget">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true">
                        <div class="user-block">
                            <img class="img-circle" src="{{ asset('public/img/user.jpg') }}" alt="User Image">
                            <span class="username"><a>{{ $last_ranap[0]->nama_unit}} | {{ $last_ranap[0]->nama_penjamin }}</a></span>
                            <span class="description mt-2">
                            <div class="external-event bg-warning">Kunjungan rawat inap terakhir - {{ $last_ranap[0]->tgl_masuk }}</div>
                           </span>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Data not found !
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                @else
                <div style="opacity:0.8" class="alert alert-danger" role="alert">
                    <i class="bi bi-volume-up-fill mr-2"></i> Tidak ada riwayat kunjungan rawat inap ...
                </div>
                @endif
            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->