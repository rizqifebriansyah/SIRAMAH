<div class="container-fluid">
    <div class="jumbotron mt-4">
        <h1 class="display-4">Pasien harus dirawat inap ?</h1>
        <p class="lead">AHMDAD NUR CAHYO <br>
            Terdiagnosa <br>
            Poli THT

        </p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg float-right tindakanranap" href="#" role="button">Ya, Rawat Inap</a>
    </div>
</div>
<script>
    $(".tindakanranap").click(function() {
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('pasienranap') ?>',
            error: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'OK',
                    text: data.message,
                    footer: ''
                })
                var element = document.getElementById("tindaklanjut");
                myFunction(element)
                element.classList.add("active");
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan: $('#kodekunjungan').val()
                    },
                    url: '<?= route('tindaklanjut') ?>',
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
                        $('#content').html(response)
                        cek_resume()
                    }
                });
            }
        });
    });
</script>