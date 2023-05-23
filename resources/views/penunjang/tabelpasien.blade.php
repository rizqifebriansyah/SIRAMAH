
<table id="datapasien" class="table table-sm text-sm table-bordered table-hover">
            <thead>
                <th hidden>Kode Order</th>
                <th>Tanggal Masuk</th>
                <th>Nomor RM</th>
                <th>Nama</th>
                <th>alamat</th>
                <th>Keterangan</th>
                <th hidden>Unit</th>
                <th>Poliklinik Asal</th>
            </thead>
            <tbody>
            @foreach ($pasienorder as $po)
                <tr>
                    <td hidden> {{ $po->kode_order_header }}</td>
                    <!-- <td>

                        <span class="right badge badge-danger">Perawat Belum mengisi pemeriksaan</span>

                        <span class="right badge badge-success">Sudah diisi</span>


                    </td> -->
                    <td>{{ $po-> tgl_input }}</td>
                    <td>{{ $po-> no_rm }}</td>
                    <td> </td>
                    <td class="text-xxs"></td>
                    <td class="text-xxs"></td>
                    <td hidden></td>
                    <td>{{ $po->asal_unit }}</td>
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