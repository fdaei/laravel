@extends('adminlte::page')

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle') | @yield('subtitle') @endif
@stop

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted text-right">
            @yield('content_header_title')
            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-left text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

@section('content')
    @yield('content_body')
@stop

@if(config('adminlte.right_sidebar'))
    @section('right-sidebar')
        <div class="p-3 text-right">
            @yield('right_sidebar_content')
        </div>
    @stop
@endif

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            var buttons =
                '<li class="navbar-nav mr-auto">' +
                '<a class="nav-link" href="/logout">' +
                '<i class="fa fa-fw fa-sign-out-alt text-red"></i>' +
                '{{ Auth::user()->mobile }}' +
                '</a>' +
                '</li>';
            $('.main-header').append(buttons);
        });
    </script>
    <script src="{{ asset('build/assets/app-Cwlupodu.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app-D-sv12UV.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.css') }}">
    <style type="text/css">
        /* Apply margin-right instead of margin-left for RTL layout */
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper,
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer,
        body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
            transition: margin-right .3s ease-in-out;
            margin-right: 250px;
            margin-left: 0 !important;
        }

        @media (min-width: 992px) {
            .sidebar-mini.sidebar-collapse .content-wrapper,
            .sidebar-mini.sidebar-collapse .main-footer,
            .sidebar-mini.sidebar-collapse .main-header {
                margin-right: 4.6rem !important;
            }
        }

        .main-sidebar {
            right: 0;
            left: auto;
        }

        .control-sidebar {
            text-align: right;
        }

        .navbar-nav.ml-auto {
            display: none;
        }


        .main-header{
            direction: rtl;
            text-align: right;
        }

        nav.main-header.navbar.navbar-expand-md.ml-auto.navbar-light {
            direction: rtl;
        }

        .brand-link {
            direction: rtl;
            text-align: right;
        }

        .sidebar nav ul.nav-sidebar li.nav-item .nav-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
        }
        .fa-angle-left:before {
            content: "\f104";
            margin: -16px;
        }
    </style>
@endpush
