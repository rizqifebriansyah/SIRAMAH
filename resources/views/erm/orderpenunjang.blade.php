<div class="container-fluid mt-3">
    @if($cek_asmed > 0)
    <div class="row">
        <div class="col-md-5">
            <h5 style="margin-top:20px">Order Layanan Penunjang</h5>
            <select id="namapenunjang" class="form-control form-control-lg" onchange="ambillayanan()">
                <option value="0"> -- Pilih Layanan Penunjang --</option>
                @foreach($unit as $u)
                <option value="{{ $u->kode_unit }}"> {{ $u->nama_unit }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-7" style="margin-top:20px">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header bg-warning" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-sm btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Riwayat Order Penunjang Hari Ini
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div id="order_tdy"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tampillayanan">

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
</div>
<script>
    function ambillayanan() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode: $('#namapenunjang').val(),
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambillayanan') ?>',
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
                $('.tampillayanan').html(response)
            }
        });
    }
    onload = orderhari_ini()

    function orderhari_ini() {
        spinner = $('#loader2');
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('orderhariini') ?>',
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
                $('#order_tdy').html(response)
            }
        });
    }
</script>