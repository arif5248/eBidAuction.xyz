{{-- <section class="mb-4">
    <div class="container">
        <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-left">
                    <span class="mr-4">{{ translate('Featured Products')}}</span>
                </h3>
            </div>
            <div class="caorusel-box arrow-round gutters-5">
                <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                    <div class="caorusel-card">
                        <div class="product-card-2 card card-product shop-cards shop-tech">
                            <div class="card-body p-0">

                                <div class="card-image">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                        <img class="img-fit lazyload mx-auto" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                    </a>
                                </div>

                                <div class="p-md-3 p-2">
                                    <div class="price-box">
                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                        @endif
                                        <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                    </div>
                                    <div class="star-rating star-rating-sm mt-1">
                                        {{ renderStarRating($product->rating) }}
                                    </div>
                                    <h2 class="product-title p-0">
                                        <a href="{{ route('product', $product->slug) }}" class="text-truncate">{{ __($product->name) }}</a>
                                    </h2>

                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                            {{ translate('Club Point') }}:
                                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

@php
$products = filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get()->chunk(6);
@endphp
<section id="productList">
    <div id="usaProduct">
        <div class="container bg-white">
            <h5>{{ translate('Featured Products')}}</h5>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            @foreach ($products as $productCollection)  
                            <div class="item carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                  @foreach ($productCollection as $product)
                                    <div class="col-md-2 col-sm-6">
                                        <div class="thumb-wrapper border border-rounded shadow-sm p-1">
                                            <div class="img-box">
                                                <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                    <img class="img-fit lazyload mx-auto" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                                </a>
                                            </div>
                                            <div class="star-rating star-rating-sm mt-1">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <div class="thumb-content">
                                                <h4 style="
                                                overflow: hidden;
                                                white-space: nowrap;
                                                text-overflow: ellipsis;"> <a href="{{ route('product', $product->slug) }}" class="text-truncate text-dark">{{ __($product->name) }}</a></h4>
                                                <p class="item-price"><span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span></p>
                                                <p>
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                         <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                </p>
                                                @if(Auth::id() != $product->user_id)
                                                <a href="#" data-name="Lemon" data-price="5" class="add-to-cart btn btn-primary" onclick="showAddToCartModal({{ $product->id }})">Bid Now</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach    
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
