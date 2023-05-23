<a style="margin-left: 45px;" rel="noopener" href="{{ route('laboratorium')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Home
</a>
<div style="margin-top: 10px;" class="col-md-12"></div>
<div class="col-md-5" style="margin-left:30px ;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Pasien </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">No RM</label>
                <input readonly type="text" norm="norm" value="{{ $pasien[0]->no_rm }}" class="form-control">
                <input hidden type="text" kodekunjungan="kodekunjungan" value="{{ $pasien[0]->kode_kunjungan}}" class="form-control">
                <input hidden type="text" kodepenjamin="kodepenjamin" value="{{ $pasien[0]->kode_penjamin }}" class="form-control">
                <input hidden type="text" kelas="kelas" value="{{ $pasien[0]->kelas }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputName">Nama Pasien</label>
                <input readonly type="text" id="nama" value="{{ $pasien[0]->nama_px }} " class="form-control">
            </div>
            <div class="form-group">
                <label for="inputName">Diagnosa Pasien</label>
                <input readonly type="text" id="diagnosa" value="{{ $orderpoli[0]->diagnosa }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputStatus">Jenis Kelamin</label>
                <input readonly type="text" id="jk" value="@if ($pasien[0]->jenis_kelamin == 'L' ) Laki - Laki @else Perempuan @endif" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputEstimatedBudget">Dokter Pengirim</label>
                <input readonly type="text" id="dokter" value="{{ $orderpoli[0]->nama_dokter }}" class="form-control">

            </div>
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-warning">DETAIL TINDAKAN ORDER POLI
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">

            <form action="" method="post" class="orderpoli">
                @if ($unit == 3002)
                <button type="button" class="badge badge-success mb-2 simpanorderpoli" id="simpanorderpoli">Simpan </button>
                <button type="button" class="badge badge-warning mb-2 returorderpoli" iddetail="{{$orderpoli[0]->id_layanan_detail }}">Retur</button>
                <button type="button" class="badge badge-danger mb-2 batalorderpoli" idheader="{{$orderpoli[0]->id }}">Batal </button>
                <input type="checkbox" value="LIS" name="lis" id="lis" checked>
                <p class="badge badge-secondary">LIS</p>
                @else
                <button type="button" class="badge badge-success mb-2 simpanrad" id="simpanrad">Simpan </button>
                <button type="button" class="badge badge-warning mb-2 returorderpoli" iddetail="{{$orderpoli[0]->id_layanan_detail }}">Retur</button>
                <button type="button" class="badge badge-danger mb-2 batalorderpoli" idheader="{{$orderpoli[0]->id }}">Batal </button>
                @endif

                @foreach ($orderpoli as $order)

                <div>
                    <div class="form-row text-xs">
                        <div class="form-group col-md-5">
                            <label for="">Tindakan </label>
                            <input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="{{ $order->nama_tarif }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Tarif</label>
                            <input readonly type="" class="form-control form-control-sm" id="" name="tarif" value=" {{$order->total_tarif}}">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputPassword4">Jumlah</label>
                            <input type="" class="form-control form-control-sm" id="" name="qty" value="{{ $order->jumlah_layanan }}">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputPassword4">Disc</label>
                            <input type="" class="form-control form-control-sm" id="" name="disc" value="{{ $order->diskon_layanan}}">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="inputPassword4">Cyto</label>
                            <input type="" class="form-control form-control-sm" id="" name="cyto" value="{{ $order->cyto}}">
                            <input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="{{ $order->kode_tarif_detail }}">
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
        </form>

    </div>
</div>


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
    $('.batalorderpoli').click(function() {
        spinner = $('#loader2');
        spinner.show();
        idheader = $(this).attr('idheader')
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                idheader
            },
            url: '<?= route('batalorder') ?>',

            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops..',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'success',
                    title: 'ok..',
                    text: data.message,
                    footer: ''
                })
                batal()
            }
        });
    });
    $('.returorderpoli').click(function() {
        spinner = $('#loader2');
        spinner.show();
        iddetail = $(this).attr('iddetail')
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                iddetail,
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
                retur()
            }
        });
    });
    $(".simpanrad").click(function() {
        var data = $('.orderpoli').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        kodepenjamin = $('#kodepenjamin').val()
        kodepenunjang = $('#namapenunjang').val()
        dokter = $('#dokter').val()
        diagnosa = $('#diagnosa').val()

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
                diagnosa
            },
            url: '<?= route('simpanradiologi') ?>',
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
    $(".simpanorderpoli").click(function() {
        var data = $('.orderpoli').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        kodepenjamin = $('#kodepenjamin').val()
        kodepenunjang = $('#namapenunjang').val()
        dokter = $('#dokter').val()
        diagnosa = $('#diagnosa').val()
        lis = $('#lis').val()
        alert(lis)

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
                diagnosa
            },
            url: '<?= route('simpanorderpoli') ?>',
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
</script>