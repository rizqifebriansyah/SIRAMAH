<div class="table table-sm mt-3 table-hover col-md-11" style="margin-left:32px ;">
    <table>
        <thead class="bg-primary">
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
        </thead>
        <tbody>
            <td>{{ $pasien[0]->no_rm }}</td>
            <td>{{ $pasien[0]->nama_px }}</td>
            <input hidden id="nama" name="nama" type="text" value="{{ $pasien[0]->nama_px }}">
           <input hidden id="alamat" name="alamat" type="text" value="{{ $pasien[0]->alamat }}">
            <td>@if ($pasien[0]->jenis_kelamin == 'L' ) Laki - Laki @else Perempuan @endif</td>
            <td>{{ $pasien[0]->alamat }}</td>
        </tbody>
    </table>
</div>

<div class="col-md-5" style="margin-left: 30px;">
    <div class="card">
        <div class="card-header bg-warning">Pilih Layanan</div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="activity">
                    <div class="form-group">
                        <label for="inputName">Diagnosa</label>
                        <input type="text" id="diagnosa" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">Pilih Dokter</label>
                        <select class="form-control" id="dokter" name="dokter">
                            <option selected="">Pilih Dokter</option>
                            @foreach ($dokter as $d)
                            <option value="{{$d->kode_dokter}}">{{ $d->nama }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="container">
                        <div class="row">

                            <div class="col-sm-26">
                                <input type="text" class="form-control" id="obatnama" placeholder="Nama Obat ..">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary mb-2" onclick="cariobat()"> <i class="bi bi-search-heart"></i></button>

                            </div>
                        </div>
                    </div>
                    <div class="form-group detailobat">
              

                    </div>
                </div>
                <!-- /.tab-pane -->


                <!-- /.tab-pane -->

            </div>
        </div>

    </div>
    <!-- /.card -->
</div>
<div class="col-md-6" style="margin-left: 30px;">
    <div class="card">
        <div class="card-header bg-success">Tindakan / Layanan Pasien</div>
        <div class="card-body">
            <form action="" method="post" class="telemedicine">
                <div class="input_fields_wrap">
                    <div>
                    </div>
                    <button type="button" class="btn btn-warning mb-2 simpantelemedicine" id="simpantelemedicine">Simpan Obat</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <p>pilih obat untuk pasien</p>
        </div>
    </div>
</div>
<!-- /.card -->

<script>
   
   
    function cariobat() {
        spinner = $('#loader2');
        spinner.show();
        obatnama = $('#obatnama').val()


        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                obatnama,

            },
            url: "{{ route('cariobat') }}",
            error: function(data) {
                spinner.hide()
                alert('Errorrr!!!')
            },
            success: function(response) {
                spinner.hide();
                $('.detailobat').html(response);
            }
        })
    }
    
    $(".simpantelemedicine").click(function() {
        var data = $('.telemedicine').serializeArray();
        dokter = $('#dokter').val()
        diagnosa = $('#diagnosa').val()
        nama = $('#nama').val()
        alamat = $('#alamat').val()

        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                dokter,
                nama,
                alamat,
                diagnosa
            },
            url: '<?= route('simpantelemedicine') ?>',
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
                 

                }
            }
        });
    });
</script>