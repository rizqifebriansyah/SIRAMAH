@if(count($riwayat) > 0)
<table id="tabeltindakantdy" class="table table-sm">
    <thead>
        <th>NAMA TARIF</th>
        <th>JUMLAH</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach($riwayat as $r)
        <tr>
            <td>{{ $r-> NAMA_TARIF }}</td>
            <td>{{ $r->jumlah_layanan }}</td>
            <td>
                <button class="badge badge-danger bataltindakan" idheader="{{ $r->id_header }}">batal</button>
                <button class="badge badge-warning returtindakan" idheader="{{ $r->id_header }}" iddetail="{{ $r->id_detail }}">retur</button>        
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h5>Belum ada tindakan yang diinput !</h5>
@endif
<script>
    $(function() {
        $("#tabeltindakantdy").DataTable({
            "responsive": false,
            "lengthChange": false,
            "searching": false,
            "pageLength": 2,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('.bataltindakan').click(function() {
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
            url: '<?= route('bataltindakan') ?>',
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
                riwayattindakan_hariini()
                cek_resume()
            }
        });
    });
    $('.returtindakan').click(function() {
        spinner = $('#loader2');
        spinner.show();
        iddetail = $(this).attr('iddetail')
        idheader = $(this).attr('idheader')
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                iddetail,
                idheader,
                kodekunjungan
            },
            url: '<?= route('returtindakan') ?>',
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
                riwayattindakan_hariini()
                cek_resume()
            }
        });
    });
</script>