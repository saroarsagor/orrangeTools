<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title', 'Dashboard')</title>

    <!-- All Css Links -->
    @include('backend.includes.partials.style')
    <style>
        .pace-inactive {
            display: none!important;
        } 
        .pace-active {
            display: none!important;
        }

        #toast-container .toast-success {
            background-color: #490d86 !important;
        }

        #toast-container .toast-error {
            background-color: #ff0000 !important;
        }

        #toast-container .toast-progress {
            background-color: #ffffff !important;
            opacity: 1 !important;
        }

        #toast-container .toast-success .toast-title {
            color: inherit !important;
        }

        #toast-container .toast-success .toast-message {
            color: inherit !important;
        }

        .brand-logos img {
            height: 115px;
            width: 196px;
            position: absolute;
            margin-top: -42px;
            left: 5px;
        }

        .open ul li a {
            transition: 0.2s;
        }

        .open ul li a:hover {
            border-radius: 4px;
            z-index: 1;
        }

        .delete-confirm:hover {
            color: #7367F0;
            text-decoration: none;
            background-color: rgba(115, 103, 240, 0.12) !important;
        }
        
        .delete-confirm:focus {
            border: none;
            outline: none;
        }
        
        .delete-confirm:active {
            border: none;
            color: #ffffff;
            background-color: #7367F0 !important;
        }

        .btn-danger{
            background-color: #ea5455c7 !important;
        }

    </style>
    @yield('styles')


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @if (Request::is('dashboard*'))
        @include('backend.includes.header')
    @endif
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        @if (Request::is('dashboard*'))
            @include('backend.includes.sidebar')
        @endif
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <!-- <div class="header-navbar-shadow"></div> -->
        @yield('content')
    </div>
    <!-- END: Content-->

    @if (Request::is('dashboard*'))
        @include('backend.includes.footer')
    @endif



    <!-- All Js Links -->
    @include('backend.includes.partials.script')
    @yield('scripts')

</body>

</html>
