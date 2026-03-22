<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Futzada</title>
   <link rel="icon" type="image/png" href="/img/logo.png">
   {{-- Bootstrap --}}
   <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
   {{-- Font Awesome --}}
   <link rel="stylesheet" href="/plugins/fontawesome/css/all.min.css">
   {{-- AOS --}}
   <link rel="stylesheet" href="/plugins/aos/css/aos.min.css">
   {{-- Custom Styles --}}
   <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
   @include('layout.header')
   @yield('content')
   @include('layout.footer')
</body>
</html>