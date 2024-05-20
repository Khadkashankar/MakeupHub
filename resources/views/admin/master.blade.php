    <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
@yield('css')
<style type="text/css">

  #loading{
    background: white url('{{asset('/preloader/preloader.gif')}}');
    background-position: center;
    background-repeat: no-repeat;
    position: fixed;
    height: 100vh;
    width: 100%;
    left: 0;
    z-index: 99999;
  }
  #MakeType{
    display: inline-block;
  }
</style>

</head>


<body onload="myfunction()">
  <div id="loading"></div>
  <div class="wrapper ">
    <div class="sidebar" data-color="red">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="/dashboard" class="simple-text logo-normal">
          Makeup Hub
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">

       <li class="@yield('dashboard')">
            <a href="{{asset('dashboard')}}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="@yield('reguser')">
            <a href="{{asset('registered')}}">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>Total Users</p>
            </a>
          </li>
          <li class="@yield('totalartists')">
            <a href="{{asset('artists')}}">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>Total Artists</p>
            </a>
          </li>
          <li class="@yield('appoints')">
            <a href="{{asset('appoints')}}">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              <p>Total Appointments</p>
            </a>
          </li>

           <li class="@yield('makeupcat')">
            <a href="{{asset('makeupcategory')}}">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
              <p>Cosmetics Category</p>
            </a>
          </li>

           <li class="@yield('makeupmenu')">
            <a href="{{asset('makeupmenu')}}">
              <i class="fas fa-bars" aria-hidden="true"></i>
              <p>Cosmetics Menu</p>
            </a>
          </li>

          <li class="@yield('orders')">
            <a href="{{asset('orders')}}">
              <i class="fas fa-shopping-cart" aria-hidden="true"></i>
              <p>Orders</p>
            </a>
          </li>

          <li class="@yield('district')">
            <a href="{{asset('district')}}">
              <i class="fas fa-city" aria-hidden="true"></i>
              <p>District</p>
            </a>
          </li>
          <li class="@yield('city')">
            <a href="{{asset('city')}}">
              <i class="fas fa-city" aria-hidden="true"></i>
              <p>City</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <!-- <a class="navbar-brand" href="#pablo">Table List</a> -->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold text-success" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <i class="fa fa-user"></i> {{ Auth::user()->name }} <!-- <span class="caret"></span> -->
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->



       <div class="panel-header panel-header-sm">
      </div>

@yield('content')

      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="/dashboard">
                  Makeup Hub
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; {{ date('Y')}} All rights reserved</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  @yield('js')
  <script type="text/javascript">

    var pl = document.getElementById('loading');

    function myfunction(){
      pl.style.display = 'none';
    }
  </script>
</body>

</html>
