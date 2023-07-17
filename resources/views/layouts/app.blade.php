
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset ('css/bootstrap.min.css') }}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{ asset ('css/slick.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ asset ('css/slick-theme.css') }}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{ asset ('css/nouislider.min.css') }}"/>

		<!-- Font Awesome Icon --> 
		<link rel="stylesheet" href="{{ asset ('css/font-awesome.min.css') }}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset ('css/style.css') }}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
		<![endif]-->

    </head>
	<body>
		
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    @if (Route::has('login'))
                        @if (Route::has('login'))
                            @auth
                            @else
                                <li class="menu-item">
                                    <a href="{{ route('login') }}"><i class="fa fa-user-o"></i>Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="menu-item">
                                        <a href="{{ route('register') }}"><i class="fa fa-user-o"></i>{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
        
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <img src="{{ Auth::user()->avatar }}" alt=""
                                    style="border: 1px solid #cccccc border-radius: 5px; width: 39px; height: auto; float: left; margin-right: 7px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
        
                                <button href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </button>
        
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    @endif
                </ul>
            </div>
        </div>

        <main>
            @yield('content')
        </main>

		<!-- jQuery Plugins -->
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/slick.min.js') }}"></script>
		<script src="{{ asset('js/nouislider.min.js') }}"></script>
		<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>

	</body>
</html>
