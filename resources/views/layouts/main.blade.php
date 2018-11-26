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
  <link rel="apple-touch-icon" href="{{ URL::asset('Admin/app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('Admin/app-assets/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!-- BEGIN VENDOR CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/vendors.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}" />
  <!-- END VENDOR CSS-->  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/tables/jsgrid/jsgrid-theme.min.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/tables/jsgrid/jsgrid.min.css') }}" />
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/app.css') }}" />
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/colors/palette-gradient.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}" />  
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/charts/morris.css') }}" /> 
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/fonts/simple-line-icons/style.css') }}" />   
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/core/colors/palette-gradient.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/vendors/css/cryptocoins/cryptocoins.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/app-assets/css/pages/under-maintenance.css') }}" />  
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('Admin/assets/css/style.css') }}" />
  <!-- END Custom CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">      
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('main') }}">
                <!--<img class="brand-logo" alt="modern admin logo" src="../../../app-assets/images/logo/logo.png">-->
              <h3 class="brand-text">Gestión Académica</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
            <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Contáctanos</a>
              <ul class="mega-dropdown-menu dropdown-menu row">                               
                
                <li class="col-md-12">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-envelope-o"></i> Contáctanos</h6>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputName1">Nombre</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="text" id="inputName1" placeholder="John Doe">
                            <div class="form-control-position pl-1"><i class="la la-user"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputEmail1">Correo</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="email" id="inputEmail1" placeholder="john@example.com">
                            <div class="form-control-position pl-1"><i class="la la-envelope-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputMessage1">Mensaje</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                            <div class="form-control-position pl-1"><i class="la la-commenting-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 mb-1">
                          <button class="btn btn-info float-right" type="button"><i class="la la-paper-plane-o"></i> Enviar </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </li>           
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Bienvenido,    
                @            
                  <span class="user-name text-bold-700">{{ auth()->user()->email }}</span>
                </span>              
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="ft-user"></i> Editar Perfil</a>                
                <form method="POST" action="{{ route('logout') }}">
                {{ csrf_field() }}
                  
                  <div class="dropdown-divider"></div><button class="dropdown-item ft-power" class="" >Cerrar sesiones</button>
                </form>                
              </div>
            </li>                  
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- MENU -->
  <div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <!--Alumno-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-mortar-board"></i><span class="menu-title" data-i18n="nav.dash.main">Alumnos</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('alumno') }}" data-i18n="nav.dash.ecommerce">Gestionar Alumno</a></li>
            <li><a class="menu-item" href="{{ route('matriculas') }}" data-i18n="nav.dash.crypto">Gestionar Matrícula</a></li>            
          </ul>
        </li>
        <!--Docente-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-slideshare"></i><span class="menu-title" data-i18n="nav.dash.main">Docentes</span></a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('maestros') }}" data-i18n="nav.templates.horz.classic">Gestionar Docente</a></li>                
                <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.horz.classic">Gestionar Inasistencia</a></li>                                            
              </ul>
        </li>
        <!--Observador Alumno-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-pencil-square-o"></i><span class="menu-title" data-i18n="nav.dash.main">Observador Alumnos</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('observaciones') }}" data-i18n="nav.dash.ecommerce">Gestionar Observador</a></li>                        
          </ul>
        </li>
        <!--Inasistencia-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-calendar-times-o"></i><span class="menu-title" data-i18n="nav.dash.main">Inasistencias</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('inasistencias') }}" data-i18n="nav.dash.ecommerce">Gestionar Inasistencia</a></li>                        
          </ul>
        </li>
        <!--Registro Notas-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-check-circle-o"></i><span class="menu-title" data-i18n="nav.dash.main">Registro Notas</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('evaluaciones') }}" data-i18n="nav.dash.ecommerce">Gestionar Registro Nota</a></li>                        
          </ul>
        </li>
        <!--Reportes-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-file-text-o"></i><span class="menu-title" data-i18n="nav.dash.main">Reportes</span></a>
          <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.dash.sales">Reportes Matrícula</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.horz.top_icon">Reportes Docente</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.dash.sales">Reportes Aula</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.vert.compact_menu">Reportes Área</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.horz.top_icon">Reportes Materia</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.horz.top_icon">Reportes Asignatura</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.horz.top_icon">Reportes Logro</a></li>
              <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.vert.compact_menu">Reportes Institución</a></li>
          </ul>
        </li>
        <!--Pensum-->
        <li class=" nav-item"><a href="{{ route('main') }}"><i class="la la-bookmark"></i><span class="menu-title" data-i18n="nav.templates.main">Pensum</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('areas') }}" data-i18n="nav.templates.vert.classic_menu">Gestionar Área</a></li>
            <li><a class="menu-item" href="{{ route('asignaturas') }}" data-i18n="nav.templates.horz.classic">Gestionar Asignatura</a></li>
            <li><a class="menu-item" href="{{ route('logros') }}" data-i18n="nav.templates.horz.classic">Gestionar Logro</a></li>
            <li><a class="menu-item" href="{{ route('materia') }}" data-i18n="nav.templates.horz.classic">Gestionar Materia</a></li>
          </ul>
        </li>   
        <!--Grupos-->
        <li class=" nav-item"><a href="{{ route('main') }}"><i class="la la-group"></i><span class="menu-title" data-i18n="nav.templates.main">Grupos</span></a>
          <ul class="menu-content">             
              <li><a class="menu-item" href="{{ route('aulas') }}" data-i18n="nav.dash.ecommerce">Gestionar Aula</a></li>            
              <li><a class="menu-item" href="{{ route('grados') }}" data-i18n="nav.templates.horz.classic">Gestionar Grados</a>
              <li><a class="menu-item" href="{{ route('tgrupos') }}" data-i18n="nav.templates.horz.classic">Gestionar Asignaturas Grupo</a>
              <li><a class="menu-item" href="{{ route('grupos') }}" data-i18n="nav.dash.ecommerce">Gestionar Grupo</a></li>
          </ul>
        </li>
        <!--Configuracion-->
        <li class="nav-item"><a href="{{ route('main') }}"><i class="la la-gears"></i><span class="menu-title" data-i18n="nav.dash.main">Configuraciones</span></a>
          <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('jornadas') }}" data-i18n="nav.templates.horz.classic">Gestionar Jornadas</a>
              <li><a class="menu-item" href="{{ route('sedes') }}" data-i18n="nav.templates.horz.classic">Gestionar Sedes</a>
              <li><a class="menu-item" href="{{ route('calificaciones') }}" data-i18n="nav.templates.horz.classic">Configurar Calificaciones</a>
          </ul>
        </li>

        <!--Super Administrador-->
        <li class="nav-item hidden"><a href="{{ route('main') }}"><i class="la la-key"></i><span class="menu-title" data-i18n="nav.templates.main">Administraciónes</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('main') }}" data-i18n="nav.templates.vert.main">Instituciones</a>
              <ul class="menu-content">
                <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.vert.classic_menu">Gestionar Institución</a>
                </li>                
                <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.templates.vert.compact_menu">Reportes Institución</a>
                </li>                
              </ul>
            </li>
            <li><a class="menu-item" href="{{ route('cons') }}" data-i18n="nav.dash.crypto">Asignaciones Módulo</a>
          </ul>
        </li>
        
        
      </ul>
    </div>
  </div>
  <!--Contenido-->
  <div class="app-content content">
    <div class="content-wrapper">      
      <div class="content-body">        
        @yield('content')        
      </div>
    </div>
  </div>
  <!-- Pie de pagina-->
  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Gestión Académica &copy; 2018</span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Una plataforma creada con <i class="ft-heart pink"></i></span>
    </p>
  </footer>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- BEGIN VENDOR JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/vendors.min.js') }}"></script>
  <!-- BEGIN VENDOR JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/buttons.flash.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/jszip.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/buttons.print.min.js') }}"></script>


  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/jsgrid/jsgrid.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/tables/jsgrid/griddata.js') }}"></script>  
  
  <!-- BEGIN PAGE VENDOR JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/chart.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/morris.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/data/jvector/visitor-data.js') }}"></script>   
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/vendors/js/charts/echarts/echarts.js') }}"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/core/app-menu.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/core/app.js') }}"></script>  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/customizer.js') }}"></script>
  <!--Chart-->
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/pages/dashboard-sales.js') }}"></script>          
  <!-- END MODERN JS-->  
  {{-- <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/tables/datatables/datatable-advanced.js') }}"></script>   --}}
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/navs/navs.js') }}"></script>
  <!-- BEGIN PAGE LEVEL JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/pages/dashboard-crypto.js') }}"></script>
  <!-- END PAGE LEVEL JS-->  
  <script type="text/javascript" src="{{ URL::asset('Admin/app-assets/js/scripts/tables/jsgrid/jsgrid.js') }}"></script>

  <script type="text/javascript" src="{{ URL::asset('Admin/assets/js/scripts.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
  <!-- Swwet alert -->  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  @yield('script')
</body>
</html>