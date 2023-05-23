<div class=" col-md-11" style="margin-bottom:10px ;">

  <a style="margin-left: 20px;" rel="noopener" href="{{ route('laboratorium')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Home
  </a>
</div>

<div style="margin-top: 20px;"></div>
<div class="invoice col-11 " id="printableArea" style="margin-left: 30px;">
  <!-- title row -->
  <div class="row">
    <form action="" class="simpanorder">

      <div class="col-12">
        <h4>

          <img style="margin-top: 10px;" src="{{ asset("public/img/logo_rs.png") }}" width="80">
          PENUNJANG
        </h4>
      </div>
      <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong>Admin</strong><br>
        Jl. Prabu Kiansantang No.4,
        Waled Kota, Waled, Cirebon,<br>
        Jawa Barat 45187. IGD 24 Jam.<br>
        Phone: (0231) 661275. (0231) 661126.<br>
        Humas 081220638273.
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong>{{$pasienorder[0]->NAMA_PX}} </strong><br name="no_rm" id="no_rm" value="{{ $pasienorder[0]->NO_RM }}">
        NO RM: {{$pasienorder[0]->NO_RM}}<br>
        {{$pasienorder[0]->alamat}}<br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <input hidden type="text" id="kodekunjungan" value="{{$pasienorder[0]->KJ}}" class="form-control">
      <input hidden type="text" id="kodeheader" value="{{ $pasienorder[0]->kode_order }}" class="form-control">

      <b>Dokter Pengirim : {{ $pasienorder[0]->nama_dokter_kirim }} </b><br>
      <br>
      <b>Order ID:</b> {{ $pasienorder[0]->kode_order }}<br>
      <b>Diagnosa :</b> {{ $pasienorder[0]->diagnosa }}<br>

      <br>

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped" id='tabelordertdy'>
        <thead>
          <tr>
            <th>Qty</th>
            <th>Nama Layanan</th>
            <th>Diskon Layanan</th>
            <th>Diskon Dokter</th>
            <th>Cyto</th>
            <th>Total Layanan</th>
          </tr>
        </thead>
        <tbody>
          @php
          $jumlah_layanan = 0;
          $subtotal = 0;
          @endphp
          @if(count($order) > 0)

          @foreach ($order as $order)
          <tr>
            <td>{{ $order->jumlah_layanan }} </td>
            <td>{{ $order->nama_layanan }}</td>
            <td>{{ $order->diskon_layanan}}%</td>
            <td>{{ $order->diskon_dokter}}%</td>
            <td>{{ $order->cyto}}</td>
            <td>Rp. {{ number_format($order->total_layanan)}}</td>

          </tr>
          @php
          $subtotal = $order->total_layanan + $subtotal;
          $jumlah_layanan = $order->jumlah_layanan + $jumlah_layanan;
          @endphp
          @endforeach
          @else
          @endif
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">


    </div>
    <!-- /.col -->
    <div class="col-6">

      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th style="width:50%">Payment Methods:</th>
              <td>
                <p class="badge"> @if ($pasienorder[0]->NAMA_PENJAMIN == 'JKN Perusahaan / KIS (BPJS)' )
                <p class="badge badge-success">JKN Perusahaan / KIS (BPJS)</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'JKN Mandiri / KIS (BPJS)')
                <p class="badge badge-success">JKN Mandiri / KIS (BPJS)</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'Askes PNS')
                <p class="badge badge-success">Askes PNS</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'PBI APBD')
                <p class="badge badge-warning">PBI APBD</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'PBI APBN')
                <p class="badge badge-warning">PBI APBN</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'PRIBADI')
                <p class="badge badge-primary">PRIBADI</p>
                @elseif ($pasienorder[0]->NAMA_PENJAMIN == 'Jasa Raharja + BPJS')
                <p class="badge badge-secondary">Jasa Raharja + BPJS</p>
                @else
                <p class="badge badge-danger">{{ $pasienorder[0]->NAMA_PENJAMIN }}</p>
                @endif</p>
              </td>
            </tr>
            <tr>
              <th style="width:50%">Total :</th>
              <td>Rp. {{number_format($subtotal)}}</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <button type="button" class="btn btn-success float-right simpanorder" idetail="{{ $order->id }}"><i class="far fa-credit-card"></i> SIMPAN
      </button>
      <button class="btn btn-warning float-right returorder" iddetail="{{ $order->id }}">retur</button>
      <button class="btn btn-danger float-right batalorder" idheader="{{ $pasienorder[0]->kode_order }}">batal</button>

    </div>


  </div>
</div>
</form>

<div style="margin-top:30px ;"></div>


<script>
  function berhasil() {
    var bel = new Audio('berhasil.mp3');
    bel.play();
  }

  function retur() {
    var bel = new Audio('retur.mp3');
    bel.play();
  }

  function batal() {
    var bel = new Audio('batal.mp3');
    bel.play();
  }
  $(function() {
    $("#tabelordertdy").DataTable({
      "responsive": false,
      "lengthChange": false,
      "searching": false,
      "pageLength": 10,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
  });
  $('.simpanorder').click(function() {
    spinner = $('#loader2');
    spinner.show();
    idetail = $(this).attr('idetail')
    kodekunjungan = $('#kodekunjungan').val()

    $.ajax({
      async: true,
      type: 'post',
      dataType: 'json',
      data: {
        _token: "{{ csrf_token() }}",
        idetail,
        kodekunjungan,
      },
      url: '<?= route('simpanorder') ?>',
      error: function(data) {
        spinner.hide()
        Swal.fire({
          icon: 'error',
          title: 'OOppsss...',
          text: 'Sepertinya ada masalah.....',
          footer: ''
        })
      },
      success: function(data) {
        spinner.hide()
        Swal.fire({
          icon: 'success',
          title: 'OK',
          text: 'Data Berhasil Disimpan',
          footer: ''

        })
        berhasil();
        pdf();
      }
    });

  });
  $('.batalorder').click(function() {
    spinner = $('#loader2');
    spinner.show();
    idheader = $(this).attr('idheader')
    kodekunjungan = $('#kodekunjungan').val()
    kodeheader = $('#kodeheader').val()

    $.ajax({
      async: true,
      type: 'post',
      dataType: 'json',
      data: {
        _token: "{{ csrf_token() }}",
        idheader,
        kodeheader,
        kodekunjungan
      },
      url: '<?= route('batalorder') ?>',
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
          text: data.message,
          footer: ''
        })
        batal()

      }
    });
  });
  $('.returorder').click(function() {
    spinner = $('#loader2');
    spinner.show();
    iddetail = $(this).attr('iddetail')
    kodekunjungan = $('#kodekunjungan').val()
    kodeheader = $('#kodeheader').val()

    $.ajax({
      async: true,
      type: 'post',
      dataType: 'json',
      data: {
        _token: "{{ csrf_token() }}",
        iddetail,
        kodekunjungan,
        kodeheader
      },
      url: '<?= route('returorder') ?>',
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
          text: data.message,
          footer: ''
        })
        retur()
      }
    });
  });


  function pdf() {
    id = $(this).attr('id')
    kodeheader = $('#kodeheader').val()
    window.open('cetakorder/' + kodeheader + '/' + id);
  }
</script>