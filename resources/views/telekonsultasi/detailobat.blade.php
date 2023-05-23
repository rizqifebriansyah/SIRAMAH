<table id="tabelorder" class="table table-sm mt-3 table-hover">
    <thead>
        <th>Nama Obat</th>
        <th>Dosis</th>
        <th>Stok</th>
    </thead>
    <tbody>


        @foreach($layanan as $t)
        <tr class="pilihobat" namaobat="{{ $t->nama_barang }}" aturan="{{ $t->aturan_pakai }}" kode="{{ $t->kode_barang }}">
            <td>{{ $t->nama_barang }}</td>
            <td>{{ $t->dosis }}</td>
            <td>{{ $t->stok_current }}</td>


        </tr>
        @endforeach


    </tbody>
</table>

<script>
     $(function() {
        $("#tabelorder").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabelorder').on('click', '.pilihobat', function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var x = 1; //initlal text box count
        kode = $(this).attr('kode')
        namaobat = $(this).attr('namaobat')
        aturan = $(this).attr('aturan')
        id = $(this).attr('id')

        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namaobat" value="' +
                namaobat +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kode" value="' +
                kode +'"></div><div class="form-group col-md-3"><label for="inputPassword4">aturan</label><input type="" readonly class=" form-control form-control-sm" id="" name="aturan" value="' + aturan + '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="signa" name="signa" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Ket</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove 
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
</script>