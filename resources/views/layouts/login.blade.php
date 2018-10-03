<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Gestión académica</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/images/ico/apple-icon-120.png') }}" />
  <link rel="stylesheet" type="image/x-icon" href="{{ URL::asset('Admin/app-assets/images/ico/favicon.ico') }}" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/vendors.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/forms/icheck/icheck.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/forms/icheck/custom.css') }}" />
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/app.css') }}" />
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/colors/palette-gradient.css') }}" />
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/assets/css/style.css') }}" />
  <!-- END Custom CSS-->  
  <link rel="apple-touch-icon" href="{{ URL::asset('Admin/app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('Admin/app-assets/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">  
  <!-- BEGIN Page Level CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/plugins/animate/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/fonts/simple-line-icons/style.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/colors/palette-callout.css') }}">    
  <style>
    body {         
        background-image: url("Admin/assets/Img/Login/body-login.png"); 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
     }
  </style>
</head>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 text-center">
                  <img src="Admin/assets/Img/Login/desktop.png" }} alt="unlock-user"
                  class="rounded-circle img-fluid center-block">                                    
                </div>
                @if(session()->has('flash'))
                  <div class="col-md-12 mb-2">
                        <div class="alert alert-danger" role="alert">
                          <strong>Oh snap!</strong> {{ session('flash') }}                          
                          <a class="alertAnimation float-right" data-animation="zoomIn">
                            <i class="icon-arrow-right"></i>
                          </a>
                        </div>
                  </div>                  
                @endif
                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                  <span>Iniciar sesión</span>
                </p>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
                      <fieldset class="form-group position-relative has-icon-left" {{ $errors->has('email') ? 'has-error' : '' }}>
                      {{ csrf_field() }}
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-lg input-lg" id="user-name"
                        placeholder="Ingrese su usuario">
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        <div class="form-control-position">
                          <i class="la la-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left" {{ $errors->has('Contrasena') ? 'has-error' : '' }}>
                        <input type="password" name="Contrasena" class="form-control form-control-lg input-lg" id="password"
                        placeholder="Ingrese su contraseña">
                        {!! $errors->first('Contrasena', '<span class="help-block">:message</span>') !!}
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-12 col-12 text-center text-sm-left">
                          <fieldset>
                          <div class="col-md-12 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link"><i class="ft-unlock"></i> ¿Se te olvido la contraseña?</a></div>
                          </fieldset>
                        </div>                        
                      </div>                                                                                                                           
                      <button type="submit" class="btn btn-outline-primary btn-lg btn-block"><i class="la la-lock"></i>Iniciar sesión</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/vendors.min.js') }}"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/core/app-menu.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/core/app.js') }}"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/forms/form-login-register.js') }}"></script>
  <!-- END PAGE LEVEL JS-->
  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/animation/jquery.appear.js') }}"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/customizer.js') }}"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/animation/animation.js') }}"></script>
</body>
</html>