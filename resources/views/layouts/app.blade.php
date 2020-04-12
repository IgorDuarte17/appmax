<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="description" content="Bendito Look Gestão">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        {{Html::favicon('images/icons/favicon.ico')}}

        <!-- External -->
        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
        <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">

        <link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/chosen/chosen.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    </head>

    <body>
        <!-- Left Panel -->
        @include('layouts.navbar')
        <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
            <!-- Header-->
            @include('layouts.header')
            <!-- Informations of Page -->
            @yield('infos')
            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>
            <div class="clearfix"></div>
            <!-- Footer -->
            @include('layouts.footer')
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        {{ Html::script('assets/js/main.js') }}
        {{ Html::script('assets/js/bootstrap-filestyle/bootstrap-filestyle.min.js') }}
        {{ Html::script('assets/js/custom.js') }}
        {{ Html::script('assets/js/sweetalert2.all.min.js') }}

        <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
        {{ Html::script('assets/js/init/weather-init.js') }}

        <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
        {{ Html::script('assets/js/init/fullcalendar-init.js') }}

        @yield('scripts')

            <script>
                jQuery("body").on('click', '.btnRemoveItem', function(e) {
                    var self = jQuery(this);
                    var element = self.data('target-element');

                    swal({
                        title: 'Remover este item?',
                        text: "Não será possível recuperá-lo!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.value) {

                            e.preventDefault();

                            jQuery.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    _method: 'DELETE'
                                },
                                url: self.data('route'),
                                type: 'POST',
                                dataType: 'json',

                            }).done(function(data) {

                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                toast({
                                    type: data.type,
                                    title: data.message
                                });

                                if(data.code == 200) {
                                    if(jQuery(element).length){
                                        jQuery(element).hide();
                                        self.hide();
                                    } else {
                                        self.parents('.card-box-images').hide();
                                        self.parents('tr').hide();
                                    }
                                }
                            });
                        }
                    });

                });
            </script>

    </body>
</html>
