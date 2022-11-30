<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('public/img/logo_rs.png') }}">

    <title>{{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/semeru/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/semeru/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('public/semeru/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/semeru/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/semeru/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

    <script type="text/javascript" src="{{ asset('public/signature/js/signature.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <style>
        .preloader2 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            opacity: 0.9;
        }

        .preloader2 .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }

        .scroll {
            max-height: 500px;
            overflow-y: auto;
        }

        .scroll2 {
            max-height: 500px;
            overflow-y: auto;
        }

        .form-check-input {
            transform: scale(1.5);
        }

        /* .tab_content {display:none;} */
    </style>
</head>
<body id="content2" class="hold-transition sidebar-mini">
    <div class="preloader2" id="loader2">
        <div class="loading">
            <img src="{{ asset("public/img/fb.gif") }}" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:rgb(33, 65, 45);  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="container">
            <a class="navbar-brand text-light">
                <img src="{{ asset('public/img/semeru.png') }}" width="360" height="60" class="d-inline-block align-top ml-2 mr-2" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ">
                    {{-- @if($menu == 1) <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard2')}}"><i class="bi bi-box-arrow-in-right mr-2"></i> Dashboard</a>
                    </li> @endif --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(auth()->user()->name) }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Info</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        @yield('container')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/semeru/dist/js/jquery-3.js') }}"></script>
    <script src="{{ asset('public/semeru/dist/js/jquery-ui.min.js') }}"></script>
    {{-- <script src="{{ asset('public/semeru/plugins/jquery/jquery.min.js') }}"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/semeru/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/semeru/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>