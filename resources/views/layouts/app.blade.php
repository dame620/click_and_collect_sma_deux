<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- links from mandi -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"
    />
 <!-- startbootstrap link for pagination -->
 <!-- bootstrap link for pagination -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-api-url" content="{{ url('/api') }}">

    <meta name="isAuth" content="{{ Auth::check() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

     <!-- Links for Dashboard -->
    <link rel="stylesheet" id="dashboard_styles" href="{{ asset('css/dashboard_styles.css') }}">
     
     <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>

        :root {
            --secondary: rgb(218, 175, 127);
            --main-color:rgb(233, 154, 60);
            --color-dak: #1D2231;
            --text-grey: #8390A2;
        }

        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        .fade-leave, .fade-enter-to {
            opacity: 1;
        }

        .fade-enter-active, .fade-leave-active {
            transition:.3s;
        }
        .text-center {
            text-align:center;
        }

        .pagination{
            display: flex;
            width:max-content;
            margin: 0 auto ;
            list-style:none;
        }

        .pagination .page-item {
            
        }

        .pagination .page-link {
            padding:10px 15px;
            border-radius:5px;

            border:1px solid #fff;

            margin-right:5px;
            text-decoration:none;
            background-color:#fff;
            color:rgb(235, 156, 56);
        }
        .pagination .page-item.active .page-link {
            background-color:rgb(235, 156, 56);
            color:#fff;
        }

    </style>
</head>
<style>
  body, #app {
    width:100%;
    margin:0;
    padding:0;
    box-sizing:border-box;
  }
</style>
<body>
    <div id="app">
        <app />
    </div>
</body>
</html>
