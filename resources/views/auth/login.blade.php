
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
        <title>Krushi Marathi - Sign In</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/custome.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/components.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/admin/css/colors.css')}}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/loaders/pace.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/admin/js/core/libraries/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/admin/js/core/libraries/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/loaders/blockui.min.js')}}"></script>
        <!-- /core JS files -->
        
        <!-- Theme JS files -->
        <script type="text/javascript" src="{{asset('public/assets/admin/js/core/app.js')}}"></script>

        <script type="text/javascript" src="{{asset('public/assets/admin/js/plugins/ui/ripple.min.js')}}"></script>
        <!-- /theme JS files -->

    </head>

    <body class="login-container">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">
                          
                        <!-- Simple login form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300">
                                        <i class="icon-reading"></i>
                                    </div>
                                    <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control"  placeholder="Username" autofocus>
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @error('email')
                                        <span class="help-block help-block_form" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @error('password')
                                        <span class="help-block help-block_form" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-pink-400 btn-block">{{ __('Log in') }}<i class="icon-circle-right2 position-right"></i></button>
                                </div>

                                <div class="text-center">
                                    <a href="#">Forgot password?</a>
                                </div>
                            </div>
                        </form>
                        <!-- /simple login form -->

                        <div class="footer text-muted text-center">
                           © <?php echo Date('Y'); ?>. <a href="#">Krushi Marathi</a>
                        </div>
