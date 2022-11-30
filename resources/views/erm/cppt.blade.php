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
    <table class="table table-sm table-bordered">
        <thead>
            <th>Tanggal {{ $c->tanggalkunjungan }} | {{ $c->namaunit }}</th>
        </thead>
    </table>
    <table class="table table-sm table-bordered">
        <thead>
            <th colspan="2">Assesmen Awal Keperawatan</th>
            <th colspan="2">Assesmen Awal Medis</th>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="text-bold text-center">Sumber Data Periksa</td>
            </tr>
            <tr>
                <td style="font-style:italic" class="text-center" colspan="4">{{ $c->sumberdataperiksa}}</td>
            </tr>
            <tr>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhanutama }}</td>
                <td>Keluhan Utama</td>
                <td>{{ $c->keluhan_utama }}</td>
            </tr>
            <tr>
                <td>Tekanan Darah</td>
                <td>{{ $c->tekanandarah }}</td>
                <td>Riwayat Penyakit</td>
                <td>{{ $c->riwayat_penyakit }}</td>
            </tr>
            <tr>
                <td>Frekuensi Nadi</td>
                <td>{{ $c->frekuensinadi }}</td>
                <td>Hipertensi</td>
                <td>{{ $c->hipertensi }}</td>
            </tr>
            <tr>
                <td>Frekuensi Napas</td>
                <td>{{ $c->frekuensinapas }}</td>
                <td>Kencing Manis</td>
                <td>{{ $c->kencingmanis }}</td>
            </tr>
            <tr>
                <td>Suhu Tubuh</td>
                <td>{{ $c->suhutubuh }}</td>
                <td>Jantung</td>
                <td>{{ $c->jantung }}</td>
            </tr>
            <tr>
                <td>Riwayat Psikologis</td>
                <td>{{ $c->Riwayatpsikologi }}</td>
                <td>Stroke</td>
                <td>{{ $c->stroke }}</td>
            </tr>
            <tr>
                <td>Penggunaan Alat Bantu</td>
                <td>{{ $c->penggunaanalatbantu }}</td>
                <td>Hepatitis</td>
                <td>{{ $c->hepatitis }}</td>
            </tr>
            <tr>
                <td>Cacat Tubuh</td>
                <td>{{ $c->cacattubuh }} | keterangan : {{ $c->keterangancacattubuh}}</td>
                <td>Asthma</td>
                <td>{{ $c->asthma }}</td>
            </tr>
            <tr>
                <td>Keluhan Nyeri</td>
                <td>{{ $c->Keluhannyeri }} | keterangan : {{ $c->skalenyeripasien}}</td>
                <td>Ginjal</td>
                <td>{{ $c->ginjal }}</td>
            </tr>
            <tr>
                <td>Resiko Jatuh</td>
                <td>{{ $c->resikojatuh }}</td>
                <td>TB Paru</td>
                <td>{{ $c->tbparu }}</td>
            </tr>
            <tr>
                <td>Skrining Gizi</td>
                <td>{{ $c->Skrininggizi }} | keterangan : {{ $c->skorskrininggizi}}</td>
                <td>Riwayat lain</td>
                <td>{{ $c->riwayatlain }}</td>
            </tr>
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
    </table>
    @endforeach
</div>