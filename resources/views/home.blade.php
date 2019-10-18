<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Jet B2B</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('public/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('public/js/ie-emulation-modes-warning.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Navigation -->
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.html">Jet B2B</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Pricing</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#" id="sign-in" role="button" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#" role="button" data-toggle="modal" data-target="#signup-modal">Signup</a>
                    </li>
                    <li>
                        <a class="page-scroll free-trail" href="#contact">30 days free trail</a>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

    <!--Login Modal-->
    <div class="modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="div-forms">

                    <!-- Begin Login Form -->
                    <form id="login-form" method="POST" action="{{URL('/login')}}">

                        <div class="modal-body">

                            <div id="div-login-msg">
                                <span id="text-login-msg">Login to JetB2B</span>
                            </div>
                            <hr>

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            @if ( session('check_your_email_for_confirmation_message') )
                                <div class="alert alert-success">
                                    <span>{{ session('check_your_email_for_confirmation_message') }}</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif

                            @if(session('email_verification_message'))
                                @if(session('email_verification_message') == "error")
                                    <div class="alert alert-danger">
                                        <span>Sorry your email cannot be identified.</span>
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        <span>{{ session('email_verification_message') }}</span>
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    </div>
                                @endif
                            @endif

                            @if(session('invalid_email_or_password'))
                                <div class="alert alert-danger">
                                    <span>Invalid Email or Password !</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif

                            @if(session('user_not_verified_message'))
                                <div class="alert alert-danger">
                                    <span>Your account is not verified. Check your email to verify your account !</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif

                            <label class="log-lable">Email address</label>
                            <input id="login_username" class="form-control" type="email" name="email" required>
                            <label id="login_username-error" class="form-validation-error" for="login_username"></label>
                            @if($errors->has('email') && session('login_form_validation'))
                                <div class="form-validation-error">
                                    @foreach($errors->get('email') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif

                            <label id="user-pass" class="log-lable">Password</label>
                            <input id="login_password" class="form-control" type="password" name="password" required>
                            <label id="login_password-error" class="form-validation-error" for="login_password"></label>
                            @if($errors->has('password') && session('login_form_validation'))
                                <div class="form-validation-error">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            <div class="checkbox">
                                <label>
                                    <input  type="checkbox" name="radio"> <span id="remember" class="label-text">Keep me logged in</span>
                                </label>
                                <a href="javascript:void(0)" id="login_lost_btn" type="button" class="btn-lost">Forgot your password?</a>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn-login btn-block">Login</button>
                            </div>
                            <div>
                                <button id="login_register_btn" type="button" class="btn btn-link">Not yet signed up? Sign up <span id="register" data-toggle="modal" data-dismiss="modal" class="here-link">here</span></button>
                            </div>
                        </div>
                    </form>
                    <!-- End # Login Form -->

                    <!-- Begin Lost Password Form -->
                    <form id="lost-form" style="display:none;" method="POST" action="{{URL('/forgot_password')}}">

                        <div class="modal-body">

                            <div id="div-login-msg">
                                <span id="text-login-msg">JetB2B</span>
                            </div>
                            <hr>

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            @if ( session('check_your_email_for_reset_password_message') )
                                <div class="alert alert-success">
                                    <span>{{ session('check_your_email_for_reset_password_message') }}</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif

                            @if(session('invalid_email'))
                                <div class="alert alert-danger">
                                    <span>This is not a valid email address!</span>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif

                            <label class="log-lable">Enter Your Email address</label>
                            <input id="email" class="form-control" type="email" name="email" required>
                            <label id="email-error" class="form-validation-error" for="email"></label>
                            @if($errors->has('email') && session('lost_form_validation'))
                                <div class="form-validation-error">
                                    @foreach($errors->get('email') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn-login btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- End # Lost Password Form -->

                </div>
            </div>
        </div>
    </div>


    <!--Signup Modal-->
    <div class="modal" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="signup-modal-content">
                <div id="div-forms">

                    <!-- Begin Signup Form -->
                    <form id="signup-form" method="POST" action="{{URL('/register')}}">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                        <div class="modal-body">
                            <div id="div-login-msg">
                                <span id="text-login-msg">Signup JetB2B</span>
                            </div>
                            <hr>

                            <label class="signup-lable">First & last name</label>
                            <input id="signup_username" class="form-control" type="text" name="name" required>
                            <label id="signup_username-error" class="form-validation-error" for="signup_username"></label>
                            @if($errors->has('name') && session('registration_form_validation'))
                                <div class="form-validation-error">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif

                            <label class="signup-lable">Email address</label>
                            <input id="signup_email" class="form-control" type="email" name="email" required>
                            <label id="signup_email-error" class="form-validation-error" for="signup_email"></label>
                            @if($errors->has('email')  && session('registration_form_validation'))
                                <div class="form-validation-error">
                                    @foreach($errors->get('email') as $message)
                                        {{ $message }}
                                    @endforeach
                                </div>
                            @endif

                            <label class="signup-lable">Password</label>
                            <input id="signup_password" class="form-control" type="password" name="password" required>
                            <label id="signup_password-error" class="form-validation-error" for="signup_password"></label>
                            @if($errors->has('password') && session('registration_form_validation'))
                                <div class="form-validation-error">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                            <label class="signup-lable">Confirm Password</label>
                            <input id="login_password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                            <label id="login_password_confirmation-error" class="form-validation-error" for="login_password_confirmation"></label>

                            <div class="checkbox">
                                <label class="signup-lable">
                                    <input type="checkbox" name="radio"> <span class="label-text"> Keep me posted on JetB2B</span>
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="signup-lable">
                                    <input type="checkbox" name="radio"> <span class="label-text" > By signing up, I agree to JetB2B’s Terms & Conditions</span>
                                </label>
                            </div>
                        </div>

                        <div class="signup-modal-footer">
                            <button type="submit" class="btn-signup btn-block">Sign Up</button>
                            <button id="login_register_btn" type="button" class="signed_up">Already signed up?Log in <span id="login" data-toggle="modal" data-dismiss="modal" class="here-link">here</span></button>
                        </div>

                    </form>
                    <!-- End | Signup Form -->

                </div>
            </div>
        </div>
    </div>

</header>
<!-- Header -->
<div class="banner-container">
    <div class="container">
        <div class="slider-container">
            <div class="intro-text">
                <div class="row">
                    <div class="col-lg-12 intro-heading">Discover best local businesses near you</div>
                </div>
                <div class="row">
                    <div class="col-lg-12 intro-lead-in">Going Out? Find places on the go.</div>
                </div>
                <!-- Search  -->
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 search-fields">

                        <form class="form">
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn categories btn-md dropdown-toggle" data-toggle="dropdown">
                                    <span id="search_concept"><img src="{{ asset('public/images/cat-icon.png') }}"> Categories <i class="fa fa-chevron-down"></i></span>  <span></span>
                                </button>
                                <ul class="dropdown-menu cat-dropdown" role="menu" id="cat">
                                    <li><a href="javascript:void(0)"> <span class="fa fa-building pink"></span> Building & Construction</a></li>
                                    <li><a href="javascript:void(0)"> <span class="fa fa-pie-chart pink"></span> Business Services</a></li>
                                    <li><a href="javascript:void(0)"> <span class="fa fa-television pink"></span> Computer & Internet</a></li>
                                    <li><a href="javascript:void(0)"><span class="fa fa-book pink"></span> Entertainment & Lifestyle </a></li>
                                    <li><a href="javascript:void(0)"> <span class="fa fa-line-chart pink"></span> Financial & Legal</a></li>
                                    <li><a href="javascript:void(0)"> <span class="fa fa-cutlery pink"></span> Food & Drink</a></li>

                                    <li><a href="javascript:void(0)"> <span class="fa fa-medkit pink"></span> Health & Beauty</a></li>
                                    <li><a href="javascript:void(0)"> <span class="fa fa-industry pink"></span>  Industry</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-5 col-md-5 col-lg-5 search-fields">

                        <form class="form">
                            <div class="input-group">
                                <input class="form-control search-input" type="text" placeholder="Type a business name..." aria-label="Search" id="mysearch">

                            </div>

                        </form>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-2 search-fields">
                        <form class="form">
                            <div class="input-group">
                                <input class="form-control search-input location-input" type="text" placeholder='&nbsp; Location' aria-label="Search" id="mysearch">
                                <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 20px; background-color: transparent; border:none;">
                                    <button class="btn-location" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="header-bottom">
                    <div class="row">
                        <div class="col-md-12 intro-lead-in">TOP SEARCHES IN</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="search-in">
                            <div class="search-cat"><a href="javascript:void(0)" class="page-scroll btn btn-xl"><i class="fa fa-tag" aria-hidden="true"></i>  Building & Construction</a></div>
                            <div class="search-cat"><a href="javascript:void(0)" class="page-scroll btn btn-xl"><i class="fa fa-tag" aria-hidden="true"></i>  Business Services</a></div>
                            <div class="search-cat"><a href="javascript:void(0)" class="page-scroll btn btn-xl"><i class="fa fa-tag" aria-hidden="true"></i> Industry </a></div>
                            <div class="search-cat"><a href="javascript:void(0)" class="page-scroll btn btn-xl"><i class="fa fa-tag" aria-hidden="true"></i> Travel & Tourism</a></div>
                            <div class="search-cat"><a href="javascript:void(0)" class="page-scroll btn btn-xl"><i class="fa fa-tag" aria-hidden="true"></i>  Transport & Automotive</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="about" class="light-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 colmd-10 col-lg-10 text-center mx-auto about">
                <div class="section-title">
                    <h2 class="pink">How it works?</h2>
                    <p>Sed efficitur ligula ex, in commodo ipsum sagittis in. Ut gravida placerat sollicitudin. Aenean sed viverra nulla, vitae viverra ipsum. </p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- about module -->
            <div class="col-md-3 text-center">
                <div class="mz-module-about">
                    <img src="{{ asset('public/images/work1.png') }}">
                    <h3>Find best Business you want</h3>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet nisl lacus. Curabitur pulvinar nec justo ac posuere. Fusce sollicitudin eget eros vel elementum.</p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3 text-center">
                <div class="mz-module-about">
                    <img src="{{ asset('public/images/work2.png') }}">
                    <h3>add your business on list</h3>
                    <hr>
                    <p>Praesent lacinia, dolor a placerat feugiat, libero nibh gravida leo, at ultrices neque purus non risus. Aliquam gravida, odio non aliquet pretium.</p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3 text-center">
                <div class="mz-module-about">
                    <img src="{{ asset('public/images/work3.png') }}">
                    <h3>verify to your business</h3>
                    <hr>
                    <p>Sed tristique, ante nec porttitor gravida, sem diam semper leo, pharetra pellentesque nisi neque in neque. Vivamus vel convallis ipsum, ac dapibus turpis. </p>
                </div>
            </div>
            <!-- end about module -->
            <!-- about module -->
            <div class="col-md-3 text-center">
                <div class="mz-module-about">
                    <img src="{{ asset('public/images/work4.png') }}">
                    <h3>Get first 30 Days free Trail</h3>
                    <hr>
                    <p> Morbi ac ullamcorper erat, at luctus neque. Mauris dictum vitae nibh ac suscipit. Suspendisse orci lorem, volutpat fermentum vehicula sit amet, vehicula eget dui.</p>
                </div>
            </div>
            <!-- end about module -->
        </div>
    </div>
    <!-- /.container -->
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2 class="pink">Testimonials</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="testimonial-slider" class="owl-carousel">
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">Gloria Mill</h3>
                            <center>
                                <p>CEO of Gracia Construction</p>
                            </center>
                        </div>

                    </div>

                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">John Doe</h3>
                            <center>
                                <p>Founder Dr. Horton</p>
                            </center>
                        </div>

                    </div>

                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">Bradley Haugh</h3>
                            <center>
                                <p>JR Construction Llc</p>
                            </center>
                        </div>

                    </div>

                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">Gloria Mill</h3>
                            <center>
                                <p>CEO of Gracia Construction</p>
                            </center>
                        </div>

                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">Gloria Mill</h3>
                            <center>
                                <p>CEO of Gracia Construction</p>
                            </center>

                        </div>

                    </div>
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <center><i class="fa fa-quote-left"></i></center>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent bibendum dolor sit amet eros imperdiet, sit amet hendrerit nisi vehicula.
                            </p>
                            <hr>
                            <h3 class="testimonial-author pink">Gloria Mill</h3>
                            <center>
                                <p>CEO of Gracia Construction</p>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="overlay-dark short-section">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12 mb-sm-30">
                <div class="counter-item">
                    <h2 data-count="59">Start a 30 Days Free Trail Today!</h2>
                    <h6>Morbi ac ullamcorper erat, at luctus neque. </h6>
                    <a class="page-scroll free-trail-button" href="#contact">Free Trail</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4 footer-menu">
                <li class="footer-links"><a href="javascript:void(0)">Help</a></li>
                <li class="footer-links"><a href="javascript:void(0)">Terms of Service</a></li>
                <li class="footer-links"><a href="javascript:void(0)">Privacy Policy</a></li>
            </div>
            <div class="col-md-4 copyright">
                <li class="footer-links"><a href="javascript:void(0)">Copyright 2018 Jet B2B</a></li>
                <li class="footer-links"><a href="http://codingpixel.com/">Developed by Codingpixel</a></li>
            </div>
            <div class="col-md-4 social-icons">
                <a class="social-links" href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="social-links" href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a class="social-links" href="javascript:void(0)"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a class="social-links" href="javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>

        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/js/cbpAnimatedHeader.js') }}"></script>
<script src="{{ asset('public/js/theme-scripts.js') }}"></script>
<script src="{{ asset('public/js/ie10-viewport-bug-workaround.js') }}"></script>

@if ( session('login_form_validation') || session('email_verification_message') || session('check_your_email_for_confirmation_message') )
    <script>
        $(document).ready(function(){
            $('#login-modal').modal('show');
        });
    </script>
@endif

@if ( session('lost_form_validation') || session('check_your_email_for_reset_password_message') )
    <script>
        $(document).ready(function(){
            $('#login-modal').modal('show');
            $('#login-form').hide();
            $('#lost-form').show();
        });
    </script>
@endif

@if ( session('registration_form_validation') )
    <script>
        $(document).ready(function(){
            $('#signup-modal').modal('show');
        });
    </script>
@endif

<script>
    $(document).ready(function(){
        $("#testimonial-slider").owlCarousel({
            items:3,
            itemsDesktop:[1500,3],
            itemsDesktopSmall:[980,2],
            itemsTablet:[768,2],
            itemsMobile:[650,1],
            pagination:true,
            navigation:false,
            slideSpeed:2000,
            autoPlay:true
        });
    });
</script>
<script>
    $(".btn-lost").click(function(){
        $('#login-form').hide();
        $('#lost-form').show();
    });

    $("#login").click(function(){
        $('#login-modal').modal('show');
    });

    $("#register").click(function(){
        $('#signup-modal').modal('show');
    });

</script>

<script>
    $(document).ready(function () {
        $("#signup-form").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{URL('check_if_email_already_exist')}}",
                        type: "post",
                        data: {
                            _token: function () {
                                return "{{csrf_token()}}"
                            }
                        }
                    }
                },
                password: "required",
                password_confirmation: {
                    required: true,
                    equalTo: "#signup_password"
                }
            },
            messages: {
                name: "Please enter your name",
                email: {
                    required: "Please enter your email",
                    email: "This is not valid format",
                    remote: "Email already exist"
                },
                password: "Please enter your password",
                password_confirmation: {
                    required: "Please enter your password",
                    equalTo: "Password does not match"
                }
            },
        });

        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: "required"
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "This is not valid format"
                },
                password: "Please enter your password"
            },
        });

        $("#lost-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "This is not valid format"
                }
            }
        });
    });

</script>

</body>

</html>