<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mt-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-warning">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('public/semeru/dist/img/user7-128x128.jpg') }}" alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username text-xs">{{ $pasien[0]->nama_px }} | {{ $pasien[0]->no_rm }}</h3>
                    <h5 class="widget-user-desc text-xs">{{ $pasien[0]->alamat }}</h5>
                    <button class="btn btn-info btn-sm float-right detailass_kep_today" id="{{ $datakunjungan[0]->kode_kunjungan }}" data-toggle="modal" data-target="#modaldetailaskep">Hasil Pemeriksaan Perawat</button>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-md-9 mt-3">
            @if(count($last_counter) > 0)
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-light">
                    <div class="widget-user-image">
                        <img class=" elevation-2" src="{{ asset('public/img/BG-REG2.jpg') }}" alt="User Avatar">
                    </div>
                    <h5 class="widget-user-username text-xs">Kunjungan terakhir {{ $last_counter[0]->tgl_masuk }}</h5>
                    <h5 class="widget-user-desc text-xs">{{ $last_counter[0]->nama_unit }} - {{ $last_counter[0]->nama_penjamin }}</h5>
                    <h5 class="widget-user-desc text-xs">{{ $last_counter[0]->dokter }}</h5>
                    <button class="btn btn-info btn-sm float-right btn-detail" id="{{ $last_counter[0]->kode_kunjungan }}">Detail</button>
                </div>
                @else
                <div style="opacity:0.8" class="alert alert-danger" role="alert">
                    <i class="bi bi-volume-up-fill mr-2"></i> Tidak ada riwayat kunjungan ...
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <input hidden type="text" value="{{ $pasien[0]->no_rm }}" id="nomorrm_px">
        <input hidden type="text" value="{{ $asskep[0]->id }}" id="idasskep">
        <div class="col-md-12">
            <form action="" class="formpemeriksaan">
                <div class="card">
                    <div class="card-header text-bold bg-teal">Hasil Pemeriksaan Medis
                        <button type="button" disabled class="float-right btn-sm btn-warning">Hasil pemeriksaan medis sudah terisi !</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td>Tanggal & Jam Kunjungan</td>
                                <td><input readonly type="text" class="form-control" value="{{ $datakunjungan[0]->tgl_masuk }}" name="tgljamkunjungan"></td>
                                <td>Tanggal & Jam Pemeriksaan</td>
                                <td><input type="text" class="form-control" value=" {{ $hasil[0]->tanggal_periksa }}" name="tgljampemeriksaan"></td>
                            </tr>
                            <tr>
                                <td>Sumber Data</td>
                                <td colspan="2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Pasien Sendiri " checked>
                                        <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Keluarga">
                                        <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-secondary">
                                <td colspan="4">ANAMNESA</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="bg-secondary">Tanda - Tanda Vital</td>
                            </tr>
                            <tr>
                                <td>Tekanan Darah</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="tekanandarah" id="tekanandarah" @if(count($asskep)> '0') value="{{ $asskep[0]->tekanandarah }}" @endif/>
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">mmHg</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Frekuensi Nadi</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="frekuensinadi" id="frekuensinadi" @if(count($asskep)> '0') value="{{ $asskep[0]->frekuensinadi }}" @endif/>
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">X / Menit</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Frekuensi Napas</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="frekuensinapas" id="frekuensinapas" @if(count($asskep)> '0') value="{{ $asskep[0]->frekuensinapas }}" @endif />
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">X / Menit</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Suhu</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="suhutubuh" id="suhutubuh" @if(count($asskep)> '0') value="{{ $asskep[0]->suhutubuh }}" @endif />
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">°C</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keluhan Utama</td>
                                <td colspan="3"><textarea cols="10" rows="4" class="form-control" name="keluhanutama" id="keluhanutama">{{ $hasil[0]->keluhan_utama }}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="bg-secondary">Riwayat Kesehatan</td>
                            </tr>
                            <tr>
                                <td>Riwayat Penyakit Sekarang</td>
                                <td colspan="3"><textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control">{{ $hasil[0]->riwayat_penyakit }}</textarea></td>
                            </tr>
                            <tr>
                                <td>Riwayat Penyakit Dahulu</td>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="hipertensi" name="hipertensi" value="1" 
                                                @if($hasil[0]->hipertensi == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="kencingmanis" name="kencingmanis" value="1" @if($hasil[0]->kencingmanis == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="jantung" name="jantung" value="1" @if($hasil[0]->jantung == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="stroke" name="stroke" value="1" @if($hasil[0]->stroke == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="hepatitis" name="hepatitis" value="1" @if($hasil[0]->hepatitis == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="asthma" name="asthma" value="1" @if($hasil[0]->asthma == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="ginjal" name="ginjal" value="1" @if($hasil[0]->ginjal == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="tb" name="tb" value="1" @if($hasil[0]->tbparu == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="riwayatlain" name="riwayatlain" value="1" @if($hasil[0]->riwayatlain == 1)
                                                checked @endif>
                                                <label class="form-check-label" for="exampleCheck1">Lain-lain</label>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                            </tr>
                            <tr>
                                <td>Keadaan Umum</td>
                                <td colspan="3">
                                    <textarea class="form-control" name="keadaanumum">{{ $hasil[0]->keadaanumum }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Kesadaran</td>
                                <td colspan="3">
                                    <textarea class="form-control" name="kesadaran">{{ $hasil[0]->kesadaran }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Diagnosa Kerja</td>
                                <td colspan="3">
                                    <textarea class="form-control" name="diagnosakerja">{{ $hasil[0]->diagnosakerja }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Rencana Kerja</td>
                                <td colspan="3">
                                    <textarea class="form-control" name="rencanakerja">{{ $hasil[0]->rencanakerja }}</textarea>
                                </td>
                            </tr>
                        </table>
                        <!-- <table class="table text-bold table-md text-md mt-4">
                            <thead class="bg-info">
                                <th class="text-center">Tanggal Assesmen Dokter</th>
                                <th class="text-center">Nama Dokter</th>
                                <th>Tanda Tangan Dokter</th>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <input type="text" class="form-control" name="tanggalassemen" value="{{ $now }}">
                                    </td>

                                    <td>
                                        <input readonly type="text" class="form-control text-center" value="{{ strtoupper(auth()->user()->name) }}" name="namapemeriksa">
                                        <input hidden type="text" class="form-control" value="{{ strtoupper(auth()->user()->id) }}" id="idpemeriksa" name="idpemeriksa">
                                    </td>
                                    <td>
                                        <div id="signature-pad">
                                            <div style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                                <div id="note" onmouseover="my_function();">tulis tanda tangan didalam box ...
                                                </div>
                                                <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                            </div>
                                            <div style="margin:10px;">
                                                <input hidden type="" id="signature" name="signature">
                                                <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                                    Clear</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                        <div class="col-md-12 justify-content-end mb-2">
                            <button type="button" class="btn btn-success float-right mr-2 simpanhasildokter mb-3">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal" id="modaldetailaskep" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Hasil Pemeriksaan Perawat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="detailaskep">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".detailass_kep_today").click(function() {
            spinner = $('#loader2');
            id = $(this).attr('id')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('detail_asskep') ?>',
                error: function(data) {
                    spinner.hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(response) {
                    spinner.hide();
                    $('.detailaskep').html(response)
                }
            });
        });
        $(document).ready(function() {
            $('.simpanhasildokter').click(function() {
                spinner = $('#loader2');
                spinner.show();
                var data = $('.formpemeriksaan').serializeArray();
                rm = $('#nomorrm_px').val()
                idasskep = $('#idasskep').val()
                kodekunjungan = $('#kodekunjungan').val()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                        rm,
                        idasskep,
                        kodekunjungan
                    },
                    url: '<?= route('simpanpemeriksaandokter') ?>',
                    error: function(data) {
                        spinner.hide()
                        console.log(data)
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        console.log(data)
                        spinner.hide()
                        if (data.kode == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                        }
                        cek_resume()
                    }
                });
            });
           
        });
    </script>