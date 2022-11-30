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
            </div>
            @else
            <div style="opacity:0.8" class="alert alert-danger" role="alert">
                <i class="bi bi-volume-up-fill mr-2"></i> Tidak ada riwayat kunjungan ...
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="" class="formpemeriksaan">
                <div class="card">
                    <div class="card-header text-bold bg-teal">Hasil Pemeriksaan
                        <button type="button" class="btn btn-danger float-right">Perawat sudah mengisi hasil pemeriksaan !<button>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <input type="text" hidden name="nomorrm" value="{{ $pasien[0]->no_rm }}">
                                <input type="text" hidden name="counter" value="{{ $datakunjungan[0]->counter }}">
                                <input type="text" hidden name="unit" value="{{ $datakunjungan[0]->kode_unit }}">
                                <input type="text" hidden name="kodekunjungan" value="{{ $datakunjungan[0]->kode_kunjungan }}">
                                <td>Tanggal & Jam Kunjungan</td>
                                <td><input readonly type="text" class="form-control" value="{{ $datakunjungan[0]->tgl_masuk }}" id="tanggalkunjungan" name="tanggalkunjungan"></td>
                                <td>Tanggal & Jam Pemeriksaan</td>
                                <td><input type="text" class="form-control" id="tanggalperiksa" name="tanggalperiksa" value="{{ $hasil[0]->tanggalperiksa }}"></td>
                            </tr>
                            <tr>
                                <td>Sumber Data</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Pasien Sendiri " @if( $hasil[0]->sumberdataperiksa == 'Pasien Sendiri ' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="sumberdataperiksa" id="sumberdataperiksa" value="Keluarga" @if( $hasil[0]->sumberdataperiksa == 'Keluarga' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keluhan Utama</td>
                                <td>
                                    <textarea class="form-control form-control-sm" name="keluhanutama" id="keluhanutama">{{ $hasil[0]->keluhanutama }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-center bg-secondary">Tanda tanda Vital</td>
                            </tr>
                            <tr>
                                <td>Tekanan Darah</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="tekanandarah" id="tekanandarah" value="{{ $hasil[0]->tekanandarah }}" />
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">mmHg</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Frekuensi Nadi</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="frekuensinadi" id="frekuensinadi" value="{{ $hasil[0]->frekuensinadi }}" />
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
                                        <input type="text" class="form-control form-control-md" name="frekuensinapas" id="frekuensinapas" value="{{ $hasil[0]->frekuensinapas }}" />
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">X / Menit</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Suhu</td>
                                <td>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-md" name="suhutubuh" id="suhutubuh" value="{{ $hasil[0]->suhutubuh }}" />
                                        <div class="input-group-append">
                                            <div class="input-group-text text-md">°C</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Riwayat Psikologis</td>
                                <td colspan="4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="Riwayatpsikologi" id="Riwayatpsikologi" value="CEMAS" @if( $hasil[0]->Riwayatpsikologi == 'CEMAS' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Cemas</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="Riwayatpsikologi" id="Riwayatpsikologi" value="TAKUT" @if( $hasil[0]->Riwayatpsikologi == 'TAKUT' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Takut</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="Riwayatpsikologi" id="Riwayatpsikologi" value="SEDIH" @if( $hasil[0]->Riwayatpsikologi == 'SEDIH' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Sedih</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="Riwayatpsikologi" id="Riwayatpsikologi" value="LAINNYA" @if( $hasil[0]->Riwayatpsikologi == 'LAINNYA' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Lain -
                                            lain</label>
                                    </div>
                                </td>
                            </tr>
                            <TR>
                                <td colspan="4" class="text-center bg-secondary mt-3">Status Fungsional</td>
                            </TR>
                            <tr>
                                <td>Penggunaan Alat Bantu</td>
                                <td colspan="4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="penggunaanalatbantu" id="penggunaanalatbantu" value="Tidak Ada" @if( $hasil[0]->penggunaanalatbantu == 'Tidak Ada' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3" type="radio" name="penggunaanalatbantu" id="penggunaanalatbantu" value="Tongkat" @if( $hasil[0]->penggunaanalatbantu == 'Tongkat' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Tongkat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3" type="radio" name="penggunaanalatbantu" id="penggunaanalatbantu" value="Kursi Roda" @if( $hasil[0]->penggunaanalatbantu == 'Kursi Roda' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Kursi Roda</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Cacat Tubuh</td>
                                <td colspan="4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3 cacattubuh" type="radio" name="cacattubuh" id="cacattubuh" value="Tidak Ada" skor="1" @if( $hasil[0]->cacattubuh == 'Tidak Ada' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3 cacattubuh" skor="2" type="radio" name="cacattubuh" id="cacattubuh" value="Ya" @if( $hasil[0]->cacattubuh == 'Ya' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Ya</label>
                                    </div>
                                    <input type="text" class="form-control form-control-sm mt-3" id="keterangancacattubuh" name="keterangancacattubuh" placeholder="Sebutkan cacat tubuh ..." value="{{ $hasil[0]->keterangancacattubuh }}">
                                </td>
                            </tr>
                            <TR>
                                <td colspan="4" class="text-center text-bold bg-secondary mt-3">Assesmen Nyeri</td>
                            </TR>
                            <tr>
                                <td>Apakah Pasien Mengeluh Nyeri</td>
                                <td colspan="4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2 mr-3 Keluhannyeri" type="radio" skor="1" name="Keluhannyeri" id="Keluhannyeri" value="Tidak Ada" @if( $hasil[0]->Keluhannyeri == 'Tidak Ada' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input mr-3 Keluhannyeri" type="radio" skor="2" name="Keluhannyeri" id="Keluhannyeri" value="Ya" @if( $hasil[0]->Keluhannyeri == 'Ya' ) checked @endif>
                                        <label class="form-check-label" for="inlineRadio2">Ya</label>
                                    </div>
                                    <input type="text" class="form-control form-control-md mt-2" value="{{ $hasil[0]->skalenyeripasien }}" id="skalenyeripasien" name="skalenyeripasien" placeholder="skala nyeri ...">
                                    <img src="{{ asset('public/img/skalanyeri.jpg') }}" width="350px" alt="">
                                </td>
                            </tr>
                        </table>
                        </table>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header bg-warning" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-dark text-bold" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Assesmen Resiko Jatuh
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-md text-md ">
                                            <thead>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" class="bg-warning">Metode Get Up and Go</td>
                                                </tr>
                                                <tr class="bg-secondary">
                                                    <td>Faktor resiko</td>
                                                    <td>Skala</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">a</td>
                                                    <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak tidak seimbang (
                                                        sempoyongan / limbung ) ?</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">b</td>
                                                    <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan
                                                        duduk ?</td>
                                                </tr>
                                            </tbody>
                                            <tr>
                                                <td colspan="2">Hasil</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input ml-2 mr-3 resikojatuh" type="radio" name="resikojatuh" id="resikojatuh" value="Tidak Beresiko" @if( $hasil[0]->resikojatuh == 'Tidak Beresiko' ) checked @endif>
                                                        <label class="form-check-label" for="inlineRadio1">Tidak Beresiko ( Tidak ditemukan a dan b
                                                            )</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input ml-2 mr-3 resikojatuh" type="radio" name="resikojatuh" id="resikojatuh" value="Resiko Rendah" @if( $hasil[0]->resikojatuh == 'Resiko Rendah' ) checked @endif>Risiko
                                                        rendah ( ditemukan a atau
                                                        b)</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input ml-2 mr-3 resikojatuh" type="radio" name="resikojatuh" id="resikojatuh" value="Resiko Tinggi" @if( $hasil[0]->resikojatuh == 'Resiko Tinggi' ) checked @endif>Risiko
                                                        tinggi ( a dan b ditemukan
                                                        )</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-warning" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-dark text-bold collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Skrinning Gizi
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-md  text-md">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Metode Malnutrition Screnning Tools ( Pasien Dewasa )</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">1. Apakah pasien mengalami penurunan berat badan yang tidak
                                                        diinginkan dalam 6 bulan
                                                        terakhir ?</td>
                                                    <td>Skor</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-check form-check-inline">
                                                            <input skor="0" class="form-check-input ml-2 mr-3 Skrininggizi" type="radio" name="Skrininggizi" id="Skrininggizi" value="Tidak Ada Penurunan" @if( $hasil[0]->Skrininggizi == 'Tidak Ada Penurunan' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio1">Tidak ada penurunan berat badan</label>
                                                        </div>
                                                    </td>
                                                    <td rowspan="3">
                                                        <textarea readonly class="form-control" name="skorskrininggizi" id="skorskrininggizi">
                                                        {{ $hasil[0]->skorskrininggizi }}
                                                        </textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-check form-check-inline">
                                                            <input skor="2" class="form-check-input ml-2 mr-3 Skrininggizi" type="radio" name="Skrininggizi" id="Skrininggizi" value="Tidak Yakin / Tidak Tahu" @if( $hasil[0]->Skrininggizi == 'Tidak Yakin / Tidak Tahu' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio1">Tidak yakin / tidak tahu / terasa baju
                                                                lebih
                                                                longgar</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input skor="10" class="form-check-input ml-2 mr-3 Skrininggizi" type="radio" name="Skrininggizi" id="Skrininggizi" value="Ya" @if( $hasil[0]->Skrininggizi == 'Ya' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio1">Jika YA , berapa berat badan
                                                                tersebut</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input ml-2 mr-1 beratskrininggizi" type="radio" name="beratskrininggizi" skor="0" id="beratskrininggizi" value="Tidak" @if( $hasil[0]->beratskrininggizi == 'Tidak' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio1" checked>Tidak</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input ml-2 mr-1 beratskrininggizi" skor="1" type="radio" name="beratskrininggizi" id="beratskrininggizi" value="1 sd 5 kg" @if( $hasil[0]->beratskrininggizi == '1 sd 5 kg' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio1">1 - 5 Kg</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mr-1 beratskrininggizi" skor="2" type="radio" name="beratskrininggizi" id="beratskrininggizi" value="6 sd 10 kg" @if( $hasil[0]->beratskrininggizi == '6 sd 10 kg' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2">6 - 10 Kg</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mr-1 beratskrininggizi" skor="3" type="radio" name="beratskrininggizi" id="beratskrininggizi" value="11 sd 15 kg" @if( $hasil[0]->beratskrininggizi == '11 sd 15 kg' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2">11 - 15 Kg</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mr-1 beratskrininggizi" skor="4" type="radio" name="beratskrininggizi" id="beratskrininggizi" value=" > 15 kg" @if( $hasil[0]->beratskrininggizi == ' > 15 kg' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> > 15 Kg</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mr-1 beratskrininggizi" skor="2" type="radio" name="beratskrininggizi" id="beratskrininggizi" value="tidak yakin penurunannya" @if( $hasil[0]->beratskrininggizi == 'tidak yakin penurunannya' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> Tidak yakin penurunannya</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">2. Apakah asupan makanan berkurang karena berkurangnya nafsu
                                                        makan</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1 status_asupanmkanan" skor="0" type="radio" name="status_asupanmkanan" id="status_asupanmkanan" value="Tidak Ada" @if( $hasil[0]->status_asupanmkanan == 'Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> Tidak Ada</label>
                                                        </div>
                                                    </td>
                                                    <td rowspan="2">
                                                        <textarea readonly class="form-control" name="skorasupanmkanan" id="skorasupanmkanan">
                                                        {{ $hasil[0]->skorasupanmkanan }}
                                                        </textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1 status_asupanmkanan" skor="1" type="radio" name="status_asupanmkanan" id="status_asupanmkanan" value="Ya" @if( $hasil[0]->status_asupanmkanan == 'Ya' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> Ya</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-secondary text-bold">
                                                    <td colspan="2" class="text-center">
                                                        <h5>Total Skor</h5>
                                                    </td>
                                                    <td><input readonly type="text" class="form-control form-control-sm" id="totalskorgizi" name="totalskorgizi" value="{{ $hasil[0]->totalskorgizi }}"></td>
                                                </tr>
                                                <tr class="text-bold text-md">
                                                    <td colspan="2">3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal /
                                                        Hati /
                                                        Paru / Stroke / Kanker
                                                        / Penurunan imunitas geriatri, lain lain...</td>
                                                    <td>
                                                        <textarea class="form-control form-control-sm" name="penyakitlainpasien" placeholder="sebutkan jika ada penyakit lain ....">{{ $hasil[0]->penyakitlainpasien }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1" type="radio" name="diagnosakhusus" id="diagnosakhusus" value="Tidak Ada" @if( $hasil[0]->diagnosakhusus == 'Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> Tidak Ada</label>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1" type="radio" name="diagnosakhusus" id="diagnosakhusus" value="Ya" @if( $hasil[0]->diagnosakhusus == 'Ya' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2">Ya</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Bila skor >= 2, pasien beresiko malnutrisi dilakukan
                                                        pengkajian
                                                        lanjut oleh ahli gizi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1" type="radio" name="resikomalnutrisi" id="resikomalnutrisi" value="Tidak Ada" @if( $hasil[0]->resikomalnutrisi == 'Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2"> Tidak Ada</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input  ml-2 mr-1" type="radio" name="resikomalnutrisi" id="resikomalnutrisi" value="Ya" @if( $hasil[0]->resikomalnutrisi == 'Ya' ) checked @endif>
                                                            <label class="form-check-label" for="inlineRadio2">Ya</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="">*Tanggal pengkajian lanjut</label>
                                                        <input type="text" name="tglpengkajianlanjutgizi" class="form-control form-control-sm" placeholder="Tanggal pengkajian lanjut" value="{{ $hasil[0]->tglpengkajianlanjutgizi }}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-md">
                            <tr>
                                <td colspan="3" class="text-md text-bold bg-secondary">Diagnosa Keperawatan/Kebidanan</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <textarea name="diagnosakeperawatan" class="form-control" placeholder="ketik diagnosa keperawatan ...">{{ $hasil[0]->diagnosakeperawatan }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-md text-bold bg-secondary">Rencana Keperawatan/Kebidanan</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <textarea name="rencanakeperawatan" class="form-control" placeholder="ketik rencana keperawatan ...">{{ $hasil[0]->rencanakeperawatan }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-md text-bold bg-secondary">Tindakan Keperawatan/Kebidanan</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <textarea name="tindakankeperawatan" class="form-control" placeholder="ketik tindakan keperawatan ...">{{ $hasil[0]->tindakankeperawatan }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-md text-bold bg-secondary">Evaluasi Keperawatan/Kebidanan</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <textarea name="evaluasikeperawatan" class="form-control" placeholder="ketik evaluasi keperawatan ...">{{ $hasil[0]->evaluasikeperawatan }}</textarea>
                                </td>
                            </tr>
                        </table>
                        <table class="table text-bold table-md text-md">
                            <thead>
                                <th class="text-center">Tanggal Assesmen Perawat/Bidan</th>
                                <th class="text-center">Nama Perawat/Bidan</th>
                                <th>Tanda Tangan Perawat/Bidan</th>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>
                                        <input type="text" class="form-control" name="tanggalassemen" value="{{ $hasil[0]->tanggalassemen }}">
                                        <!-- <textarea readonly disabled name="tanggal_assesmen" class="form-control" id="tanggal_assesmen" cols="30" rows="2"> </textarea> -->
                                    </td>
                                    <td>
                                        <input readonly type="text" class="form-control text-center" value="{{ strtoupper(auth()->user()->name) }}" name="namapemeriksa">
                                        <input hidden type="text" class="form-control" value="{{ strtoupper(auth()->user()->id) }}" name="idpemeriksa">
                                        <!-- <textarea readonly disabled name="nama_perawat" class="form-control" id="nama_perawat" cols="30" rows="2"></textarea>
                                    <textarea hidden name="id_perawat" id="id_perawat" cols="50" rows="10">{{ strtoupper(auth()->user()->id) }}</textarea> -->
                                    </td>
                                    <td>
                                        <div id="signature-pad">
                                            <div style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                                <div id="note" onmouseover="my_function();">
                                                </div>
                                                <img src="{{ $hasil[0]->signature }}" alt="">
                                                <canvas id="the_canvas" width="350px" height="100px">
                                                </canvas>
                                            </div>
                                            <div style="margin:10px;">
                                                <input hidden type="" id="signature" value="{{ $hasil[0]->signature }}" name="signature">
                                                <button type="button" id="clear_btn" class="btn btn-danger" data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                                    Clear</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 justify-content-end mb-2">
                            <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success float-right mr-2 simpanhasil mb-3">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaldetail_kunjunganlama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail kunjungan terakhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="detailkj">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());
    });
    $(document).ready(function() {
        $('.simpanhasil').click(function() {
            spinner = $('#loader2');
            spinner.show();
            var canvas = document.getElementById("the_canvas");
            var dataUrl = canvas.toDataURL();
            if (dataUrl ==
                'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
            ) {
                dataUrl = ''
            }
            document.getElementById("signature").value = dataUrl;
            var data = $('.formpemeriksaan').serializeArray();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanpemeriksaanperawat') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(data) {
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
                }
            });
        });
        var wrapper = document.getElementById("signature-pad");
        var clearButton = wrapper.querySelector("[data-action=clear]");
        var canvas = wrapper.querySelector("canvas");
        var el_note = document.getElementById("note");
        var signaturePad;
        signaturePad = new SignaturePad(canvas);
        clearButton.addEventListener("click", function(event) {
            document.getElementById("note").innerHTML = "The signature should be inside box";
            signaturePad.clear();
        });

        function my_function() {
            document.getElementById("note").innerHTML = "";
        }
    });
    $(".btn-detail").click(function() {
        spinner = $('#loader2');
        spinner.show()
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('detaillast_kj') ?>',
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
                $('.detailkj').html(response)
            }
        });
        $('#modaldetail_kunjunganlama').modal('show')
    });
</script>