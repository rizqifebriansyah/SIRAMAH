<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('public/logo_rs.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/semeru/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/semeru/dist/css/adminlte.min.css') }}">
    <title>{{ $title }}</title>
    <style>
        .bg-black {
            color: black
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

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
    </style>
</head>

<body style="background: url('public/img/bg-hs.png') no-repeat fixed center;background-size: 1600px 900px;">
    <div class="preloader2" id="loader2">
        <div class="loading">
            <img src="{{ asset('public/img/loader.gif') }}" width="680">
        </div>
    </div>
    <!-- Image and text -->
    <nav class="navbar" style="background-color:rgb(33, 65, 45)">
        <div class="container">
        <a class="navbar-brand text-light">
                <img src="{{ asset('public/img/semerus.png') }}" width="70" height="70" class="d-inline-block align-top ml-2 mr-2" alt="">
            </a>
            <a class="navbar-brand text-light"><h1 style="font-size:50px;">SIRAMAH</h1></a>
          
            <form action="{{ route('login') }}" method="post">
                @csrf
                <ul class="nav justify-content-end">
                    <li class="nav-item mr-1">
                        <div class="row col-md-12">
                            <div class="col-sm-5">
                                <!-- text input -->
                                <div class="form-group">
                                    <label class="text-light">Username</label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('username') is-invalid @enderror"
                                        name="username" placeholder="" value="{{ old('username') }}">
                                    @if (session()->has('loginError'))
                                        <small id="emailHelp" class="form-text text-danger">
                                            {{ session('loginError') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="text-light">Password</label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                                        name="password" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button class="btn btn-success btn-sm shadow-lg"
                                        style="margin-top:32px">Login</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
    {{-- <div class="container">
        <section class="h-100 bg-dark"> --}}
    <div class="container py-5 h-90">
        <div class="row d-flex justify-content-center align-items-center h-100 bg-light" style="opacity: 0.8">
            <div class="col">
                <div class="card card-registration my-2" style="background:none">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="{{ asset('public/img/bg-reg3.gif') }}" alt="Sample photo" class="img-fluid"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                        <div class="col-xl-6">
                            <div class="card-body p-md-2 text-black">
                                <h3 class="mb-2 text-uppercase">Registrasi Akun </h3>
                                @if (session()->has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-outline mb-1">
                                        <label class="form-label" for="form3Example9">Nama</label>
                                        <input type="text" id="" name="name" required
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" />
                                        @error('nama')
                                            <small id="emailHelp" class="form-text text-danger">
                                                {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-1">
                                        <label class="form-label" for="form3Example90">Username</label>
                                        <input type="text" id=""
                                            class="form-control form-control-sm @error('username1') is-invalid @enderror"
                                            name="username1" required value="{{ old('username') }}" />
                                        @error('username1')
                                            <small id="emailHelp" class="form-text text-danger">
                                                {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-1">
                                        <label class="form-label" for="form3Example99">Unit</label>
                                        <input class="form-control form-control-sm @error('unit') is-invalid @enderror"
                                            name="unit" id="unit" required />
                                        <input hidden class="form-control form-control-sm @error('unit') is-invalid @enderror"
                                            name="kodeunit" id="kodeunit" required />
                                        @error('unit')
                                            <small id="emailHelp" class="form-text text-danger">
                                                {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-1">
                                        <label class="form-label" for="form3Example99">Password</label>
                                        <input type="password" id=""
                                            class="form-control form-control-sm @error('password1') is-invalid @enderror"
                                            name="password1" required />
                                        @error('password1')
                                            <small id="emailHelp" class="form-text text-danger">
                                                {{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end pt-3">
                                        {{-- <button type="button" class="btn btn-light btn-lg">Reset all</button> --}}
                                        <button type="submit" class="btn btn-success btn-lg ms-2">Daftar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <p class="text-muted">@semerusmartV2</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('public/semeru/dist/js/jquery-3.js') }}"></script>
    <script src="{{ asset('public/semeru/dist/js/jquery-ui.min.js') }}"></script>

    <!-- jQuery -->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/semeru/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- semeru App -->
    <script src="{{ asset('public/semeru/dist/js/adminlte.min.js') }}"></script>
    <script>
        $(".preloader2").fadeOut();
        $(document).ready(function() {
            $('#unit').autocomplete({
                source: "<?= route('cariunit') ?>",
                select: function(event, ui) {
                    $('[id="unit"]').val(ui.item.label);
                    $('[id="kodeunit"]').val(ui.item.kode);
                }
            });
        });
    </script>
</body>

</html>
