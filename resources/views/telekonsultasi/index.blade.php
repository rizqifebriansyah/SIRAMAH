@extends('erm.header')
<link rel="stylesheet" type="text/css" href="https://cdn.prinsh.com/NathanPrinsley-textstyle/nprinsh-stext.css" />

@section('container')
<div class="body" style="margin-top:150px">


    <div class="row tele">
        <div style="margin-left:10px ;" class="card col-md-12">

            <div class="card-body">
                <h1>Data Pasien Telekonsultasi</h1>
                <table id="datapasientele" class="table datapasientele table-sm text-sm table-bordered table-hover">
                    <thead class="bg-success">
                        <th>Kode Layanan Order</th>
                        <th>Nama</th>
                        <th>Poliklinik Tuju</th>
                    </thead>
                    <tbody>
                        @foreach ($pasien as $p)
                        <tr id="{{ $p->id }}" idx="{{ $p->idx }}" id_registrasi = "{{ $p->id_registrasi }}" nama="{{$p->nama}}" poli_tuju=" {{$p->poli_tuju}}" class="pasiendetail toastsDefaultSuccess" nik="{{$p->nik}}" alergi="{{ $p->alergi }}" jk="{{ $p->jk }}" nohp="{{ $p->no_hp }}" alamat="{{ $p->alamat }}" bukti="{{ $p->bukti_tf_regis }}" data-date-format="yyyy-mm-dd">
                            <td>{{$p->id_registrasi}}</td>
                            <td>{{$p->nama}}</td>
                            <td>{{$p->poli_tuju}} </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </div>

</div>



<script>
    spinner = $('#loader2');
    spinner.hide();
    $(function() {
        $("#datapasientele").DataTable({
            "responsive": true,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function caripasienlama() {
        spinner = $('#loader2');
        spinner.show();
        nik = $('#nik').val()


        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                nik,

            },
            url: "{{ route('caripasienlama') }}",
            error: function(data) {
                spinner.hide()
                alert('Errorrr!!!')
            },
            success: function(response) {
                spinner.hide();
                $('.datapasien').html(response);
            }
        })
    }
    $('#datapasientele').on('click', '.pasiendetail', function() {
        spinner = $('#loader2');
        spinner.show();
        id = $(this).attr('id')
        idx = $(this).attr('idx')
        id_registrasi = $(this).attr('id_registrasi')
        nama = $(this).attr('nama')
        alamat = $(this).attr('alamat')
        poli_tuju = $(this).attr('poli_tuju')
        nik = $(this).attr('nik')
        alergi = $(this).attr('alergi')
        jk = $(this).attr('jk')
        nohp = $(this).attr('nohp')
        bukti = $(this).attr('bukti')

        $.ajax({
            type: "post",
            data: {
                _token: "{{ csrf_token() }}",
                id, 
                idx,
                id_registrasi,
                nama ,
                alamat, 
                poli_tuju ,
                nik, 
                alergi ,
                jk, 
                nohp, 
                bukti,
            },
            url: " {{ route('detailpasientele') }}",
            error: function(data) {
                spinner.hide();
                alert('error!!')
            },
            success: function(response) {
                spinner.hide();
                $('#id').val(response.id);
                $('#idx').val(response.idx);
                $('#id_registrasi').val(response.id_registrasi);
                $('#poli_tuju').val(response.poli_tuju);
                $('#nama').val(response.nama);
                $('alamat').val(response.alamat);
                $('alergi').val(response.alergi);
                $('jk').val(response.jk);
                $('nohp').val(response.nohp);
                $('bukti').val(response.bukti);

                $('.tele').html(response);

            }
        });
    });
</script>
@endsection