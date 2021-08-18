<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="VersatileReports es un software encargado de prestar servicios de ejecuccion contractual al SENA">
    <meta name="keywords" content="VersatileReports, Sena VersatileReports, versatilereports, reportes versatiles, reportes agiles, VersatileReports SENA">
    <meta name="author" content="Jorge Asdrúbal Ortega González">
    <title>VersatileReports</title>

    <link rel="icon" href="{{ asset('dashboard/assets/img/logo.png') }}">
    <link href="{{ asset('dashboard/assets/fonts/fonts_googleapis.css') }}" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/meteocons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/chartist-plugin-tooltip.css') }}">
    <!-- END: Vendor CSS-->

    <!-- Proteccion ataques csfr -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FIn proteccion ataques csfr -->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/core/menu/menu-types/vertical-compact-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/mobiriseicons/24px/mobirise/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/pages/dashboard-travel.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    {{-- <link rel="stylesheet" href="{{ asset('datatable/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('datatable/css/datatables.min.css') }}">

    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

    @yield('style') {{-- Incluir estilos especiales de alguna pagina --}}

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.plantilla.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->

    @include('layouts.plantilla.sidebar')

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield('contenido')
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    @include('layouts.plantilla.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/data/jvector/visitor-data.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboard/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('datatable/js/datatables.min.js') }}"></script>

    <script src="{{ asset('jquery_validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('jquery_validate/additional-methods.min.js') }}"></script>
    
    @yield('javascript') {{-- Incluir javascript especiales de alguna pagina --}}
    
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('select').select2({    
                language: {
                    noResults: function() {
                        return "No hay resultados";        
                    },
                    searching: function() {
                        return "Buscando..";
                    }
                }
            });

        });
    </script>
</body>
<!-- END: Body-->

</html>