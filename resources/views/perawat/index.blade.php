@extends('erm.header')
@section('container')
    <div class="container-fluid" style="margin-top:100px">
        <div id="tabelpasien" class="container-fluid">
            
        </div>
    </div>
    <script>
        onload = ambildatapasien()
        function ambildatapasien() {
            spinner = $('#loader2');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambildatapasien') ?>',
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
                    $('#tabelpasien').html(response)
                }
            });
        }
    </script>
@endsection