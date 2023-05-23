<!-- jQuery -->
<script src="{{ asset('public/dist/js/jquery-3.js') }}"></script>
<script src="{{ asset('public/dist/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('public/semeru/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/semeru/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/semeru/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- datengrange -->
<script src="{{ asset('public/semeru/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- jQuery Mapael -->
<script src="{{ asset('public/semeru/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('public/js/swal.js') }}"></script>
<script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('public/semeru/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/semeru/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://unpkg.com/markerjs2/markerjs2.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
    onload = ambildatapasien()

    function ambildatapasien() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("infopasien");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('detailpasien') ?>',
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
            }
        });
    }
    $(".pemeriksaan").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("pemeriksaan");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('formperawat') ?>',
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
            }
        });
    });
    $(".pemeriksaanmedis").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("pemeriksaanmedis");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('formdokter') ?>',
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
            }
        });
    });
    $(".riwayatpengobatan").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("riwayatpengobatan");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('riwayatpengobatan') ?>',
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
            }
        });
    });
    $(".penandaangambar").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("penandaangambar");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('penandaangambar') ?>',
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
            }
        });
    });
    $(".tindakan").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("tindakan");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('terapitindakan') ?>',
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
            }
        });
    });
    $(".orderpenunjang").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("orderpenunjang");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('orderpenunjang') ?>',
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
            }
        });
    });
    $(".tindaklanjut").click(function() {
        spinner = $('#loader2');
        spinner.show();
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
            }
        });
    });
    $(".resumemedis").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("resumemedis");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('resumemedis') ?>',
            error: function(data) {
                console.log(data)
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
            }
        });
    });
    $(".cppt").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("cppt");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val(),
                nomorrm: $('#nomorrm').val(),
            },
            url: '<?= route('formcppt') ?>',
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
            }
        });
    });
    $(".Hasilpemeriksaanpenunjang").click(function() {
        spinner = $('#loader2');
        spinner.show();
        var element = document.getElementById("Hasilpemeriksaanpenunjang");
        myFunction(element)
        element.classList.add("active");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val(),
                nomorrm: $('#nomorrm').val(),
            },
            url: '<?= route('Hasilpemeriksaanpenunjang') ?>',
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
            }
        });
    });

    function myFunction(e) {
        var elems = document.querySelectorAll(".active");
        [].forEach.call(elems, function(el) {
            el.classList.remove("active");
        });
        e.target.className = "active";
    }

    onload = cek_resume()

    function cek_resume() {
        $.ajax({
            async: true,
            dataType: 'json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('cekresume') ?>',
            error: function(data) {
                console.log(data)
            },
            success: function(data) {
                if (data.kode != 500) {
                    if (data.data == '') {
                        $('.notif').removeAttr('Hidden', true)
                    }
                } else {
                    console.log(data)
                }
            }
        });
    }
</script>
<script>
    function showMarkerArea(target) {
      const markerArea = new markerjs2.MarkerArea(target);
      markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));

      markerArea.uiStyleSettings.toolbarStyleColorsClassName = 'bg-gray-50';
      markerArea.uiStyleSettings.toolbarButtonStyleColorsClassName =
        'bg-gradient-to-t from-gray-50 to-gray-50 hover:from-gray-50 hover:to-pink-50 fill-current text-pink-300';
      markerArea.uiStyleSettings.toolbarActiveButtonStyleColorsClassName =
        'bg-gradient-to-t from-pink-100 via-gray-50 to-gray-50 fill-current text-pink-400';
      markerArea.uiStyleSettings.toolbarOverflowBlockStyleColorsClassName = "bg-gray-50";
      
      markerArea.uiStyleSettings.toolboxColor = '#F472B6',
      markerArea.uiStyleSettings.toolboxAccentColor = '#BE185D',
      markerArea.uiStyleSettings.toolboxStyleColorsClassName = 'bg-gray-50';
      markerArea.uiStyleSettings.toolboxButtonRowStyleColorsClassName = 'bg-gray-50';
      markerArea.uiStyleSettings.toolboxPanelRowStyleColorsClassName =
        'bg-pink-100 bg-opacity-90 fill-current text-pink-400';
      markerArea.uiStyleSettings.toolboxButtonStyleColorsClassName =
        'bg-gradient-to-t from-gray-50 to-gray-50 hover:from-gray-50 hover:to-pink-50 fill-current text-pink-300';
      markerArea.uiStyleSettings.toolboxActiveButtonStyleColorsClassName =
        'bg-gradient-to-b from-pink-100 to-gray-50 fill-current text-pink-400';

      markerArea.show();
    }
  </script>
</body>

</html>