<table class="table table-md table-striped">
    <tr>
        <td class="text-bold">Tanggal Periksa</td>
        <td>{{ $hasil[0]->tanggalperiksa }}</td>
        <td class="text-bold">Sumber Data</td>
        <td>{{ $hasil[0]->sumberdataperiksa }}</td>
    </tr>
    <tr>
        <td class="text-bold">Tekanan Darah</td>
        <td>{{ $hasil[0]->tekanandarah }}</td>
        <td class="text-bold">Frekuensi Nadi</td>
        <td>{{ $hasil[0]->frekuensinadi }}</td>
    </tr>
    <tr>
        <td class="text-bold">Frekuensi Nafas</td>
        <td>{{ $hasil[0]->frekuensinapas }}</td>
        <td class="text-bold">Suhu Tubuh</td>
        <td>{{ $hasil[0]->suhutubuh }}</td>
    </tr>
    <tr>
        <td class="text-bold">Keluhan Utama</td>
        <td colspan="3">{{ $hasil[0]->keluhanutama }}</td>
    </tr>
    <tr>
        <td class="text-bold">Riwayat Psikologis</td>
        <td colspan="3">{{ $hasil[0]->Riwayatpsikologi }}</td>
    </tr>
    <tr>
        <td class="text-bold">Penggunaan Alat Bantu</td>
        <td colspan="3">{{ $hasil[0]->penggunaanalatbantu }}</td>
    </tr>
    <tr>
        <td class="text-bold">Cacat Tubuh</td>
        <td colspan="3">{{ $hasil[0]->cacattubuh }} | {{ $hasil[0]->keterangancacattubuh }}</td>
    </tr>
    <tr>
        <td class="text-bold">Keluhan Nyeri</td>
        <td colspan="3">{{ $hasil[0]->Keluhannyeri }} | {{ $hasil[0]->skalenyeripasien }}</td>
    </tr>
    <tr>
        <td class="text-bold">Resiko Jatuh</td>
        <td colspan="3">{{ $hasil[0]->resikojatuh }}</td>
    </tr>
    <tr>
        <td class="text-bold">Penurunan Berat Badan</td>
        <td colspan="3">{{ $hasil[0]->Skrininggizi }} | {{ $hasil[0]->beratskrininggizi }}</td>
    </tr>
    <tr>
        <td class="text-bold">Kekurangan Asupan Makanan</td>
        <td colspan="3">{{ $hasil[0]->status_asupanmkanan }} </td>
    </tr>
    <tr>
        <td class="text-bold">Diagnosa Penyakit Lain</td>
        <td colspan="3">{{ $hasil[0]->diagnosakhusus }} | {{ $hasil[0]->penyakitlainpasien }} </td>
    </tr>
    <tr>
        <td class="text-bold">Resiko malnutrisi</td>
        <td colspan="3">{{ $hasil[0]->resikomalnutrisi }} </td>
    </tr>
    <tr>
        <td class="text-bold">Diagnosa Keperawatan</td>
        <td>{{ $hasil[0]->diagnosakeperawatan }} </td>
        <td class="text-bold">Rencana Keperawatan</td>
        <td>{{ $hasil[0]->rencanakeperawatan }} </td>
    </tr>
    <tr>
        <td class="text-bold">Tindakan Keperawatan</td>
        <td>{{ $hasil[0]->tindakankeperawatan }} </td>
        <td class="text-bold">Evaluasi Keperawatan</td>
        <td>{{ $hasil[0]->evaluasikeperawatan }} </td>
    </tr>
    <tr>
        <td class="text-bold">Tanggal assesmen dan nama Perawat</td>
        <td colspan="3">{{ $hasil[0]->tanggalassemen }}, {{ $hasil[0]->namapemeriksa }} 
            <img src="{{ $hasil[0]->signature }}" alt="">
        </td>
    </tr>
</table>