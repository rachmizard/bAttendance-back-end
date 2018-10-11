<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="{{asset('/template/css/bootstrap.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/animate.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/font.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('/template/css/app.css')}}" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="#">{{ config('app.name', 'Laravel') }}</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Sign in As Admin</strong>
        </header>
        <form class="panel-body wrapper-lg" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
          <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label class="control-label">Email</label>
            <input type="email" name="email" placeholder="test@example.com" class="form-control input-lg">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label class="control-label">Password</label>
            <input type="password" name="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
          <div class="line line-dashed"></div>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Birutekno Inc<br>&copy; 2018</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="{{asset('/template/js/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('/template/js/bootstrap.js')}}"></script>
  <!-- App -->
  <script src="{{asset('/template/js/app.js')}}"></script>
  <script src="{{asset('/template/js/app.plugin.js')}}"></script>
  <script src="{{asset('/template/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
  
</body>
</html>
