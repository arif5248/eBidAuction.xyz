<div class="modal-body p-4 added-to-cart">
    @if($auth)
    <div class="text-center text-danger">
        <i class="fas fa-times-circle" style="font-size:50px;"></i>
        <h3>{{ $message }}</h3>
        
    </div>
    @elseif($empty_balance)
    <div class="text-center text-danger">
        <i class="fas fa-times-circle" style="font-size:50px;"></i>
        <h3>{{ $message }}</h3>     
    </div>
    @endif
    @if($data)
    <div class="product-box">
        <div class="block">
            <div class="block-image">
                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" class="lazyload" alt="Product Image">
            </div>
            <div class="block-body">
                <h6 class="strong-600">
                    {{ __($product->name) }}
                </h6>
                <div class="row align-items-center no-gutters mt-2 mb-2">
                    <div class="col-sm-6">
                        <div>{{ translate('Bidding Price')}}:</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="heading-6 text-danger">
                            <strong>
                                {{ single_price($data['price']) }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-styled btn-base-1 btn-outline mb-3 mb-sm-0" data-dismiss="modal">{{ translate('Back to shopping')}}</button>
        <a href="{{ route('cart') }}" class="btn btn-styled btn-base-1 mb-3 mb-sm-0">{{ translate('My Bid List')}}</a>
    </div>
    @endif
</div>
