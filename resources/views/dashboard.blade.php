<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kwitansi LPKN</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('') }}bubbly/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{ asset('') }}bubbly/css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('') }}bubbly/css/style.green.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('') }}bubbly/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('') }}bubbly/img/favicon.png?3">
    <!-- js -->
    <script src="{{ asset('') }}bubbly/vendor/jquery/jquery.min.js"></script>
    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- select2 -->
    <link rel="stylesheet"
        href="{{ asset('') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}/plugins/select2/css/select2.min.css">
    <script src="{{ asset('') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- datatable -->
    <link rel="stylesheet"
        href="{{ asset('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="{{ asset('') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ asset('') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>

    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>
@include('layouts.dashboard.header')
@include('layouts.dashboard.sidebar')
@yield('content')
@include('layouts.dashboard.footer')

</div>
</div>
<!-- JavaScript files-->
<script src="{{ asset('') }}bubbly/vendor/popper.js/umd/popper.min.js"> </script>
<script src="{{ asset('') }}bubbly/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('') }}bubbly/vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="{{ asset('') }}bubbly/vendor/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{ asset('') }}bubbly/js/charts-home.js"></script>
<script src="{{ asset('') }}bubbly/js/front.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4'
        })
        $(".select2-modal").select2({
            dropdownParent: $("#modalUpload"),
            theme: 'bootstrap4'
        })
    });

</script>

</body>

</html>
