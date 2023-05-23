@extends('erm.header')
<link rel="stylesheet" type="text/css" href="https://cdn.prinsh.com/NathanPrinsley-textstyle/nprinsh-stext.css" />
<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@section('container')
<div class="row coba" style="margin-top:130px">
    <div class="col-lg-4 col-4 jumlahpasien" style="margin-left: 30px;">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$jumlahpasien}}</h3>

                <p>Riwayat Pasien Hari Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-book"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-4 jumlahorder">
        <!-- small box -->
        <div class="small-box bg-success ">
            <div class="inner">
                <h3>{{$jumlahorder}}</h3>

                <p>Order ERM</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-4 jumlahorderpasien">
        <!-- small box -->
        <div class="small-box bg-warning ">
            <div class="inner">
                <h3>{{$jumlahorderpasien}}</h3>

                <p>Order </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div id="pasienpilihan" class="pasienpilihan row" style="margin-top:50px ;">

    </div>
    <div id="pasiendetail" class="pasiendetail col-12" style="margin-top:50px ;">

    </div>


    <div class="col-md-11" style="margin-left: 30px;">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#datapasien" data-toggle="tab">Data Pasien</a></li>
                    <li class="nav-item"><a class="nav-link" href="#riwayat" data-toggle="tab">Riwayat Pasien</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="datapasien">
                        <div class="col-sm-11 " style="margin-left:30px">
                            <h4 class="nprinsley-text-glitchan">DATA PASIEN</h4>

                            <div class="container" style="margin-top:15px ;">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="norm" id="norm" placeholder="RM ..">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="nama" id="nama" placeholder="nama ..">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat ..">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" id="tanggal_kunjungan" autocomplete="off" data-language="en" data-date-format="yyyy-mm-dd" placeholder="Tanggal">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" onclick="caripasien()"> <i class="bi bi-search-heart"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="container tablependaftaran" style="margin-top:15px ;">
                                <table id="datapendaftaran" class="table table-sm text-sm table-bordered table-hover">

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="riwayat">
                        <div class="col-sm-11" style="margin-left:30px">

                            <h4 class="nprinsley-text-glitchan">RIWAYAT ORDER </h4>

                            <div class="container" style="margin-top:15px ;">

                                <div class="row ">
                                    <div class="col-sm-5 ">
                                        <input type="text" class="form-control" name="no_rm" id="no_rm" placeholder="nomor RM ..">
                                    </div>

                                    <div class="col-sm-5 ">
                                        <input type="date" class="form-control " autocomplete="off" data-language="en" data-date-format="yyyy-mm-dd" placeholder="Tanggal" name="tanggal_order" id="tanggal_order">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" onclick="cariordertanggal()"> <i class="bi bi-search-heart"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="container ordertable" style="margin-top:15px ;">
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
                                        <tr index="{{$i}}" id=" {{$key->id}}" kode_header="{{$key->kode_order}}" class="pasienterpilih toastsDefaultSuccess" no_rm="{{ $key->NO_RM }}" nama="{{ $key->NAMA_PX }}" dokter="{{ $key->nama_dokter_kirim }}" penjamin="{{ $key -> kode_penjamin }}" tgl_order="{{ $key-> tgl_order }}">
                                            <td> {{ $key->kode_order}} </td>
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
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->


                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>










</div>


<script src="{{ asset('public/semeru/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script>
    spinner = $('#loader2');
    spinner.hide();
</script>
<script>
    document.getElementById('tanggal_kunjungan').valueAsDate = new Date()
    $(document).ready(function() {
        window.setTimeout(function() {
            ambildata()
            totalkunjungan()
            totalorder()
            totalorderpoli()
            bunyi()
        }, 60000);

    });

    function bunyi() {
        var bel = new Audio('notif.mp3');
        bel.play();
    }

    function datapasien() {
        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
            },
            type: "post",
            url: " {{ route('datapasien')}}",
            error: function(data) {
                spinner.hide();
                alert('oke!!')
            },
            success: function(response) {
                spinner.hide();
                $('.tablependaftaran').html(response);

            }
        });
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

    function totalkunjungan() {

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
            },
            type: "post",
            url: " {{ route('hitungkunjungan')}}",
            error: function(data) {
                spinner.hide();
                alert('oke!!')
            },
            success: function(response) {
                spinner.hide();
                $('.jumlahorderpasien').html(response);

            }
        });
    }

    function totalorder() {

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
            },
            type: "post",
            url: " {{ route('hitungorder')}}",
            error: function(data) {
                spinner.hide();
                alert('oke!!')
            },
            success: function(response) {
                spinner.hide();
                $('.jumlahorderpasien').html(response);

            }
        });
    }

    function totalorderpoli() {

        $.ajax({
            data: {
                _token: "{{ csrf_token() }}",
            },
            type: "post",
            url: " {{ route('hitungorderpoli')}}",
            error: function(data) {
                spinner.hide();
                alert('oke!!')
            },
            success: function(response) {
                spinner.hide();
                $('.jumlahorder').html(response);

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
    $('#datapasienorder').on('click', '.pasienterpilih', function() {
        spinner = $('#loader2');
        spinner.show();
        id = $(this).attr('id')
        tgl_order = $(this).attr('tgl_order')
        kode_header = $(this).attr('kode_header')
        no_rm = $(this).attr('no_rm')
        kodekunjungan = $(this).attr('kodekunjungan')
        index = parseInt($(this).attr('index'))
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                tgl_order,
                kodekunjungan,
                no_rm,
                id,
                index,
                kode_header

            },

            url: " {{ route('pasiendetail') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#tgl_order').val(response.tgl_order);
                $('#kode_header').val(response.kode_header);
                $('#kodekunjungan').val(response.kodekunjungan);
                $('#no_rm').val(response.no_rm);
                $('#id').val(response.id);
                $('.coba').html(response);
            }
        });
    });
    $('#datapendaftaran').on('click', '.terpilihpasien', function() {
        spinner = $('#loader2');
        spinner.show();
        kelas = $(this).attr('kelas')
        nama = $(this).attr('nama')
        alamat = $(this).attr('alamat')
        tglmasuk = $(this).attr('tglmasuk')
        norm = $(this).attr('norm')
        diagnosa = $(this).attr('diagnosa')
        kodekunjungan = $(this).attr('kodekunjungan')
        index = parseInt($(this).attr('index'))
        idheader = $(this).attr('idheader')
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                norm,
                tglmasuk,
                nama,
                alamat,
                kodekunjungan,
                diagnosa,
                index,
                idheader
            },
            url: " {{ route('detailpasien') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#idheader').val(response.id);
                $('#norm').val(response.norm);
                $('#nama').val(response.nama);
                $('alamat').val(response.alamat);
                $('tglmasuk').val(response.tglmasuk);
                $('kodekunjungan').val(response.kodekunjungan);
                $('.coba').html(response);

            }
        });
    });
    $('#datapendaftaran').on('click', '.pasienerm', function() {
        spinner = $('#loader2');
        spinner.show();
        kelas = $(this).attr('kelas')
        nama = $(this).attr('nama')
        alamat = $(this).attr('alamat')
        tglmasuk = $(this).attr('tglmasuk')
        norm = $(this).attr('norm')
        diagnosa = $(this).attr('diagnosa')
        kodekunjungan = $(this).attr('kodekunjungan')
        index = parseInt($(this).attr('index'))
        idheader = $(this).attr('idheader')
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                norm,
                tglmasuk,
                nama,
                alamat,
                kodekunjungan,
                diagnosa,
                index,
                idheader
            },
            url: " {{ route('pasienerm') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#idheader').val(response.id);
                $('#norm').val(response.norm);
                $('#nama').val(response.nama);
                $('#alamat').val(response.alamat);
                $('#tglmasuk').val(response.tglmasuk);
                $('#kodekunjungan').val(response.kodekunjungan);
                $('.coba').html(response);

            }
        });
    });

    function cariordertanggal() {
        spinner = $('#loader2');
        spinner.show();
        no_rm = $('#no_rm').val()
        tgl_entry = $('#tanggal_order').val()
        $.ajax({
            type: "post",
            data: {
                _token: " {{ csrf_token() }}",
                no_rm,
                tgl_entry
            },
            url: " {{ route('caritanggal') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!!')
            },
            success: function(response) {
                spinner.hide();
                $('.ordertable').html(response);
            }
        })

    }


    function caripasien() {
        spinner = $('#loader2');
        spinner.show();
        norm = $('#norm').val()
        nama = $('#nama').val()
        alamat = $('#alamat').val()
        tgl_kunjungan = $('#tanggal_kunjungan').val()
        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                norm,
                nama,
                alamat,
                tgl_kunjungan
            },
            url: "{{ route('caripasienpendaftaran') }}",
            error: function(data) {
                spinner.hide()
                alert('Errorrr!!!')
            },
            success: function(response) {
                spinner.hide();
                $('.tablependaftaran').html(response);
            }
        })
    }
</script>
@endsection