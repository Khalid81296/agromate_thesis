
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>লগইন | {{ config('app.name') }}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!-- <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
<link href="{{ asset('/login_assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('/login_assets/admin/pages/css/login.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('/login_assets/global/css/components-rounded.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/admin/layout/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('/login_assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/login_assets/admin/pages/css/login-soft.css') }}" rel="stylesheet" type="text/css"/>
<!-- <link href="{{ asset('/css/common.css') }}" rel="stylesheet" type="text/css"/> -->

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<style>
    html { 
  background: url({{ asset('media/custom/logo.jpg') }}) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<body class="page-md login" style="background: transparent !important;">  
<!-- BEGIN LOGO -->
    <div class="logo">
        <a href="#">
            <img src="{{ asset('media/logos/civil-suit-logo.png') }}" style="width: 360px;" alt="" /> 
        </a>
    </div>
<!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
       <br>
        <!-- BEGIN LOGIN FORM -->
        <div style="display: block; overflow: hidden; margin-bottom: 5px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- <div class="text-danger font-lg msgBox"> ব্যবহারকারীর আই ডি, পাসওয়ার্ড ও ওটিপি সঠিক ভাবে দিন </div> -->
                <div class="form-group otp-hidden">
                    <!-- <label class="control-label visible-ie8 visible-ie9">Username</label> -->
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input id="email" type="text" class="form-control placeholder-no-fix @error('email') is-invalid @enderror" name="email" placeholder="ব্যবহারকারী" value="{{ old('email') }}" required autocomplete="email" autofocus/>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group otp-hidden">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix @error('password') is-invalid @enderror" required autocomplete="current-password" type="password" placeholder="পাসওয়ার্ড" id="password" name="password"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-actions otp-hidden">
                    @if (Route::has('password.request'))
                    <!-- <a href="{{ route('password.request') }}" id="forget-password" style="color:inherit; margin-top:10px; display:inline-block;">পাসওয়ার্ড পুনরুদ্ধার?</a> -->
                     @endif
                            <button type="submit" id="submit" class="btn pull-right">
                                 <i class="a2i_gn_login2 "></i>        প্রবেশ
                            </button>
                </div>
                <div class="form-group otp-visable">
                    <label class="control-label visible-ie8 visible-ie9">OTP</label>
                    <div class="input-icon">
                        <i class="a2i_gn_user1"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="OTP" id="otp" name="otp"/>
                    </div>
                </div>
                <div class="form-actions otp-visable">
                    <label class="checkbox">
                        <button type="button" id="otpLoginBtn" class="btn pull-right">
                            <i class="a2i_gn_login2 otp_login_icon"></i> প্রবেশ
                        </button>
                </div>
            </form>
                         <!-- END LOGIN FORM -->
        </div>

        <style>
            #submit{
                background-color: #8dc542;
            }
            #submit:hover{
                background-color: #682F91;
                color: #fff;
            }
            .msgBox{display: none}
            .otp-visable{display: none;}
        </style>        

    </div>

    <!-- END LOGIN -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
   
    <script src="{{ asset('/login_assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('/login_assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/admin/pages/scripts/login.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/login_assets/admin/pages/scripts/login-soft.js') }}" type="text/javascript"></script>
    
    
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
