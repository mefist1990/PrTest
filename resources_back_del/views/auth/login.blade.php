<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<!-- start: HEAD -->
	<head>
		<title>TalentsFinder - Раскроем таланты каждого</title>
		<!-- start: META -->
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: GOOGLE FONTS -->
		<link href="admin-panel/http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<!-- end: GOOGLE FONTS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="admin-panel/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="admin-panel/vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="admin-panel/vendor/themify-icons/themify-icons.min.css">
		<link href="admin-panel/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="admin-panel/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="admin-panel/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<!-- end: MAIN CSS -->
		<!-- start: CLIP-TWO CSS -->
		<link rel="stylesheet" href="admin-panel/assets/css/styles.css">
		<link rel="stylesheet" href="admin-panel/assets/css/plugins.css">
		<link rel="stylesheet" href="admin-panel/assets/css/themes/theme-1.css" id="skin_color" />
		<!-- end: CLIP-TWO CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login">
		<!-- start: LOGIN -->
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">

				<!-- start: LOGIN BOX -->
				<div class="box-login">
					<form class="form-login" method="POST" action="{{ route('login') }}">
						 {{ csrf_field() }}
						<fieldset>
							<legend>
								Войдите в свой аккаунт
							</legend>
							<p>
								Пожалуйста, введите свой адрес электронной почты и пароль для входа в систему.
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

									@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                	@endif

									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" required>

									@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                	@endif


									<i class="fa fa-lock"></i>
									<a class="forgot" href="{{ route('password.request') }}">
										Я забыл свой пароль
									</a> </span>
							</div>
							<div class="form-actions">
								<div class="checkbox clip-check check-primary">

									<label for="remember">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                                    </label>

								</div>
								<button type="submit" class="btn btn-primary pull-right">
									Авторизоваться <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
								У вас еще нет учетной записи?
								<a href="admin-panel/login_registration.html">
									Завести аккаунт
								</a>
							</div>
						</fieldset>
					</form>

				</div>
				<!-- end: LOGIN BOX -->
			</div>
		</div>
		<!-- end: LOGIN -->
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="admin-panel/vendor/jquery/jquery.min.js"></script>
		<script src="admin-panel/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="admin-panel/vendor/modernizr/modernizr.js"></script>
		<script src="admin-panel/vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="admin-panel/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="admin-panel/vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="admin-panel/vendor/jquery-validation/jquery.validate.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="admin-panel/assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="admin-panel/assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
	<!-- end: BODY -->
</html>