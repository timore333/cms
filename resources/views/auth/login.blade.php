<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('theme/assets/images/favicon.png')}}">
    <title>Login</title>
    
    <!-- page css -->
    <link href="{{asset('theme/dark/dist/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('theme/dark/dist/css/style.min.css')}}" rel="stylesheet">
        <script src="{{asset('theme/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(theme/assets/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                {{-- show the reset form if server return errors --}}
                @if($errors->first('email'))
                    <script>
                        $(function() {
                            $('#to-recover').click();
                        });
                    </script>
                @endif
                @if(session('status'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> We send a rest link to you, check your email to rest your password.
                    </div>
                @endif

                <form class="form-horizontal form-material text-center  @if($errors->has('username'))form-control-line @endif" id="loginform" method="POST" action="{{ route('login') }}">
                    @csrf
                    <a href="javascript:void(0)" class="text-center db"><img src="{{asset('theme/assets/images/logo-light-icon1.png')}}" width="200px" height="200px" alt="Home" /></a>

                    <div class="form-group @if($errors->has('username'))has-danger @endif">
                        <div class="col-xs-12">
                            <input class="form-control  @if($errors->has('username'))form-control-danger @endif" type="text" name="username" value="{{ old('username') }}"  placeholder="Username">
                        </div>
                        @if($errors->has('username'))
                            <div class="form-control-feedback text-danger">
                               {{ $errors->first('username')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password"  placeholder="Password">
                        </div>
                        @if($errors->has('password'))
                        <div class="form-control-feedback text-danger">
                           {{ $errors->first('password')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                <a href="#"  id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> 
                            </div>     
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">Log In</button>
                        </div>
                    </div>

                </form>
                <form class="form-horizontal {{ $errors->has('email')? 'error' : '' }}"  id="recoverform" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>{{ $errors->has('email')? 'Error !' : 'Recover Password' }}</h3>
                            <p class="{{ $errors->has('email')? 'text-danger' : 'text-muted' }}">
                                {{ $errors->has('email')?
                                    $errors->first('email'):
                                    'Enter your Email and instructions will be sent to you!'
                                }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('theme/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('theme/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    
</body>

</html>