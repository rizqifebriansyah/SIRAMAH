<div class="container-fluid">
    @if(count($cek_assmed) > 0)
    <div class="row">
        <div style="margin-top:20px" class="col-md-12">
            <h5>Tindak Lanjut Pasien</h5>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button disabled type="button" class="btn btn-warning tindaklanjut_btn" id="1">Dirujuk</button>
                <button disabled type="button" class="btn btn-info tindaklanjut_btn" id="2">Konsul</button>
                <button type="button" class="btn btn-danger tindaklanjut_btn" id="3">Rawat Inap</button>
                <button type="button" class="btn btn-success tindaklanjut_btn" id="4">Pulang</button>
            </div>
        </div>
        @if($cek_assmed[0]->tindaklanjut != NULL)
        <div class="alert alert-secondary mt-2" role="alert">
            Tindak Lanjut : {{ $cek_assmed[0]->tindaklanjut }}
        </div>
        @endif
    </div>
    <div class="row">
        <div class="tindakanlanjut mb-4">

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
    $(".tindaklanjut_btn").click(function() {
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('formtindaklanjut') ?>',
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
                $('.tindakanlanjut').html(response)
            }
        });
    });
</script>