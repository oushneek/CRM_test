<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('partials.header')


    <!-- Left side column. contains the logo and sidebar -->
    @include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.flash-message')
        @yield('content')
    </div>

    @include('partials.footer')
</div>

@vite(['resources/js/app.js'])

@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
