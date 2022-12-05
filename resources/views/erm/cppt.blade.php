<div class="container-fluid mt-4">

    <table class="table table-sm table-bordered">
        <thead>
            <th colspan="4">CPPT ( CATATAN PERKEMBANGAN PASIEN TERINTEGRASI )</th>
        </thead>
        <tbody>
            <tr>
                <td class="text-bold">Nomor RM</td>
                <td style="font-style:italic">{{ $pasien[0]->no_rm }}</td>
                <td class="text-bold">Nama Pasien</td>
                <td style="font-style:italic">{{ $pasien[0]->nama_px }}</td>
            </tr>
            <tr>
                <td class="text-bold">Nomor KTP</td>
                <td style="font-style:italic">{{ $pasien[0]->nik_bpjs }}</td>
                <td class="text-bold">Tempat Tgl Lahir</td>
                <td style="font-style:italic">{{ $pasien[0]->tempat_lahir }} , {{ $pasien[0]->tgl_lahir }}</td>
            </tr>
            <tr>
                <td class="text-bold">Nomor BPJS</td>
                <td style="font-style:italic">{{ $pasien[0]->no_Bpjs }}</td>
                <td class="text-bold">Jenis Kelamin</td>
                <td style="font-style:italic">{{ $pasien[0]->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td class="text-bold">Alamat</td>
                <td colspan="3" style="font-style:italic">{{ $pasien[0]->alamat }}</td>
            </tr>
        </tbody>
    </table>
    @foreach($cppt as $c)
    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">{{ $c->tanggalkunjungan }} | {{ $c->namaunit }}</button>
    <div class="row mt-4">
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    <table class="table table-sm">
                        <thead>
                            <th colspan="4" class="bg-info">Hasil Pemeriksaan, Analisa, Rencana Penatalaksanaan Pasien</th>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="text-bold">Sumber Data Periksa</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->sumberdataperiksa}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Keluhan Utama</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->keluhanutama }}</td>
                            </tr>
                            <tr class="bg-dark">
                                <td class="text-bold">Tekanan Darah</td>
                                <td class="text-bold">Frekuensi Nadi</td>
                                <td class="text-bold">Frekuensi Napas</td>
                                <td class="text-bold">Suhu Tubuh</td>
                            </tr>
                            <tr class="bg-info">
                                <td style="font-style:italic" class="text-md">{{ $c->tekanandarah }}</td>
                                <td style="font-style:italic" class="text-md">{{ $c->frekuensinadi }}</td>
                                <td style="font-style:italic" class="text-md">{{ $c->frekuensinapas }}</td>
                                <td style="font-style:italic" class="text-md">{{ $c->suhutubuh }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Riwayat Psikologis</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->Riwayatpsikologi }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Penggunaan Alat Bantu</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->penggunaanalatbantu }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Cacat Tubuh</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->cacattubuh }} | keterangan : {{ $c->keterangancacattubuh}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Keluhan Nyeri</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->Keluhannyeri }} | keterangan : {{ $c->skalenyeripasien}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Resiko Jatuh</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->resikojatuh }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Skrining Gizi</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->Skrininggizi }} | keterangan : {{ $c->skorskrininggizi}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Penurunan Berat Badan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->beratskrininggizi }} | keterangan : {{ $c->skorskrininggizi}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Kekurangan Asupan Makanan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->status_asupanmkanan }} | keterangan : {{ $c->skorasupanmkanan}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Penyakit Lain / Diagnosa Khusus</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->penyakitlainpasien }} | keterangan : {{ $c->diagnosakhusus}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Resiko Malnutrisi</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->resikomalnutrisi }} | keterangan : {{ $c->diagnosakhusus}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Diagnosa Keperawatan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->diagnosakeperawatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Rencana Keperawatan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->rencanakeperawatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tindakan Keperawatan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->tindakankeperawatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Evaluasi Keperawatan</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->evaluasikeperawatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Pemeriksa</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->namapemeriksa }}
                                    <img src="{{$c->signature_perawat}}" alt="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                    <table class="table table-sm">
                        <thead>
                            <th colspan="4" class="bg-info">Instruksi Tenaga Kesehatan Termasuk Pasca Bedah / Prosedur</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold">Keluhan Utama</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->keluhan_utama}}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Riwayat Penyakit</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->riwayat_penyakit }}</td>
                            </tr>
                            <tr class="bg-info">
                                <td class="text-bold">Hipertensi</td>
                                <td class="text-bold">Kencing Manis</td>
                                <td class="text-bold">Jantung</td>
                                <td class="text-bold">Stroke</td>
                            </tr>
                            <tr>
                                <td style="font-style:italic" class="text-md">@if($c->hipertensi != 1)Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if($c->kencingmanis != 1)Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if($c->jantung != 1) Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if ($c->stroke != 1) Tidak Ada @else Ya @endif</td>
                            </tr>
                            <tr class="bg-info">
                                <td class="text-bold">Hepatitis</td>
                                <td class="text-bold">Asthma</td>
                                <td class="text-bold">TB Paru</td>
                                <td class="text-bold">Ginjal</td>
                            </tr>
                            <tr>
                                <td style="font-style:italic" class="text-md">@if($c->hepatitis != 1)Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if($c->asthma != 1 ) Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if($c->tbparu != 1 ) Tidak Ada @else Ya @endif</td>
                                <td style="font-style:italic" class="text-md">@if($c->ginjal != 1 )
                                Tidak Ada @else Ya @endif</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Riwayat Penyakit Lain</td>
                                <td colspan="4" style="font-style:italic" class="text-md">@if($c->riwayatlain != 1)Tidak ada @else Lainnya @endif</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Keadaan Umum</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->keadaanumum }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Kesadaran</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->kesadaran }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Diagnosa</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->diagnosakerja }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tindak Lanjut</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->tindaklanjut }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Hasil Pemeriksaan Penunjang</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->hasilpenunjang }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Rencana Kerja</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->rencanakerja }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Pemeriksa</td>
                                <td colspan="4" style="font-style:italic" class="text-md">{{ $c->namadokter }}
                                    <img src="{{ $c->signature_dokter }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-info">Penunjang</button>
                                        <button type="button" class="btn btn-warning">Tindakan</button>
                                        <button type="button" class="btn btn-danger">Farmasi</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <table class="table table-sm table-bordered">          
            <tr>
                <td>Penurunan Berat Badan</td>
                <td>{{ $c->beratskrininggizi }} | keterangan : {{ $c->skorskrininggizi}}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Penurunan Asupan Makanan</td>
                <td>{{ $c->status_asupanmkanan }} | keterangan : {{ $c->skorasupanmkanan}}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Penurunan Berat Badan</td>
                <td>{{ $c->beratskrininggizi }} | keterangan : {{ $c->skorskrininggizi}}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Penyakit Lain / Diagnosa Khusus</td>
                <td>{{ $c->penyakitlainpasien }} | keterangan : {{ $c->diagnosakhusus}}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Resiko Malnutrisi</td>
                <td>{{ $c->resikomalnutrisi }} | keterangan : {{ $c->diagnosakhusus}}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Diagnosa Keperawatan</td>
                <td>{{ $c->diagnosakeperawatan }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Rencana Keperawatan</td>
                <td>{{ $c->rencanakeperawatan }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Tindakan Keperawatan</td>
                <td>{{ $c->tindakankeperawatan }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Evaluasi Keperawatan</td>
                <td>{{ $c->evaluasikeperawatan }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Nama Pemeriksan</td>
                <td>{{ $c->namapemeriksa }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
        </tbody>
    </table> -->
    @endforeach
</div>