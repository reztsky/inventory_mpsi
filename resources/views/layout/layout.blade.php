<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@5/dist/style.css" rel="stylesheet" type="text/css">
    @vite(['resources/js/app.js'])
    @stack('style')
</head>
<body>
    @include('layout.navbar-top')
    <div id="layoutSidenav">
        @include('layout.sidebar')
        <div id="layoutSidenav_content">
            @include('layout.toast')
            @yield('content')
            @include('layout.footer')
        </div>
    </div>
</body>
@stack('script')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@5" type="text/javascript"></script>
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</html>