






{{-- @foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
    @if ($homeCategory->category != null)
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-lg-left">
                            <span class="mr-4">{{ translate($homeCategory->category->name) }}</span>
                        </h3>
                        <ul class="inline-links float-lg-right nav mt-3 mb-2 m-lg-0">
                            <li><a href="{{ route('products.category', $homeCategory->category->slug) }}" class="active">View More</a></li>
                        </ul>
                    </div>
                    <div class="caorusel-box arrow-round gutters-5">
                        <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                        @foreach (filter_products(\App\Product::where('published', 1)->where('category_id', $homeCategory->category->id))->latest()->limit(12)->get() as $key => $product)
                            <div class="caorusel-card">
                                <div class="product-box-2 bg-white alt-box my-2">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100 text-center">
                                            <img class="img-fit lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                        </a>
                                        <div class="product-btns clearfix">
                                            <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" tabindex="0">
                                                <i class="la la-heart-o text-dark"></i>
                                            </button>
                                            <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})" tabindex="0">
                                                <i class="la la-refresh text-dark"></i>
                                            </button>
                                            <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})" tabindex="0">
                                                <i class="la la-eye text-dark"></i>
                                            </button>
                                        </div>
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
                                            <a href="{{ route('product', $product->slug) }}" class=" text-truncate">{{ __($product->name) }}</a>
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
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach --}}

@foreach (\App\HomeCategory::where('status', 1)->get() as $key => $homeCategory)
@php
$products = filter_products(\App\Product::where('published', 1)->where('category_id', $homeCategory->category->id))->latest()->limit(12)->get()->chunk(6);
// dd($products);
@endphp

<section id="productList">
    <div id="usaProduct">
        <div class="container bg-white shadow-sm">
            <div class="section-title-1 clearfix">
                <h3 class="heading-5 strong-700 mb-0 float-lg-left">
                    <span class="mr-4">{{ translate($homeCategory->category->name) }}</span>
                </h3>
                <ul class="inline-links float-lg-right nav mt-3 mb-2 m-lg-0">
                    <li><a href="{{ route('products.category', $homeCategory->category->slug) }}" class="active">View More</a></li>
                </ul>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0">
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            @foreach ($products as $productCollection)  
                            <div class="item carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row">
                                  @foreach ($productCollection as $product)
                                    <div class="col-md-2 col-sm-6">
                                        <div class="thumb-wrapper border border-rounded">
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
                                                <div class="product-btns clearfix">

                                                    <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" tabindex="0">
                                                        <i class="la la-heart-o text-dark"></i>
                                                    </button>
                                                    <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})" tabindex="0">
                                                        <i class="la la-refresh text-dark"></i>
                                                    </button>
                                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})" tabindex="0">
                                                        <i class="la la-eye text-dark"></i>
                                                    </button>

                                                </div>
                                            </div>
                                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                    {{ translate('Club Point') }}:
                                                    <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                </div>
                                             @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach    
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control left carousel-control-prev" href="#myCarousel2" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control right carousel-control-next" href="#myCarousel2" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
