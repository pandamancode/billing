<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Login | {{ env('APP_NAME') }} System</title>

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin"
        rel="stylesheet" type="text/css">
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
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
        body {
    font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 13px;
    line-height: 1.61539;
    color: #444;
}
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #eaeaea;
            text-align: center;
            /* padding: 3px; */
        }

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .page-signin-modal {
            position: relative;
            top: auto;
            right: auto;
            bottom: auto;
            left: auto;
            z-index: 1;
            display: block;
        }

        .page-signin-form-group {
            position: relative;
        }

        .page-signin-icon {
            position: absolute;
            line-height: 21px;
            width: 36px;
            border-color: rgba(0, 0, 0, .14);
            border-right-width: 1px;
            border-right-style: solid;
            left: 1px;
            top: 9px;
            text-align: center;
            font-size: 15px;
        }

        html[dir="rtl"] .page-signin-icon {
            border-right: 0;
            border-left-width: 1px;
            border-left-style: solid;
            left: auto;
            right: 1px;
        }

        html:not([dir="rtl"]) .page-signin-icon+.page-signin-form-control {
            padding-left: 50px;
        }

        html[dir="rtl"] .page-signin-icon+.page-signin-form-control {
            padding-right: 50px;
        }

        #page-signin-forgot-form {
            display: none;
        }

        /* Margins */

        .page-signin-modal>.modal-dialog {
            margin: 30px 10px;
        }

        @media (min-width: 544px) {
            .page-signin-modal>.modal-dialog {
                margin: 60px auto;
            }
        }
    </style>
    <!-- / Custom styling -->
</head>

<body>
    <div class="page-signin-modal modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="box m-a-0">
                    <div class="box-row">

                        @if (session('status'))
                            <div class="alert alert-warning alert-dark">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="box-cell col-md-6 bg-danger p-a-4">
                            <div class="text-xs-center text-md-center">
                                <a class="px-demo-brand px-demo-brand-lg"  href="">
                                    <img src="https://ulayyasoft.my.id/kasir/public/logo.png"
                                        alt="Logo" height="120" />
                                </a>
                                <br /><br />
                                <div class="font-size-18 m-t-1 line-height-2">Kalo Tech</div>
                                <div class="font-size-12 m-t-1 line-height-1" style="font-family: lucida;color: yellow; font-style: italic">Rent System</div>
                                <br /><br /><br />
                            </div>
                        </div>

                        <div class="box-cell col-md-6">

                            <form action="{{ route('login') }}" method="post" class="p-a-4" id="page-signin-form">
                                @method('post')
                                @csrf
                                <h3 class="m-t-0 m-b-4 text-xs-left font-weight-bold" style="font-size: 30pt;color: #e46050;">{{ env('APP_NAME') }}<sup class="text-">Sys</sup>
                                <br />
                                <p class="m-t-0 m-b-4 text-xs-left" style="font-size: 8pt;color: #e46050;">Simple &amp; Easy</p>
                                </h3>
                                <br />

                                <fieldset class="page-signin-form-group form-group form-group-lg">
                                    <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                                    <input type="text" name="email" class="page-signin-form-control form-control"
                                        placeholder="Username">
                                    @error('email')
                                        <div class="form-message">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <fieldset class="page-signin-form-group form-group form-group-lg">
                                    <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                                    <input type="password" name="password" class="page-signin-form-control form-control"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="form-message">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3"><i class="fa fa-sign-in"></i> Login</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer>
        <div class="footer">
            <small>&copy; 2024 - All Rights Reserved</small>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('TemplatePixel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('TemplatePixel/js/pixeladmin.min.js') }}"></script>
</body>

</html>
