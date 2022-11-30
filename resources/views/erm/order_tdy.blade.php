@if(count($riwayat) > 0)
<table id="tabelordertdy" class="table table-sm table-bordered">
    <thead>
        <th>Unit Tujuan</th>
        <th>Nama Layanan</th>
        <th class="text-center">Jumlah Layanan</th>
        <th class="text-center">Action</th>
    </thead>
    <tbody>
        @foreach($riwayat as $r)
        <tr>
            <td>{{ $r->nama_unit_tujuan }}</td>
            <td>{{ $r->NAMA_TARIF }}</td>
            <td class="text-center">{{ $r->jumlah_layanan }}</td>
            <td class="text-center">
                <button class="badge badge-danger batalorder" idheader="{{ $r->id_header }}">batal</button>
                <button class="badge badge-warning returorder" iddetail="{{ $r->id_detail }}">retur</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h5 class="text-danger">Hari ini belum ada order penunjang yang diinput !</h5>
@endif

<script>
    $(function() {
        $("#tabelordertdy").DataTable({
            "responsive": false,
            "lengthChange": false,
            "searching": false,
            "pageLength": 2,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('.batalorder').click(function() {
        spinner = $('#loader2');
        spinner.show();
        idheader = $(this).attr('idheader')
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                idheader,
                kodekunjungan
            },
            url: '<?= route('batalorder') ?>',
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
                Swal.fire({
                    icon: 'success',
                    title: 'OK',
                    text: data.message,
                    footer: ''
                })
                orderhari_ini()
                cek_resume()
            }
        });
    });
    $('.returorder').click(function() {
        spinner = $('#loader2');
        spinner.show();
        iddetail = $(this).attr('iddetail')
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                iddetail,
                kodekunjungan
            },
            url: '<?= route('returorder') ?>',
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
                Swal.fire({
                    icon: 'success',
                    title: 'OK',
                    text: data.message,
                    footer: ''
                })
                orderhari_ini()
                cek_resume()
            }
        });
    });
</script>