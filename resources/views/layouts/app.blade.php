<html>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name') }} | {{ config('app.owner_name') }}</title>
    <!-- BOOTSTRAP V5 CSS IMPORT LINK -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FONT AWESOME V5.15.2 IMPORT LINK -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- GOOGLE FONTS FAMILY ROBOTO IMPORT LINK -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- LOCAL CSS PROPERTIES -->
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
    </head>
    <body>
        @section('sidebar')

        @show

        <div class="container-fluid">
            @yield('content')
        </div>

    <!-- BOOTSTRAP V5 BUNDLE WITH POPPER.JS IMPORT LINK -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- GOOGLE CHARTS IMPORT LINK -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- GOOGLE CHARTS IMPORT LINK -->
        <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
    </body>
</html>