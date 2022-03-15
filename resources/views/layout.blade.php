<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel crud</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    @yield('style')
       
</head>
<body>
    

@yield('content')
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
        <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('js/toastr.min.js')}}"></script>
        @yield('script')
</body>
</html>