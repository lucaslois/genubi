<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- CUSTOM CSS -->
    @stack('css')
    <!-- END CUSTOM CSS -->
</head>
<body>
<!-- CUSTOM TOPBAR -->
@include('layouts.components.topbar')
<!-- END CUSTOM TOPBAR -->
<!-- CUSTOM NAVBAR -->
@include('layouts.components.navbar')
<!-- END CUSTOM NAVBAR -->

<!-- CUSTOM CONTENT -->
@yield('content')
<!-- END CUSTOM CONTENT -->

<!-- CUSTOM FOOTER -->
@include('layouts/components/footer')
<!-- END CUSTOM FOOTER -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('li.nav-item.dropdown').hover(function() {
        $(this).find('.dropdown-menu').show();
    }, function() {
        $(this).find('.dropdown-menu').hide();
    });
</script>
<!-- Starts Alert (alert.blade.php) -->
<script>
    @if(Alert::exists())
        const text = @json(Alert::get());
        swal(
            'Éxito!',
            text,
            'success'
        )
    @endif
</script>
<!-- Ends Alert (alerts.blade.php) -->

<!-- CUSTOM JS -->
@stack('js')
<!-- END CUSTOM JS -->
</body>
</html>