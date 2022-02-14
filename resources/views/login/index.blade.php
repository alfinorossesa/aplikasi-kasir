<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Login | Aplikasi Kasir</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('template-admin/assets/plugins/fontawesome/js/all.min.js') }}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('template-admin/assets/css/portal.css') }}">

	{{-- mystyles --}}
	<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper login-background">
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
	    <div class="col-lg-4 col-md-4 col-sm-4 auth-main-col text-center">
		    <div class="d-flex flex-column align-content-end login-box">
			    <div class="app-auth-body mx-auto">	
					{{-- <h2 class="auth-heading text-center mb-2">Food Order Login</h2> --}}
					<h2 class="auth-heading text-center mb-5">Aplikasi Kasir Login</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action="/login" method="POST">
                            @csrf         
							<div class="email mb-3">
								<label class="sr-only" for="username">Username</label>
								<input id="username" name="username" type="text" class="form-control signin-email" placeholder="Username" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="password">Password</label>
								<input id="password" name="password" type="password" class="form-control signin-password" placeholder="Password" required>
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Login</button>
							</div>
						</form>
					</div>
			    </div>	
		    </div> 
	    </div>
		<div class="col-lg-4 col-md-4 col-sm-4"></div>
    </div>

</body>
</html> 

