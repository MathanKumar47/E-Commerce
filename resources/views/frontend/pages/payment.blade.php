@extends('frontend.master')
@section('content')
    <!-- Order Details -->
    <div class="col-md-4"></div>
    <div class="col-md-4 order-details" style="margin-top: 100px; margin-bottom: 100px;">
        <form method="POST" action="{{ route('order.place') }}">
            @csrf
            <div class="section-title text-center">
                <h3 class="title">Your Order</h3>
            </div>
            <div class="order-summary">
                <div class="order-col">
                    <div><strong>PRODUCT</strong></div>
                    <div><strong>TOTAL</strong></div>
                </div>
                @foreach ($cart_array as $cart)
                    <div class="order-products">
                        <div class="order-col">
                            <div>{{ $cart['quantity'] }} x {{ $cart['name'] }}</div>
                            <div>&#8377;{{ Cart::get($cart['id'])->getPriceSum() }}</div>
                        </div>
                    </div>
                @endforeach
                <div class="order-col">
                    <div>Shiping</div>
                    <div><strong>&#8377;50</strong></div>
                </div>
                <div class="order-col">
                    <div><strong>TOTAL</strong></div>
                    <div><strong class="order-total">&#8377;{{ Cart::getTotal() + 50 }}</strong></div>
                </div>
                <div class="section-title text-center" style="margin-top: 40px;">
                    <h4 class="title" style="color: #D10024;">Please Select A Payment Method</h4>
                </div>
            </div>
            <div class="payment-method">
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-1" value="cash">
                    <label for="payment-1">
                        <span></span>
                        Cash On Delivery
                    </label>
                    <div class="caption">
                        <p>You can also select Cash On Delivert!!</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-2" value="bkash">
                    <label for="payment-2">
                        <span></span>
                        Bkash
                    </label>
                    <div class="caption">
                        <p>Bkash No: 01308983894</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-3" value="nogod">
                    <label for="payment-3">
                        <span></span>
                        Nogod
                    </label>
                    <div class="caption">
                        <p>Nogod No: 01308983894</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-4" value="rocket">
                    <label for="payment-4">
                        <span></span>
                        Rocket
                    </label>
                    <div class="caption">
                        <p>Rocket No: 01308983894</p>
                    </div>
                </div>
            </div>
            <div class="input-checkbox">
                <input type="checkbox" id="terms">
                <label for="terms">
                    <span></span>
                    I've read and accept the <a href="#">terms & conditions</a>
                </label>
            </div>
            <button type="submit" class="primary-btn order-submit" style="float: right;">Place Order</button>
            <button id="sslczPayBtn" token="if you have any token validation" postdata=""
                order="If you already have the transaction generated for current order" endpoint="/pay-via-ajax"> Pay Now
            </button>
        </form>
    </div>
    <div class="col-md-4"></div>

    <!-- /Order Details -->
@endsection
