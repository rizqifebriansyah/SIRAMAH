<div class="container-fluid">
    @if($cek_asmed > 0)
    <div class="row">
        <div class="col-md-5" style="margin-top:20px">
            <h5>Terapi / Tindakan Medis</h5>
            <table id="tabeltindakan" class="table table-hover table-sm">
                <thead>
                    <th>Nama tindakan</th>
                </thead>
                <tbody>
                    @foreach($tindakan as $t)
                    <tr class="pilihlayanan" namatindakan="{{ $t->Tindakan }}" tarif="{{ $t->tarif }}" kode="{{ $t->kode }}">
                        <td>{{ $t->Tindakan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-7" style="margin-top:20px">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header bg-warning" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Riwayat Tindakan Hari Ini
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="tindakanhariini"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-success">Tindakan / Layanan Pasien</div>
                <div class="card-body">
                    <form action="" method="post" class="formtindakan">
                        <div class="input_fields_wrap">
                            <div>
                            </div>
                            <button type="button" class="btn btn-warning mb-2 simpanlayanan" id="simpanlayanan">Simpan Tindakan</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>pilih layanan untuk pasien</p>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...</h3>
          <p>
            Anda harus mengisi assesmen awal medis terlebih dulu ,<a href="../../index.html"> isi assesmen awal medis ...</a>
          </p>
        </div>
    @endif
    <script>
        $(function() {
            $("#tabeltindakan").DataTable({
                "responsive": false,
                "lengthChange": false,
                "pageLength": 5,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });
        $('#tabeltindakan').on('click', '.pilihlayanan', function() {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove 
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        });
        $(".simpanlayanan").click(function() {
            var data = $('.formtindakan').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                    kodekunjungan: kodekunjungan,
                },
                url: '<?= route('simpanlayanan') ?>',
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(data) {
                    console.log(data)
                    if (data.kode == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: 'Data berhasil disimpan!',
                            footer: ''
                        })
                        riwayattindakan_hariini()
                        cek_resume()
                    }
                }
            });
        });
        onload = riwayattindakan_hariini()

        function riwayattindakan_hariini() {
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('tindakanhariini') ?>',
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
                    $('#tindakanhariini').html(response)
                }
            });
        }
    </script>