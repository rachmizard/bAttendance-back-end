<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="app">
<head>
  <meta charset="utf-8" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="{{asset('/template/css/bootstrap.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/animate.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/font.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/js/calendar/bootstrap_calendar.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/app.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/js/datepicker/datepicker.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/js/datatables/datatables.css')}}" type="text/css"/>
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
  <style type="text/css">
      .loading{
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
      }
      .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
      }
      .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
      }
  </style>

  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>
</head>
<body>
  <section class="vbox" id="app">
    <alert-box v-if="$root.expired" :title="title" :message="message" :type="type"></alert-box>
    <transition name="fade">
      <div class="loading">
          <loading v-if="$root.loading"></loading>
      </div>
    </transition>
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo_attendance.png" class="m-r-md">{{ config('app.name', 'Laravel') }}</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <!-- <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
            <i class="fa fa-building-o text-white"></i>
            <span class="font-bold text-white">Activity</span>
          </a> -->
          <a href="#nav" data-toggle="class:nav-xs" class="dker pull-right text-white">
            <i class="fa fa-align-justify text"></i>
            <i class="fa fa-align-left text-active text-white"></i>
          </a>
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="images/avatar.jpg" class="img-circle">
              </a>
              <div class="clear">
                <a href="#"><span class="text-white font-bold">@Mike Mcalidek</a></span>
                <small class="block">Art Director</small>
                <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a>
              </div>
            </div>
            <div class="row m-l-none m-r-none m-b-n-xs text-center">
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">245</span>
                  <small class="text-muted">Followers</small>
                </div>
              </div>
              <div class="col-xs-4 dk">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">55</span>
                  <small class="text-muted">Likes</small>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <span class="m-b-xs h4 block text-white">2,035</span>
                  <small class="text-muted">Photos</small>
                </div>
              </div>
            </div>
          </section>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell text-white"></i>
            <!-- <span class="badge badge-sm up bg-danger m-l-n-sm count text-white">70</span> -->
          </a>
          <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>You have <span class="count">2</span> notifications</strong>
              </header>
              <div class="list-group list-group-alt animated fadeInRight">
                <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="images/avatar.jpg" alt="John said" class="img-circle">
                  </span>
                  <span class="media-body block m-b-none">
                    Use awesome animate.css<br>
                    <small class="text-muted">10 minutes ago</small>
                  </span>
                </a>
                <a href="#" class="media list-group-item">
                  <span class="media-body block m-b-none">
                    1.0 initial released<br>
                    <small class="text-muted">1 hour ago</small>
                  </span>
                </a>
              </div>
              <footer class="panel-footer text-sm">
                <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
              </footer>
            </section>
          </section>
        </li>
        <!-- <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
          <section class="dropdown-menu aside-xl animated fadeInUp">
            <section class="panel bg-white">
              <form role="search">
                <div class="form-group wrapper m-b-none">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </form>
            </section>
          </section>
        </li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="images/logo_attendance.png">
            </span>
            <span class="text-white">{{ Auth::user()->name }}</span><b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" data-toggle="ajaxModal">
                  Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print" id="nav">
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">

                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li class="active">
                      <a href="{{ route('home') }}" class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="text-black">Dashboard</span>
                      </a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    <li >
                      <a href="#layout"  >
                        <i class="fa fa-columns icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Master Data</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="{{ route('karyawan') }}">
                            <i class="fa fa-group"></i>
                            <span>Karyawan</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('jam.index') }}" >
                            <i class="fa fa-clock-o"></i>
                            <span>Jadwal Masuk</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role == 'pm')
                    <li>
                      <a href="{{route('approval-lembur.index')}}"  >
                        <!-- <b class="badge bg-danger pull-right">3</b> -->
                        <i class="fa fa-check">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Approval Lembur</span>
                        <!-- <count-approval></count-approval> -->
                      </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 'admin')
                    <li>
                      <a href="{{route('history.indexview')}}"  >
                        <!-- <b class="badge bg-danger pull-right">3</b> -->
                        <i class="fa fa-clock-o icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>History Absensi</span>
                      </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pm' || Auth::user()->role == 'ga')
                    <li >
                      <a href="{{ route('absen-admin.view') }}"  >
                        <i class="fa fa-user icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Absen Admin</span>
                      </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 'admin')
                    <li >
                      <a href="{{ route('rekap-admin.index') }}#/list_karyawan"  >
                        <i class="fa fa-book icon">
                          <b class="bg-info"></b>
                        </i>
                        <span>Rekapan Absensi</span>
                      </a>
                    </li>
                    @endif
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>

            <!-- <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      John <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-info btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-info" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-info" data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
              </div>
            </footer> -->
          </section>
        </aside>
        <!-- /.aside -->
        @yield('content')
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>

  <!-- <script type="text/template" src="{{asset('/template/js/jquery.min.js')}}"></script> -->
  <!-- Bootstrap -->
  <script type="text/template" src="{{asset('/template/js/bootstrap.js')}}"></script>
  <!-- App -->
  <script src="{{asset('/js/app.js')}}"></script>
  <script src="{{asset('/template/js/app.js')}}"></script>
  <script src="{{asset('/template/js/app.plugin.js')}}"></script>
  <script src="{{asset('/template/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('/template/js/charts/easypiechart/jquery.easy-pie-chart.js')}}"></script>
  <script src="{{asset('/template/js/charts/sparkline/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('/template/js/charts/flot/jquery.flot.min.js')}}"></script>
  <script src="{{asset('/template/js/charts/flot/jquery.flot.tooltip.min.js')}}"></script>
  <script src="{{asset('/template/js/charts/flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('/template/js/charts/flot/jquery.flot.grow.js')}}"></script>
  <script src="{{asset('/template/js/charts/flot/demo.js')}}"></script>

  <script src="{{asset('/template/js/calendar/bootstrap_calendar.js')}}"></script>
  <script src="{{asset('/template/js/calendar/demo.js')}}"></script>

  <script src="{{asset('/template/js/sortable/jquery.sortable.js')}}"></script>
  <!-- datepicker -->
  <script src="{{asset('/template/js/datepicker/bootstrap-datepicker.js')}}"></script>
  <!-- combodate -->
  <script src="{{asset('/template/js/libs/moment.min.js')}}"></script>
  <script src="{{asset('/template/js/combodate/combodate.js')}}"></script>

  <!-- datatables -->
  <!-- <script src="{{asset('/template/js/datatables/jquery.dataTables.min.js')}}"></script> -->
  <!-- DataTables -->
  <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  @stack('javascript')

</body>
</html>
