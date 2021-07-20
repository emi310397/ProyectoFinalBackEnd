<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8" />
      <link rel="icon" type="image/png" href="/assets/favicon-32x32.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>
        @yield('title')
      </title>
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
      <!--     Fonts and icons     -->
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
      <!-- CSS Files -->
      <link href="/materialkit/css/material-kit.css?v=2.1.1" rel="stylesheet"/>
      <style>
        .page-header {
            background-color: #EDEDED;
        }

        .icon {
            font-size: 180px;
            color: #5F25FD !important;
        }

        .description {
            font-weight: 400 !important;
        }

        h2 {
            color: #18093F !important;
        }

        h4 {
            color: #91959C !important;
        }

        .go-home-button {
            background: #D7C8FE;
            font: Bold 14px/19px Roboto;
            letter-spacing: 0.13px;
            color: #18093F;
            margin-top: 32px;
        }

        .go-home-button:hover, .go-home-button:focus, .go-home-button:active {
            background: #D7C8FE !important;
            color: #18093F !important;
        }
      </style>
    </head>

    <body class="error-page sidebar-collapse">
      <div class="page-header error-page">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <span class="material-icons icon">desktop_access_disabled</span>
              <h2 class="description">Esta página no está disponible</h2>
              <h4 class="description">Nuestro sitio web está en construcción</h4>
              <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                   <button class="btn go-home-button">Ir a inicio</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
