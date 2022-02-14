<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Aplikasi Kasir</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    {{-- <link rel="shortcut icon" href="favicon.ico">  --}}
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('template-admin/assets/plugins/fontawesome/js/all.min.js') }}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('template-admin/assets/css/portal.css') }}">

    {{-- mystyle --}}
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">

</head> 

<body class="app">   	
    <header class="app-header fixed-top print">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
                            </a>
                        </div>
                        
                        <div class="app-utilities col-auto">
                            <div class="app-utility-item mt-1">
                                Halo, {{ auth()->user()->nama }}!
                            </div>
                        </div>
		            </div>
	            </div>
	        </div>
        </div>
        
        @include('layouts.sidebar')

    </header>
    
    <div class="app-wrapper">
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    @yield('content')
			    
		    </div>
	    </div>
    </div>    			
    
    <!-- jQuery -->
    <script src="{{ asset('template-admin/assets/jquery/dist/jquery.min.js') }}"></script>
 
    <!-- Javascript -->          
    <script src="{{ asset('template-admin/assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('template-admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
    
    <!-- Page Specific JS -->
    <script src="{{ asset('template-admin/assets/js/app.js') }}"></script> 

    @stack('script')

</body>
</html> 

