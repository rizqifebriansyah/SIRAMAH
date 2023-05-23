<table id="datapasienorder" class="table datapasienorder table-sm text-sm table-bordered table-hover">
    <thead class="bg-success">
        <th hidden>no</th>
        <th>Kode Layanan Order</th>
        <th hidden>Id</th>
        <th>Tanggal Masuk</th>
        <th>Nomor RM</th>
        <th>Nama</th>
        <th>Poliklinik Asal</th>
        <th>Penjamin</th>
    </thead>
    <tbody>
        @foreach ($pasienorder as $i=>$key)
        <tr index="{{$i}}" id=" {{$key->id}}" class="pasienterpilih toastsDefaultSuccess" no_rm="{{ $key->NO_RM }}" nama="{{ $key->NAMA_PX }}" dokter="{{ $key->nama_dokter_kirim }}" penjamin="{{ $key -> kode_penjamin }}" tgl_order="{{ $key-> tgl_order }}">
            <td> {{ $key->kode_order}} </td>
            <!-- <td>

                        <span class="right badge badge-danger">Perawat Belum mengisi pemeriksaan</span>

                        <span class="right badge badge-success">Sudah diisi</span>


                    </td> -->
            <td hidden>{{$key->id}}</td>
            <td hidden>{{ $i}}</td>
            <td>{{ $key-> tgl_order }}</td>
            <td>{{ $key-> NO_RM }}</td>
            <td> {{ $key->NAMA_PX}} </td>
            <td>{{ $key->unit_pengirim }}</td>
            <td>
                @if ($key->NAMA_PENJAMIN == 'JKN Perusahaan / KIS (BPJS)' )
                <p class="badge badge-success">JKN Perusahaan</p>
                @elseif ($key->NAMA_PENJAMIN == 'JKN Mandiri / KIS (BPJS)')
                <p class="badge badge-success">JKN Mandiri</p>
                @elseif ($key->NAMA_PENJAMIN == 'Askes PNS')
                <p class="badge badge-success">Askes PNS</p>
                @elseif ($key->NAMA_PENJAMIN == 'PBI APBD')
                <p class="badge badge-warning">PBI APBD</p>
                @elseif ($key->NAMA_PENJAMIN == 'PBI APBN')
                <p class="badge badge-warning">PBI APBN</p>
                @elseif ($key->NAMA_PENJAMIN == 'PRIBADI')
                <p class="badge badge-primary">PRIBADI</p>
                @elseif ($key->NAMA_PENJAMIN == 'Jasa Raharja + BPJS')
                <p class="badge badge-secondary">JR + BPJS</p>
                @else
                <p class="badge badge-danger">{{ $key->NAMA_PENJAMIN }}</p>
                @endif
                <br>
                @if($key->status_pembayaran == 'CLS')
                <span class="right badge badge-success">Selesai</span>
                
                @endif
            </td>

        </tr>
        @endforeach

    </tbody>
</table>

<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            ambildata()
            bunyi()
        }, 600000);

    });
    function bunyi() {
      var bel = new Audio('notif.mp3');
      bel.play();
    }
    function ambildata() {

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
            },
            type: "post",
            url: " {{ route('ambildata')}}",
            error: function(data) {
                spinner.hide();
                alert('oke!!')
            },
            success: function(response) {
                spinner.hide();
                $('.ordertable').html(response);
            }
        });
    }
    $(function() {
        $("#datapasienorder").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#datapasienorder').on('click', '.pasienterpilih', function() {
        spinner = $('#loader2');
        spinner.show();
        id = $(this).attr('id')
        tgl_order = $(this).attr('tgl_order')
        no_rm = $(this).attr('no_rm')
        index = parseInt($(this).attr('index'))
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                tgl_order,
                no_rm,
                id,
                index

            },

            url: " {{ route('pasiendetail') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#tgl_order').val(response.tgl_order);
                $('#no_rm').val(response.no_rm);
                $('#id').val(response.id);
                $('.coba').html(response);
            }
        });
    });
</script>