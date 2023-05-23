<div class="body" style="margin-left: 30px;">
    <h1>DETAIL PASIEN TELEKONSULTASI</h1>
    <div class="row">
        <div class="col-md-11">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">DATA Pasien</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" class="pasiendetailtele">
                    @foreach ($pasiendetail as $pd)
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pasien</label>
                            <input readonly type="text" class="form-control" name="nama" id="nama" value="{{ $pd->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">nik</label>
                            <input readonly type="text" class="form-control" name="nik" id="nik" value="{{ $pd->nik }}">
                        </div>
                        

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
                            <label for="exampleInputFile">Dokter</label>
                            <select class="form-control" id="dokter" name="dokter">
                                <option selected="">Pilih Poli</option>
                                @foreach ($dokter as $d)
                                <option value="{{$d->nama}}">{{ $d->nama }}</option>

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

            @endforeach
            </form>
        </div>
        <!-- /.card -->



    </div>
</div>
<!-- /.tab-pane -->
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