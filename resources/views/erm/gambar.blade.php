<div class="btn-group mt-3" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="tkan">Telinga Kanan</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="tkir">Telinga Kiri</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="far">Faring</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="lar">Laring</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="maks">Maksilofasiall</button>
    <button type="button" class="btn btn-danger btn-piilih-gambar" jg="leh">Leher Dan Kepala</button>
</div>
<script>
     $(document).ready(function() {
        $('.btn-piilih-gambar').click(function() {
            spinner = $('#loader2');
            spinner.show();           
            id = $(this).attr('jg')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    kodekunjungan : $('#kodekunjungan').val()
                },
                url: '<?= route('ambilgambar') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(response) {
                    spinner.hide()   
                    $('.tampilgambar').html(response)                
                }
            });
        });
    });
</script>
<div class="tampilgambar">
    
</div>

