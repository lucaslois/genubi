<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genubi Reborn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.dropdown').hover(function () {
        $(this).find('.dropdown-menu').first().show();
    }, function () {
        $(this).find('.dropdown-menu').first().hide();
    });
    $('.dropdown-submenu').hover(function () {
        $(this).find('.dropdown-menu').first().show();
    }, function () {
        $(this).find('.dropdown-menu').first().hide();
    });

    $(window).scroll(function (event) {
        let scroll = $(window).scrollTop();
        let check = false;
        let secondbar = $('#secondbar');
        if (secondbar.length == 0) return;
        if (scroll > 120)
            secondbar.addClass('fixed-top');
        else
            secondbar.removeClass('fixed-top');
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
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

    function confirmDelete(link) {
        swal({
            title: "¿Estás seguro?",
            text: "Una vez eliminado, no podrás recuperarlo",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = link;
                }
            });
    }
</script>
<!-- Ends Alert (alerts.blade.php) -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146742304-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-146742304-2');
</script>

<!-- CUSTOM JS -->
@stack('js')
<!-- END CUSTOM JS -->
</body>
</html>
