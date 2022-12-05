@include('templates.erm.header')
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-light navbar-teal text-md">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Akun</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> Info akun
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('public/semeru/dist/img/logo_rs.png') }}" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .9">
            <span style="font-family:calibri" class="brand-text font-weight-light">SEMERUSMART</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar sidebar-dark-teal">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public/img/user.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $pasien[0]->nama_px }} <br>
                        <p class="text-xs">
                            {{ $datakunjungan[0]->nama_penjamin }}
                        </p>
                    </a>

                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a id="infopasien" href="" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Info Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">ANAMNESIS</li>
                    @if(auth()->user()->hak_akses == 2)
                    <li class="nav-item">
                        <a id="pemeriksaan" class="nav-link pemeriksaan">
                            <i class="nav-icon fas bi bi-clipboard-check"></i>
                            <p>Hasil Pemeriksaan</p>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a id="pemeriksaanmedis" class="nav-link pemeriksaanmedis">
                            <!-- <i class="nav-icon fas fa-ellipsis-h"></i> -->
                            <i class="nav-icon fas bi bi-clipboard-check"></i>
                            <p>Pemeriksaan medis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="riwayatpengobatan" class="nav-link riwayatpengobatan">
                            <i class="nav-icon fas bi bi-capsule"></i>
                            <p>Riwayat Pengobatan </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="penandaangambar" class="nav-link penandaangambar">
                            <i class="nav-icon fas bi bi-images"></i>
                            <p>Penandaan Gambar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="tindakan" class="nav-link tindakan">
                            <i class="nav-icon fas bi bi-activity"></i>
                            <p>Terapi / Tindakan Medis </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="orderpenunjang" class="nav-link orderpenunjang">
                            <i class="nav-icon fas bi bi-bag-heart-fill"></i>
                            <p>Order Layanan Penunjang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="tindaklanjut" class="nav-link tindaklanjut">
                            <i class="nav-icon fas bi bi-hospital"></i>
                            <p>Tindak Lanjut</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a id="resumemedis" class="nav-link resumemedis">
                            <i class="nav-icon fas bi bi-book-half"></i>
                            <p>Resume Medis
                                <span hidden class="right badge badge-danger notif">!</span>                            
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Riwayat Medis</li>
                    <li class="nav-item">
                        <a id="cppt" href="#" class="nav-link cppt">
                            <i class="nav-icon fas bi bi-journal-medical"></i>
                            <p>CPPT</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Hasilpemeriksaanpenunjang" href="#" class="nav-link Hasilpemeriksaanpenunjang">
                            <i class="nav-icon fas bi bi-journal-medical"></i>
                            <p class="text-xs">Hasil Pemeriksaan Penunjang</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    @yield('container')


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-light">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->
@include('templates.erm.footer')