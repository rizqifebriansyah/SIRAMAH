@extends('telekonsultasi.header')
<link rel="stylesheet" type="text/css" href="https://cdn.prinsh.com/NathanPrinsley-textstyle/nprinsh-stext.css" />

@section('container')

<div class="row" style="margin-top:150px">
    <div style="margin-left:10px ;" class="card col-md-12">

        <div class="body hasilregis">
            <h1>FORM REGISTRASI TELEKONSULTASI</h1>
            <div class="row">
                <div class="col-md-11">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" class="pasienbaru">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Pasien</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">nik</label>
                                    <input type="text" class="form-control" name="nik" id="nik">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Desa</label>
                                    <select class="form-control" id="desa" name="desa">
                                        <option selected="">Pilih Desa</option>
                                        <!-- @foreach ($desa as $d)
                                        <option value="{{$d->name}}">{{$d->name}}</option>
                                        @endforeach -->

                                    </select> </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Kecamatan</label>
                                    <select class="form-control" id="kecamatan" name="kecamatan">
                                        <option selected="">Pilih Kecamatan</option>
                                        <!-- @foreach ($kecamatan as $k)
                                        <option value="{{$k->name}}">{{$k->name}}</option>
                                        @endforeach -->

                                    </select> </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">kab_/Kota</label>
                                    <select class="form-control" id="kab_kota" name="kab_kota">
                                        <option selected="">Pilih kab_kota</option>
                                        <!-- @foreach ($kk as $k)
                                        <option value="{{$k->name}}">{{$k->name}}</option>
                                        @endforeach -->

                                    </select></div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Provinsi</label>
                                 <select class="form-control" id="propinsi" name="propinsi">
                                        <option selected="">Pilih Provinsi</option>
                                        <!-- @foreach ($provinsi as $p)
                                        <option value="{{$p->name}}">{{$p->name}}</option>
                                        @endforeach -->

                                    </select></div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Alergi</label>
                                    <input type="text" class="form-control" name="alergi" id="alergi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Jenis Kelamin</label>
                                    <select class="form-control" id="jk" name="jk">
                                        <option selected="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Agama</label>
                                    <select class="form-control" id="agama" name="agama">
                                        <option selected="">Pilih Agama</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghuchu">Konghuchu</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">No. Handphone</label>
                                    <input type="text" class="form-control" name="nohp" id="nohp" require="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Alamat Detail</label>
                                    <input type="text-area" class="form-control" name="alamat" id="alamat" require="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Keluhan Utama</label>
                                    <input type="text-area" class="form-control" name="keluhan" id="keluhan" require="" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Poli Klinik Tujuan</label>
                                    <select class="form-control" id="poli_tuju" name="poli_tuju">
                                        <option selected="">Pilih Poli</option>
                                        @foreach ($unit as $u)
                                        <option value="{{$u->nama_unit}}">{{$u->nama_unit}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Bukti Transfer</label>
                                    <input class="form-control" type="file" name="bukti" id="bukti" value="">
                                </div>
                                <button type="button" class="btn btn-warning mb-2 simpanpasienbaru" id="simpanpasienbaru">Simpan Tindakan</button>
                            </div>

                    </div>

                    <!-- /.card-body -->


                    </form>
                </div>
                <!-- /.card -->



            </div>
        </div>
        <!-- /.tab-pane -->
    </div>


</div>
</div>



<script>
    spinner = $('#loader2');
    spinner.hide();

        $(".simpanpasienbaru").click(function() {
            var data = $('.pasienbaru').serializeArray();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),

                },
                url: '<?= route('simpanpasienbaru') ?>',
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(response) {
                    
                    console.log(data)

                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                    
                    berhasil()
                    document.location.reload();

                }
            });
        });
</script>


@endsection