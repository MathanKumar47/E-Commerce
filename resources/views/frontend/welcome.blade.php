@extends('frontend.master')
@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- shop -->
                @foreach ($categories as $category)
                    <div class="col-sm-3">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="{{ asset('category/' . $category->image) }}" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>{{ $category->name }}<br>Collection</h3>
                                <a href="{{ url('/product_by_cat' . $category->id) }}" class="cta-btn">Shop now <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                    <li class=""><a
                                            href="{{ url('/product_by_cat' . $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row ">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach ($products as $product)
                                        @php
                                            $product['image'] = explode('|', $product->image);
                                            $images = $product->image[0];
                                        @endphp
                                        <div class="product product_data">
                                            <div class="product-img"><a href="{{ url('/view-details' . $product->id) }}">
                                                    <img src="{{ asset('image/' . $images) }}"
                                                        style="width: 100%; height: 100%;">
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category"><a
                                                        href="{{ url('/view-details' . $product->id) }}">{{ $product->category->name }}</a>
                                                </p>
                                                <h3 class="product-name"><a
                                                        href="{{ url('/view-details' . $product->id) }}">{{ $product->name }}</a>
                                                </h3>
                                                <h4 class="product-price"><a
                                                        href="{{ url('/view-details' . $product->id) }}">&#8377;{{ $product->price }}<del
                                                            class="product-old-price">&#8377;{{ $product->price }}</del></a>
                                                </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                        <input type="hidden" class="product_id" value="{{ $product->id }}">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                                class="tooltipp">add wishlist</span></button>
                                                    {{-- <button class="quick-view" data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-eye"></i><span class="tooltipp">quick view</span>
                                                    </button> --}}
                                                    <button class="quick-view" data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-eye"></i><span class="tooltipp">quick view</span>
                                                    </button>                                                
                                                </div>
                                                <!-- Quick View Modal -->
                                                {{-- <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="quickViewModalLabel">Product Quick View</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" id="quickViewContent">
                                                                @include('frontend.quick_view')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="add-to-cart">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <a href="{{ url('/view-details' . $product->id) }}"
                                                    class="add-to-cart-btn">View Detail</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /product -->
                                </div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
                <div class="modal fade py-5" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="quickViewModalLabel">Product Quick View</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="quickViewContent">
                                @include('frontend.quick_view')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row product_data">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top Selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                    <li class=""><a
                                            href="{{ url('/product_by_cat' . $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach ($topProducts as $topProduct)
                                        @php
                                            $topProduct['image'] = explode('|', $topProduct->image);
                                            $images = $topProduct->image[0];
                                        @endphp
                                        <div class="product  product_data">
                                            <div class="product-img"><a
                                                    href="{{ url('/view-details' . $topProduct->id) }}">
                                                    <img src="{{ asset('image/' . $images) }}"
                                                        style="width: 100%; height: 100%;">
                                                </a>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category"><a
                                                        href="{{ url('/view-details' . $topProduct->id) }}">{{ $topProduct->category->name }}</a>
                                                </p>
                                                <h3 class="product-name"><a
                                                        href="{{ url('/view-details' . $topProduct->id) }}">{{ $topProduct->name }}</a>
                                                </h3>
                                                <h4 class="product-price"><a
                                                        href="{{ url('/view-details' . $topProduct->id) }}">&#8377;{{ $topProduct->price }}<del
                                                            class="product-old-price">&#8377;{{ $topProduct->price }}</del></a>
                                                </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                        <input type="hidden" class="product_id" value="{{ $topProduct->id }}">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                                class="tooltipp">add wishlist</span></button>
                                                    <button class="quick-view" data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-eye"></i><span class="tooltipp">quick view</span>
                                                    </button> 
                                                </div>
                                                <!-- Quick View Modal -->
                                                {{-- <div class="modal fade" id="quickViewModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" style="background-color: rgba(0, 0, 0, .5); z-index: 999999999999;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Quick View</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" id="quickViewContent">
                                                                @include('frontend.quick_view')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="add-to-cart">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="id" value="{{ $topProduct->id }}">
                                                <a href="{{ url('/view-details' . $product->id) }}"
                                                    class="add-to-cart-btn">View Detail</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /product -->
                                </div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
                <div class="modal fade py-5" id="quickViewModal" tabindex="-1" role="dialog" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="quickViewModalLabel">Product Quick View</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="quickViewContent">
                                @include('frontend.quick_view')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
