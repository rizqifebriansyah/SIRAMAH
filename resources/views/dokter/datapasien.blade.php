<table id="datapasien" class="table table-sm text-sm table-bordered table-hover">
    <thead>
        <th hidden>Kode kunjungan</th>
        <th>Tanggal Masuk</th>
        <th>Nomor RM</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>alamat</th>
        <th>Keterangan</th>
        <th hidden>Unit</th>
        <th>Poliklinik Asal</th>
    </thead>
    <tbody>
        @foreach ($pasien as $p)
        <tr onclick="location.href='erm/dokter/{{$p->kode_kunjungan}}'" class="pilihpasien toastsDefaultSuccess" nomor-rm="{{ $p->no_rm }}" nama="{{ $p->nama }}"
         kodekunjungan="{{ $p->kode_kunjungan }}" alamat="{{ $p->alamat }}" counter="{{ $p->counter }}" umur="{{ $p->umur }}" unit="{{ $p->unit }}" tglmasuk="{{ $p->tgl_masuk }}">
            <td hidden>{{ $p->kode_kunjungan }}</td>
            <td> 
            @if($p->kj == NULL)    
            <span class="right badge badge-danger">Perawat Belum mengisi pemeriksaan</span>
            @else
            <span class="right badge badge-success">Sudah diisi</span>
            @endif
            {{ $p->tgl_masuk }}
            </td>
            <td>{{ $p->no_rm }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->umur }} tahun</td>
            <td class="text-xxs">{{ $p->alamat }}</td>
            <td class="text-xxs">@if($p->data_erm == 0)<button class="badge badge-danger">tidak ada berkas erm</button> @endif</td>
            <td hidden>{{ $p->unit }}</td>
            <td>{{ $p->asalunit }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#datapasien").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>