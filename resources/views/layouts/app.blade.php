<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>@yield('title') - Storebot</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Ubuntu:400,700');

        body {
            color: #4f556c;
            font-family: 'Ubuntu', sans-serif;
            background: #f7f7f8;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .site-header a {
            color: #999;
            transition: ease-in-out color .15s;
        }
        .site-header {
            margin-bottom: 2rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, .1)
        }
        .bg-blue {
            background-color: #6f76d9 !important;
        }
        .btn-primary {
            background: #6f76d9;
            color: #fff !important;
            box-shadow: 0 1px 0 0 transparent;
            transition: box-shadow 200ms ease;
            border-color: #6f76d9;
        }
        .btn-primary:hover {
            background: #6466bd;
            border-color: #6466bd;
        }
        .btn-primary:active {
            background: #534f93 !important;
            border-color: #534f93 !important;
        }
        .hero {
            margin-bottom: 2rem;
        }
        .card {
            border: 1px solid rgba(255, 255, 255, 0.125);
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, .05);
            margin: 1rem 0;
        }
        .card-bordered {
            border:1px solid #e8e8e8 !important;
            margin-bottom: 2rem;
        }
        .btn-outline-primary:active {
            background: #534f93 !important;
            border-color: #534f93 !important;
        }
        .btn-outline-primary:hover {
            background: #534f93 !important;
            border-color: #534f93 !important;
        }
        .fb_iframe_widget {
            margin-left: 22%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-blue site-header">
    <div class="container">
        <a class="navbar-brand" href="#">STOREBOT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
</body>
</html>