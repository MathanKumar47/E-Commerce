{{-- <div class="quick-view-modal" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, .5); display: flex; justify-content: center; align-items: center; z-index: 10000; "> --}}
    <div class="product-quick-view" style="background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); z-index: 10000; display: flex; justify-content: center; align-items: center;">
        <div class="product-quick-view-image" style="margin-right: 20px;">
            @php
                $images = is_array($product->image) ? $product->image[0] : $product->image;
            @endphp
            <img src="{{ asset('image/' . $images) }}" alt="{{ $product->name }}" style="width: 50%">
        </div>
        <div class="product-quick-view-details">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Price: &#8377;{{ $product->price }}</p>
            <form action="{{ url('/add-to-cart') }}" method="POST">
                @csrf
                <div class="add-to-cart">
                    <div class="add-to-cart">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                            cart</button>
                    </div>
                </div>
            </form>

            <form action="{{ route('wishlist.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                    class="tooltipp"></span></button>
            </form>
            <!-- Add any other product details you want to display -->
        </div>
    </div>
{{-- </div> --}}