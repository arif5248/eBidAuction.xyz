<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="col-lg-6">
            <div class="product-gal sticky-top d-flex flex-row-reverse">
                @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                <div class="product-gal-img">
                    <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload"
                    src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                    data-src="{{ my_asset(json_decode($product->photos)[0]) }}"
                    xoriginal="{{ my_asset(json_decode($product->photos)[0]) }}"/>
                </div>
                <div class="product-gal-thumb">
                    <div class="xzoom-thumbs">
                        @foreach (json_decode($product->photos) as $key => $photo)
                        <a href="{{ my_asset($photo) }}">
                            <img src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                            class="xzoom-gallery lazyload"
                            src="{{ my_asset('frontend/images/placeholder.jpg') }}" width="80"
                            data-src="{{ my_asset($photo) }}"
                            @if($key == 0) xpreview="{{ my_asset($photo) }}" @endif>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                {{ __($product->name) }}
                </h2>
                @if(home_price($product->id) != home_discounted_price($product->id))
                <div class="row no-gutters mt-4">
                    <div class="col-2">
                        <div class="product-description-label">{{ translate('Price')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price-old">
                            <del>
                            {{ home_price($product->id) }}
                            @if($product->unit != null || $product->unit != '')
                            <span>/{{ $product->unit }}</span>
                            @endif
                            </del>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="product-description-label mt-1">{{ translate('Discount Price')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price">
                            <strong>
                            {{ home_discounted_price($product->id) }}
                            </strong>
                            @if($product->unit != null || $product->unit != '')
                            <span class="piece">/{{ $product->unit }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="product-description-label">{{ translate('Price')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price">
                            <strong>
                            {{ home_discounted_price($product->id) }}
                            </strong>
                            @if($product->unit != null || $product->unit != '')
                            <span class="piece">/{{ $product->unit }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $product->earn_point > 0)
                <div class="row no-gutters mt-4">
                    <div class="col-4">
                        <div class="product-description-label">{{  translate('Club Point') }}:</div>
                    </div>
                    <div class="col-8">
                        <div class="d-inline-block club-point bg-soft-base-1 border-light-base-1 border">
                            <span class="strong-700">{{ $product->earn_point }}</span>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="product-description-label">{{ translate('Max Bidding')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price">
                            <strong>
                            ৳{!! number_format((float)($max_bidding), 3) !!}
                            </strong>
                        </div>
                    </div>
                </div>
                <hr>
                @php
                $qty = 0;
                if($product->variant_product){
                foreach ($product->stocks as $key => $stock) {
                $qty += $stock->qty;
                }
                }
                else{
                $qty = $product->current_stock;
                }
                @endphp
                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                        <div class="col-2">
                            <div class="product-description-label">{{ translate('Total Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price">
                                </strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row no-gutters pb-3" id="custom_price">
                        <div class="col-2">
                            <div class="product-description-label">{{ translate('Bidding Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price">
                                <input type="number" step="0.1" name="bidding_price">
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters pb-3" id="custom_price">
                        <div class="col-2">
                            <div class="product-description-label">{{ translate('Description')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price">
                                <textarea name="description"></textarea>
                                </strong>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="d-table width-100 mt-3">
                    <div class="d-table-cell">
                        <!-- Add to cart button -->
                        @if ($product->digital == 1)
                        <button type="button"
                        class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart"
                        onclick="addToCart()">
                        <i class="la la-shopping-cart"></i>
                        <span class="d-none d-md-inline-block"> {{ translate('Bid Now')}}</span>
                        </button>
                        @elseif($qty > 0)
                        <button type="button"
                        class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart"
                        onclick="addToCart()">
                        <i class="la la-shopping-cart"></i>
                        <span class="d-none d-md-inline-block"> {{ translate('Bid Now')}}</span>
                        </button>
                        @else
                        <button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" disabled>
                        <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
cartQuantityInitialize();
$('#option-choice-form input').on('change', function () {
getVariantPrice();
});
</script>