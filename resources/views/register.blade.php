<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>{{ $title }}</title>

    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin"
        rel="stylesheet" type="text/css">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{ asset('TemplatePixel/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('TemplatePixel/css/pixeladmin.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('TemplatePixel/css/widgets.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('TemplatePixel/css/themes/clean.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
    <script src="{{ asset('TemplatePixel/pace/pace.min.js') }}"></script>
    <script src="{{ asset('TemplatePixel/demo/demo.js') }}"></script>

    <!-- Custom styling -->
    <style>
        .page-signup-header {
            box-shadow: 0 2px 2px rgba(0, 0, 0, .05), 0 1px 0 rgba(0, 0, 0, .05);
        }

        .page-signup-header .btn {
            position: absolute;
            top: 12px;
            right: 15px;
        }

        html[dir="rtl"] .page-signup-header .btn {
            right: auto;
            left: 15px;
        }

        .page-signup-container {
            width: auto;
            margin: 30px 10px;
        }

        .page-signup-container form {
            border: 0;
            box-shadow: 0 2px 2px rgba(0, 0, 0, .05), 0 1px 0 rgba(0, 0, 0, .05);
        }

        @media (min-width: 544px) {
            .page-signup-container {
                width: 350px;
                margin: 60px auto;
            }
        }

        .page-signup-social-btn {
            width: 40px;
            padding: 0;
            line-height: 40px;
            text-align: center;
            border: none !important;
        }
    </style>
    <!-- / Custom styling -->
</head>

<body>
    <div class="page-signup-header p-a-2 text-sm-center bg-white">
        <a class="px-demo-brand px-demo-brand-lg text-default" href="/"><span
                class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span
                    class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span
                    class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span
                    class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span
                    class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><strong class="text-success">Tryout<sup class="text-danger"> Sys</sup></strong></a>
        <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
    </div>

    <div class="page-signup-container">
        <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert {{ session('class') }} alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
        <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Registrasi Member</h2>

        <form action="{{ route('daftar.store') }}" method="post" class="panel p-a-4">
            @csrf
            
            <h4 style="margin-top:0px !important;">Detail Profil</h4>
            
            <fieldset class="form-group form-group-lg">
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
            </fieldset>

            <fieldset class="form-group form-group-lg">
                <select name="gender" class="form-control" required>
                    <option value="" selected disabled>Jenis Kelamin</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </fieldset>

            <fieldset class="form-group form-group-lg">
                <input type="text" name="telepon" class="form-control" placeholder="No Telepon" required>
            </fieldset>
            
            <fieldset class="form-group form-group-lg">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
            </fieldset>
            
            <h4>Detail Login</h4>
            
            <fieldset class="form-group form-group-lg">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </fieldset>
            
            <fieldset class="form-group form-group-lg">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </fieldset>

            <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Daftar Sekarang</button>
        </form>


    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('TemplatePixel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('TemplatePixel/js/pixeladmin.min.js') }}"></script>
    <script>
        setTimeout(function() {
                document.getElementById('respon').innerHTML = '';
            }, 2000);
    </script>
</body>

</html>
