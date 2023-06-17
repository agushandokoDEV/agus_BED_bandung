<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/pro/css/atlantis.min.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn" style="padding-bottom: 0;">
			<h3 class="text-center">Sign In To Admin</h3>
			<div id="msg-form"></div>
			<form class="login-form" id="login-form" method="post" action="/admin/authenticate">
				@csrf

				<div class="form-group">
					<label for="username" class="placeholder"><b>Username</b></label>
					<input id="username" name="username" type="text" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password" class="placeholder"><b>Password</b></label>
					<!-- <a href="#" class="link float-right">Forget Password ?</a> -->
					<div class="position-relative">
						<input id="password" name="password" type="password" class="form-control" required>
						<div class="show-password">
							<i class="icon-eye"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-action-d-flex mb-3">
					<div class="custom-control custom-checkbox">
						<!--
						<input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
						-->
					</div>
					<button id="btn-submit" type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Masuk</button>
				</div>
				{{-- <div class="login-account">


					<span class="msg">Don't have an account yet ?</span>
					<a href="#" id="show-signup" class="link">Sign Up</a>

				</div> --}}
			</form>
		</div>
	</div>
	<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/js/core/popper.min.js"></script>
	<script src="/assets/js/core/bootstrap.min.js"></script>
	<script src="/assets/js/atlantis.min.js"></script>
	<script src="/assets/js/plugin/ajaxform/dist/jquery.form.min.js"></script>

	<script type="text/javascript">
        $(document).ready(function(){
            $('#login-form').ajaxForm({
                beforeSend: function() {
                    $('#btn-submit')
                      .attr('disabled','true')
                      .text('Loading...');
                },
                success: function(res) {
                	$('#btn-submit')
                    .removeAttr('disabled')
                    .text('Masuk');
                	window.location.href='/admin'
                    // if(res.success){
                    //     var uri='/home'
                    //     // if(res.data.role_id === '58e6f1e2-d875-4d73-b8d4-67e997214194'){
                    //     //     uri='ambilbahan'
                    //     // }
                    //     window.location.href=uri
                    // }

                },
                error:function(err){
                    $('#btn-submit')
                    .removeAttr('disabled')
                    .text('Masuk');
                    $('#msg-form').html('<div class="alert alert-danger">'+err.responseJSON.message+'</div>')
                }
        	});
        });
    </script>
</body>

</html>
