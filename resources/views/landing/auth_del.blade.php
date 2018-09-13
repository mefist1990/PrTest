<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!-- lightbox fancyBox -->
    <link rel="stylesheet" href="landing/components/fancyapps-fancyBox-18d1712/source/jquery.fancybox.css" type="text/css" media="screen" />
    <!-- main style -->
    <link rel="stylesheet" href="landing/css/main.min.css">
    <title>TalentsFinder</title>
</head>
<body>
<nav class="nav">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="top-line d-flex align-items-center justify-content-between">
                    <a href="#id1" class="logo">
                        <span>TalentsFinder</span>
                        <span class="sub">Раскроем таланты каждого</span>
                    </a>
                    <ul class="menu">
                        <li><a href="#id2">особенности</a></li>
                        <li><a href="#id3">результат</a></li>
                        <li><a href="#id4">заказать</a></li>
                        <li><a href="#id5">F.A.Q.</a></li>
                    </ul>
                    <div class="wr-btn-menu">
                        <a style="display: none;" href="tel:+74953244459" class="btn bg-secondary btn-size phone"><span>+7 (495) 324-44-59</span> <i class="fa fa-phone d-md-none" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-primary btn-size">Войти</a>
                        <div class="ico-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu-mobile">
        <ul class="menu-mobile-list">
            <li><a href="#id2">особенности</a></li>
            <li><a href="#id3">результат</a></li>
            <li><a href="#id4">заказать</a></li>
            <li><a href="#id5">F.A.Q.</a></li>
        </ul>
        <div class="text-center">
            <a style="display: none;" href="tel:+74953244459" class="btn btn-primary phone d-sm-none">+7 (495) 324-44-59</a>
            <a href="#" class="btn btn-primary d-sm-none">Войти</a>
        </div>
    </div>
</nav>




<section id="id2" class="section section-2">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-lg-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">
Авторизация на сайте</h3>
</div>
<div class="panel-body">
<div class="row">

<div class="col-xs-6 col-sm-6 col-md-6 login-box">
<form role="form"  method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
<div class="input-group">
<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
@endif

</div>
<div class="input-group">
<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
<input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
</div>
<p>
<a href="{{ route('password.request') }}">Забыли свой пароль?</a></p>
У вас нет аккаунта? <a href="#">Регистрация</a>
</form>
</div>
</div>
</div>
<div class="panel-footer">
<div class="row">

<div class="col-xs-6 col-sm-6 col-md-6">
<button type="button" class="btn btn-labeled btn-success">
<span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Войти</button>
<button type="button" class="btn btn-labeled btn-danger">
<span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Выход</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




</section>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- font awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<!-- lightbox fancyBox https://github.com/fancyapps/fancybox -->
<script type="text/javascript" src="landing/components/fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="landing/components/fancyapps-fancyBox-18d1712/source/jquery.fancybox.js"></script>
<!--main script-->
<script src="landing/js/main.js"></script>
</body>
</html>