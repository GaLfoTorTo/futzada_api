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
   {{-- Custom Styles --}}
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
   <nav class="navbar navbar-expand-lg nav_bar_custom bg-green-300">
      <div class="container">
         <a class="navbar-brand d-flex align-items-center justify-content-between" href="#">
           <img src="img/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
           <h3 class="fw-bold text-blue-500">Futzada</h3>
         </a>
         <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
              </li>
            </ul>
         </div>
         <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Entrar</a>
              </li>
              <div class="vr"></div>
              <li class="nav-item">
                <a class="nav-link" href="#">Cadastre-se</a>
              </li>
            </ul>
         </div>
      </div>
   </nav>
    @yield('content')
   <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>