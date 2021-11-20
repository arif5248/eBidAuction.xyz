<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link name="favicon" type="image/x-icon" href="{{my_asset('img/favicon.png')}}" rel="shortcut icon" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ my_asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ my_asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!--active-shop Stylesheet [ REQUIRED ]-->
    <link href="{{ my_asset('css/active-shop.min.css')}}" rel="stylesheet">

    <!--active-shop Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ my_asset('css/demo/active-shop-demo-icons.min.css')}}" rel="stylesheet">

    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ my_asset('css/demo/active-shop-demo.min.css') }}" rel="stylesheet">

    <!--Theme [ DEMONSTRATION ]-->
    <link href="{{ my_asset('css/themes/type-c/theme-navy.min.css') }}" rel="stylesheet">

    <link href="{{ my_asset('css/custom.css') }}" rel="stylesheet">

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src=" {{my_asset('js/jquery.min.js') }}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ my_asset('js/bootstrap.min.js') }}"></script>


    <!--active-shop [ RECOMMENDED ]-->
    <script src="{{ my_asset('js/active-shop.min.js') }}"></script>

    <!--Alerts [ SAMPLE ]-->
    <script src="{{ my_asset('js/demo/ui-alerts.js') }}"></script>

    <!--Switchery [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/switchery/switchery.min.js')}}"></script>

    <!--DataTables [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ my_asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ my_asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="{{ my_asset('js/demo/tables-datatables.js')}}"></script>

    <!--Select2 [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/select2/js/select2.min.js')}}"></script>

    <!--Summernote [ OPTIONAL ]-->
    <script src="{{ my_asset('js/jodit.min.js') }}"></script>

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>

    <!--Bootstrap Wizard [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{ my_asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!--Form Component [ SAMPLE ]-->
    <script src="{{my_asset('js/demo/form-wizard.js')}}"></script>

    <!--Spectrum JavaScript [ REQUIRED ]-->
    <script src="{{ my_asset('js/spectrum.js')}}"></script>

    <!--Spartan Image JavaScript [ REQUIRED ]-->
    <script src="{{ my_asset('js/spartan-multi-image-picker-min.js') }}"></script>

    <!--Custom JavaScript [ REQUIRED ]-->
    <script src="{{ my_asset('js/custom.js')}}"></script>

</head>
<body>
    @foreach (session('flash_notification', collect())->toArray() as $message)
        <script type="text/javascript">
            $(document).on('nifty.ready', function() {
                showAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
            });
        </script>
    @endforeach
    <div id="container" class="">
        <div class="cls-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel">
                            <div class="panel-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('script')

</body>
</html>
