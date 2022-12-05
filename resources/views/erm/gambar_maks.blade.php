<input hidden type="text" id="imagestring">
<div style="align-items: left; padding-top: 40px;">
    <p class="text-xl mb-3">Maksilofasial</p>
    <img id="gambarnya" width="500px" src="{{ asset('public/img/Maksilofasial.jpg') }}" onclick="showMarkerArea(this);" />
    <button class="btn btn-success mt-2" onclick="saveimage()">Simpan</button>
</div>
<canvas hidden id="myCanvas" width="1240" height="1297" style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
    function saveimage() {
        var canvas = document.getElementById("myCanvas");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya");
        ctx.drawImage(img, 10, 10);
        var canvas = document.getElementById("myCanvas");
        var dataUrl = canvas.toDataURL();
        $('#imagestring').val(dataUrl)
        img = $('#imagestring').val()
        kodekunjungan = $('#kodekunjungan').val()
        id= 'maksilofasial'
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                img,
                kodekunjungan,
                id
            },
            url: '<?= route('simpangambar') ?>',
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
                    text: 'Gambar sudah disimpan !',
                    footer: ''
                })
            }
        });
    }
</script>