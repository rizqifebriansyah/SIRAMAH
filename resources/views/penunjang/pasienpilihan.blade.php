<div class=" col-md-11" style="margin-bottom:10px ;">

    <a style="margin-left: 32px;" rel="noopener" href="{{ route('laboratorium')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Home
    </a>
</div>


<div class=" col-md-11" style="margin-left:32px ;">
    <div class="card">

        <div class="card-header bg-secondary">Data Pasien</div>

        <div class="card-body">
            <div class="form-group">

                <div class="row">
                    <div class="col-2">
                        <label for="inputName">No RM </label>
                        <input readonly type="text" id="norm" value="{{ $pasienkunjungan[0]->no_rm }}" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="inputName">Nama </label>
                        <input readonly type="text" id="nama" value="{{ $pasienkunjungan[0]->nama_px }} " class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="inputName">Unit asal </label>
                        <input readonly type="text" id="nama_unit" value="{{ $pasienkunjungan[0]->nama_unit }}" class="form-control">
                        <input hidden type="text" id="kodeunit" value="{{ $pasienkunjungan[0]->kode_unit }}" class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="inputName">Kelas Unit </label>
                        <input readonly type="text" id="kelas_unit" value="{{ $pasienkunjungan[0]->KELAS_UNIT }} " class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="inputName">Kelas</label>
                        <input readonly type="text" id="kelas" value="{{ $pasienkunjungan[0]->kelas }} " class="form-control">
                    </div>
                </div>
                <input hidden type="text" id="kodekunjungan" value="{{ $pasienkunjungan[0]->kode_kunjungan}}" class="form-control">
                <input hidden type="text" id="kodepenjamin" value="{{ $pasienkunjungan[0]->kode_penjamin }}" class="form-control">
                <input hidden type="text" id="kelas" value="{{ $pasienkunjungan[0]->kelas }}" class="form-control">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-5">
                        <label for="inputName">Alamat Pasien</label>
                        <textarea disabled class="form-control" rows="2">{{ $pasienkunjungan[0]->alamat }}</textarea>
                        <input hidden type="text" id="alamat" rows="3" value="{{ $pasienkunjungan[0]->alamat }}" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="inputName">Dokter Pengirim</label>
                        <input readonly type="text" id="nama_paramedis" value="{{ $pasienkunjungan[0]->nama_paramedis }}" class="form-control">
                        <input hidden type="text" id="dokter" value="{{ $pasienkunjungan[0]->Dokter }}" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="inputName">Diagnosa Pasien</label>
                        <textarea disabled class="form-control" rows="2">{{ $pasienkunjungan[0]->DIAGX }}</textarea>
                        <input hidden type="text" id="diagnosa" value="{{ $pasienkunjungan[0]->DIAGX }}" class="form-control">
                    </div>

                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputName">Umur</label>
                        <input readonly type="text" id="umur" value="{{ $pasienkunjungan[0]->umur }}" class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="inputName">Penjamin </label>
                        <input readonly type="text" id="nama_penjamin" value="{{ $pasienkunjungan[0]->nama_penjamin }} " class="form-control">
                    </div>
                    <div class="col-2">
                        <label for="inputName">Grand Total Layanan </label>
                        @if ($pasienkunjungan[0]->kode_penjamin == 'P01' )
                        <input readonly type="text" id="gt" value="TUNAI " class="form-control">
                        @else
                        <input readonly type="text" id="gt" value="KREDIT " class="form-control">
                        @endif
                    </div>
                    <div class="col-2">
                        <label for="inputName">PACS </label><br>
                        <input type="checkbox" name="pacs" id="pacs" value="pacs" checked>
                        <label  for="ris">BRIDGING PACS</label>
                    </div>
                    <div class="col-2">
                        <label for="inputName">RIWAYAT </label><br>

                        <button class="btn btn-success riwayat" id="riwayat"><i class="fas fa-eye">
                            </i> Lihat Riwayat</button>
                    </div>


                </div>
            </div>
            <div class="form-group riwayatpasien" id="riwayatpasien">
                
            </div>
        </div>
    </div>
</div>

<div class="col-md-6" style="margin-left: 30px;">
    <div class="card">
        <div class="card-header bg-secondary">Pilih Layanan</div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <div class="form-group">
                        <table id="tabeltindakan" class="table table-sm mt-3 table-hover">
                            <thead>
                                <th>Nama tindakan</th>
                            </thead>
                            <tbody>

                                @if ($unit == 3002)

                                @foreach ($paket as $p)
                                <tr class="pilihlayanan" jenis="paket" namatindakan="{{ $p->nama }}" tarif="0" kode="{{ $p->id_paket }}">
                                    <td>{{ $p->nama }}</td>
                                </tr>
                                @endforeach

                                @foreach($layanan as $t)
                                <tr class="pilihlayanan" jenis="nonpaket" namatindakan="{{ $t->Tindakan }}" tarif="{{ $t->tarif }}" kode="{{ $t->kode }}">
                                    <td>{{ $t->Tindakan }}</td>
                                </tr>
                                @endforeach

                                @else
                                @foreach($layanan as $t)
                                <tr class="pilihlayanan" jenis="nonpaket" namatindakan="{{ $t->Tindakan }}" tarif="{{ $t->tarif }}" kode="{{ $t->kode }}">
                                    <td>{{ $t->Tindakan }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.tab-pane -->


                <!-- /.tab-pane -->

            </div>
        </div>

    </div>
    <!-- /.card -->
</div>

@if ($unit == 3002)
<div class="col-md-5">
    <div class="card">
        <div class="card-header bg-secondary">Tindakan / Layanan Pasien</div>
        <div class="card-body">
            <form action="" method="post" class="formtindakan">
                <div class="input_fields_wrap">
                    <div>
                    </div>
                    <button type="button" class="btn btn-warning mb-2 simpanlayanan" id="simpanlayanan">Simpan Tindakan</button>
                    <label class="bg-primary" for="lis">LIS</label>
                    <input type="checkbox" name="lis" id="lis" value="lis" checked>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <p>pilih layanan untuk pasien</p>
        </div>
    </div>
</div>
@else
<div class="col-md-5">
    <div class="card">
        <div class="card-header bg-secondary">Tindakan / Layanan Pasien</div>
        <div class="card-body">
            <form action="" method="post" class="formtindakan">
                <div class="input_fields_wrap">
                    <div>
                    </div>
                    <button type="button" class="btn btn-warning mb-2 simpanradiologi" id="simpanradiologi">Simpan Tindakan</button>

                </div>
            </form>
        </div>
        <div class="card-footer">
            <p>pilih layanan untuk pasien</p>
        </div>
    </div>
</div>
@endif



<div style="margin-top:100px ;"></div>


<script>
    function berhasil() {
        var bel = new Audio('berhasil.mp3');
        bel.play();
    }

    function retur() {
        var bel = new Audio('retur.mp3');
        bel.play();
    }

    function batal() {
        var bel = new Audio('batal.mp3');
        bel.play();
    }
    $(function() {
        $("#tabelpasieno").DataTable({
            "resposive": false,
            "lengthChange": false,
            "autowidth": false,
        });
    });
    $(function() {
        $("#tabeldiagnosa").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autowidth": false,
        });
    });
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
        id = $(this).attr('id')
        jenis = $(this).attr('jenis')


        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                kode +
                '"><input hidden  readonly type="" class="form-control form-control-sm" id="" name="jenis" value="' +
                jenis +
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


    function pilihpaket() {
        spinner = $('#loader2');
        spinner.show();
        kelas = $('#kelas').val()
        idpaket = $('#idpaket').val()

        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                kelas,
                idpaket
            },
            url: "{{ route('tampilpaket') }}",
            error: function(data) {
                spinner.hide()
                alert('Errorrr!!!')
            },
            success: function(response) {
                spinner.hide();
                $('.tabelpaket').html(response);
            }
        })
    }
    $(".riwayat").click(function() {
        spinner = $('#loader2');
        spinner.show();
        norm = $('#norm').val()
        kodeunit = $('#kodeunit').val()
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                norm,
                kodeunit

            },
            url: " {{ route('riwayatpasien') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#norm').val(response.norm);
                $('#kodeunit').val(response.kodeunit);
                $('.riwayatpasien').html(response);
            }
        });
    });

    $(".simpanlayanan").click(function() {
        var data = $('.formtindakan').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        kodepenjamin = $('#kodepenjamin').val()
        kodepenunjang = $('#namapenunjang').val()
        dokter = $('#dokter').val()
        diagnosa = $('#diagnosa').val()
        lis = $('#lis').val()


        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan: kodekunjungan,
                kodepenunjang: $('#namapenunjang').val(),
                dokter,
                kodepenjamin,
                diagnosa,
                lis
            },
            url: '<?= route('simpanorderpasien') ?>',
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
                    pdf()
                    berhasil()
                    document.location.reload();

                }
            }
        });
    });
    $(".simpanradiologi").click(function() {
        var data = $('.formtindakan').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        var kodepenjamin = $('#kodepenjamin').val()
        var kodepenunjang = $('#namapenunjang').val()
        var dokter = $('#dokter').val()
        var diagnosa = $('#diagnosa').val()
        var kodeunit = $('#kodeunit').val()
        var kelasunit = $('#kelas_unit').val()
        var kelas = $('#kelas').val()

        var gt = $('#gt').val()
        var norm = $('#norm').val()
        var namaunit = $('#nama_unit').val()

        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan: $('#kodekunjungan').val(),
                kodepenunjang: $('#namapenunjang').val(),
                dokter: $('#dokter').val(),
                kodepenjamin: $('#kodepenjamin').val(),
                diagnosa: $('#diagnosa').val(),
                kodeunit: $('#kodeunit').val(),
                gt: $('#gt').val(),
                kelasunit: $('#kelasunit').val(),
                norm: $('#norm').val(),
                namaunit: $('#namaunit').val(),
                kelas: $('#kelas').val()
            },
            url: '<?= route('simpanorderradiologi') ?>',
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
                        text: 'data berhasil disimpan',
                        footer: ''
                    })
                    pdf()

                }
            }
        });
    });

    function pdf() {
        id = $(this).attr('id')
        kode_header = $('#kode_order').val()
        window.open('cetakorder/' + id + '/' + kode_header);
    }
</script>