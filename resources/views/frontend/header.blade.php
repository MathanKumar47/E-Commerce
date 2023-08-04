    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +91-9988776655</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> nammakadai@email.com</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="bi bi-currency-rupee"></i>INR</a></li>
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
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{ url('/search') }}" method="GET">
                            <select class="input-select" name='category'>
                                <option value="ALL" {{ request('category') == 'ALL' ? 'selected' : '' }}>All
                                    Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input class="input" name="product" placeholder="Search here"
                                value="{{ request('product') }}">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">{{ Auth::user()->wishlist->count() }}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @foreach(Auth::user()->wishlist as $item)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{ asset('image/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="product-body">
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <h6><a href="{{ url('/product_by_cat'.$item->product->category->id) }}">{{ $item->product->category->name }}</a></h6>
                                            <h6><a href="{{ url('/product-by-subcat'.$item->product->subcategory->id) }}">{{ $item->product->subcategory->name }}</a></h4>
                                            <h3 class="product-name"><a href="{{ url('/view-details'. $item->product->id) }}">{{ $item->product->name }}</a></h3>
                                        </div>
                                        <form method="post" action="{{ route('wishlist.remove') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <button type="submit" class="delete"><i class="fa fa-close"></i></button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /Wishlist -->
                        <!-- Cart -->
                        @if (Route::has('login'))
                            @php
                                $cart_array = cartArray();
                            @endphp
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty"><?= count($cart_array) ?></div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @foreach ($cart_array as $v_add_cart)
                                            @php
                                                $images = $v_add_cart['attributes'][0];
                                                $images = explode('|', $images);
                                                $images = $images[0];
                                            @endphp
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="{{ asset('image/' . $images) }}" alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a
                                                            href="#">{{ $v_add_cart['name'] }}</a></h3>
                                                    <h4 class="product-price"><span
                                                            class="qty">{{ $v_add_cart['quantity'] }}x</span>&#8377;{{ $v_add_cart['price'] }}
                                                    </h4>
                                                </div>
                                                <form method="post"
                                                    action="{{ url('/delete-cart/' . $v_add_cart['id']) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="cart-summary">
                                        <small><?= count($cart_array) ?> Item(s) selected</small>
                                        <h5>SUBTOTAL:&#8377; {{ Cart::getTotal() }}</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="{{ url('/checkout') }}">Checkout <i
                                                class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
