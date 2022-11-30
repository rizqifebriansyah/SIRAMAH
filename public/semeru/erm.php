<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .scroll {
            max-height: 500px;
            overflow-y: auto;
        }

        input[type='radio'] {
            transform: scale(2);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <img width="50px" src="dist/img/logo_rs.png" class="mr-3" alt="">
        <a class="navbar-brand" href="#">Semerusmart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="bi bi-box-arrow-left mr-2"></i> </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- ./wrapper -->

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Form Resume medis</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Order Penunjang</a></li>
      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Order Farmasi</a></li> -->
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Riwayat Catatan Medis</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Data Pasien Poli Anak</h5>
                            <table id="example2" class="table table-sm table-bordered table-hover">
                                <thead class="bg-success">
                                    <th>Nomor RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Umur</th>
                                    <th>Penjamin</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1235</td>
                                        <td>Lionel Messi</td>
                                        <td>34</td>
                                        <td>BPJS</td>
                                    </tr>
                                    <tr>
                                        <td>1235</td>
                                        <td>Lionel Messi</td>
                                        <td>34</td>
                                        <td>BPJS</td>
                                    </tr>
                                    <tr>
                                        <td>1235</td>
                                        <td>Lionel Messi</td>
                                        <td>34</td>
                                        <td>BPJS</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Post -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>E-Form </h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group d-flex float-right">
                                        <select class="form-control select2 bg-warning" style="width: 100%;">
                                            <option selected="selected">-- Pilih Jenis Form --</option>
                                            <option>RM.02.02.1-RJ / Rev.02 / 19</option>
                                            <option>RM.03.02.1-RJ / Rev.02 / 19</option>
                                            <option>RM.11-RI / Rev.02 / 19</option>
                                            <option>RM.04-RJ / Rev.02 / 19</option>
                                            <option>RM.08-RI / Rev.02 / 19</option>
                                            <option>RM.19-RI / Rev.02 / 19</option>
                                            <option>RM.20-RI / Rev.02 / 19</option>
                                            <option>RM.21-RI / Rev.02 / 19</option>
                                            <option>Order Penunjang</option>
                                            <option>Order Farmasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <!-- <h5 class="text-danger"> * belum ada form yang dipilih ...</h5> -->
                                    <div id="lokasiformnya">
                                        <h5> Form order Penunjang</h5>
                                        <div class="row invoice-info text-sm text-bold">
                                            <div class="col-sm-4 invoice-col">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Nomor RM</td>
                                                        <td>1233455</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pasien</td>
                                                        <td>Lionel Messi</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>Waled, Kabupaten Cirebon</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col text-bold">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Tanggal Kunjungan</td>
                                                        <td>12 Desember 2022</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penjamin</td>
                                                        <td>BPJS</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group d-flex float-right">
                                                    <select class="form-control select2 bg-success" style="width: 100%;">
                                                        <option selected="selected">-- Pilih Layanan Penunjang --</option>
                                                        <option>Laboratorium</option>
                                                        <option>Laboratorium Patologi</option>
                                                        <option>Radiologi</option>
                                                        <option>Bank Darah</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="form-radiologi">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-success card-outline scroll">
                                                        <div class="card-body">
                                                            <h4>Radiologi</h4>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="card card-danger card-outline">
                                                                        <div class="card-body">
                                                                            <h5>Rontgen</h5>
                                                                            <table class="table table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td>Foto Polos</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thorax PA</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thorax Lateral</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Waters</td>
                                                                                    </tr>
                                                                                    <Tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Schuters</td>
                                                                                    </tr <Tr>
                                                                                    <td class="text-right">
                                                                                        <div class="icheck-primary d-inline">
                                                                                            <input type="checkbox" id="checkboxPrimary2">
                                                                                            <label for="checkboxPrimary2">
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>BNO / Abdomen</td>
                                                                                    </Tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Panoramic</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Ekstremitas</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="lain-lain ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Persendian</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="keterangan persendian ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Vertebrae</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Cervical</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thoracalis</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lumbal</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lumbosacral</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Schedel AP / Lat</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Pelvis</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lain - lain</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="keterangan lain - lain ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <h5>Foto Kontras</h5>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>BNO-IVP</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>OMD</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Oesophagus</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Colon inloop</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Urethrography</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Urethrocystography</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Fistulography</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Appendikogram</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lain - lain</td>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card card-warning card-outline">
                                                                        <div class="card-body">
                                                                            <h5>CT - Scan</h5>
                                                                            <table class="table table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td>CT - Scan Non Kontras</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Kepala</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Abdomen</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thorax</td>
                                                                                    </tr>
                                                                                    <Tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Vertebrae</td>
                                                                                    </tr <Tr>
                                                                                    <td class="text-right">
                                                                                        <div class="icheck-primary d-inline">
                                                                                            <input type="checkbox" id="checkboxPrimary2">
                                                                                            <label for="checkboxPrimary2">
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>Extremitas Atas</td>
                                                                                    </Tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Extremitas Bawah</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lain - lain</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="lain-lain ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">CT - Scan Dengan Kontras</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Kepala</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Abdomen</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thorax</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Vertebrae</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Extremitas Atas</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Extremitas Bawah</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lain - lain</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="keterangan lain - lain ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card card-success card-outline">
                                                                        <div class="card-body">
                                                                            <h5>USG ( Ultra Gonography )</h5>
                                                                            <table class="table table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Whole Abdomen ( Upper & Lower Abdomen )</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Upper Abdomen</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lower Abdomen</td>
                                                                                    </tr>
                                                                                    <Tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Pembagian ( Organ )</td>
                                                                                    </tr <Tr>
                                                                                    <td class="text-right">
                                                                                        <div class="icheck-primary d-inline">
                                                                                            <input type="checkbox" id="checkboxPrimary2">
                                                                                            <label for="checkboxPrimary2">
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>Mammae</td>
                                                                                    </Tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Testis</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Thyroid</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Liver</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Ginjal</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Prostat</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Soft Tissue</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Doppier</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Carotis</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Tungkai Artery</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Tungkai Vena</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Organ / Massa</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Scrotum / Linguinal</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Musculoskeletas</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-right">
                                                                                            <div class="icheck-primary d-inline">
                                                                                                <input type="checkbox" id="checkboxPrimary2">
                                                                                                <label for="checkboxPrimary2">
                                                                                                </label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>Lain - lain</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">
                                                                                            <input type="text" class="form-control" placeholder="lain-lain ...">
                                                                                        </td>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <td>Surat Pernyataan<br>
                                                            Menyatakan bahwa saya setuju / tidak seutuju untuk dilakukan tindakan media radiologi
                                                            USG / Foto Rontgen / CT Scan
                                                        </td>
                                                        <td height="120px">Persetujuan Pasien / Keluarga <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            (---------------------------------------)
                                                        </td>
                                                        <td> Dokter yang Meminta<br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            Dr. Binto
                                                        </td>
                                                    </table>
                                                    <button class="btn btn-danger float-right ml-2">Batal</button>
                                                    <button class="btn btn-success float-right">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lokasiformnya" hidden>
                                        <h5> Form RM.02.02.1-RJ / Rev.02 / 19</h5>
                                        <div class="row invoice-info text-sm text-bold">
                                            <div class="col-sm-4 invoice-col">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Nomor RM</td>
                                                        <td>1233455</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pasien</td>
                                                        <td>Lionel Messi</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>Waled, Kabupaten Cirebon</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col text-bold">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Tanggal Kunjungan</td>
                                                        <td>12 Desember 2022</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penjamin</td>
                                                        <td>BPJS</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <div id="form-rm-02">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-success card-outline scroll">
                                                        <div class="card-body">
                                                            <table class="table table-sm">
                                                                <tr>
                                                                    <td>Keluhan Utama</td>
                                                                    <td><textarea class="form-control" placeholder="Ketik keluhan utama pasien ..."></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-center bg-dark">Tanda tanda vital</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Anak Kandung</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="AK" id="AK" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">YA</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AK" id="AK" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gangguan Tumbuh Kembang</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="GT" id="GT" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">YA</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="GT" id="GT" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kekerasan Fisik</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="KF" id="KF" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">YA</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="KF" id="KF" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tinggal Bersama</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="TB" id="TB" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">YA</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="TB" id="TB" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pekerjaan Orang Tua</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="PO" id="PO" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">PNS / TNI / POLRI</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PO" id="PO" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Wiraswasta</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PO" id="PO" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Pegawai Swasta</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PO" id="PO" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Lain - lain</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Agama Orang Tua</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input ml-2 mr-3" type="radio" name="AOR" id="AOR" value="option1">
                                                                            <label class="form-check-label" for="inlineRadio1">Islam</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AOR" id="AOR" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Kristen</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AOR" id="AOR" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Hindu</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AOR" id="AOR" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Budha</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AOR" id="AOR" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Katolik</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="AOR" id="AOR" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Lainnya</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="bg-dark text-center">Status Fungsional</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Penggunaan alat bantu</td>
                                                                    <td>
                                                                    <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PAB" id="PAB" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PAB" id="PAB" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Tongkat</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="PAB" id="PAB" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">Kursi Roda</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cacat Tubuh</td>
                                                                    <td>
                                                                    <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="CT" id="CT" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">YA</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input mr-3" type="radio" name="CT" id="CT" value="option2">
                                                                            <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                                                                        </div>
                                                                        <div class="mr-2 mt-3">
                                                                            <textarea id="checkboxPrimary12" class="form-control" placeholder="keterangan cacat tubuh ..."></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <td>Surat Pernyataan<br>
                                                            Menyatakan bahwa saya setuju / tidak seutuju untuk dilakukan tindakan media radiologi
                                                            USG / Foto Rontgen / CT Scan
                                                        </td>
                                                        <td height="120px">Persetujuan Pasien / Keluarga <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            (---------------------------------------)
                                                        </td>
                                                        <td> Dokter yang Meminta<br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            Dr. Binto
                                                        </td>
                                                    </table>
                                                    <button class="btn btn-danger float-right ml-2">Batal</button>
                                                    <button class="btn btn-success float-right">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-danger">
                                10 Feb. 2014
                            </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-primary"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-user bg-info"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-comments bg-warning"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-success">
                                3 Jan. 2014
                            </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <!-- <script src="plugins/sparklines/sparkline.js"></script> -->
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js"></script> -->

    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>