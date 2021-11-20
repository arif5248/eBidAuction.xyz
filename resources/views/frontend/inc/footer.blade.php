
<!-- FOOTER -->
<footer id="footer" class="footer" style="background-color:#260F26">
    <div class="footer-top">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                @php
                    $generalsetting = \App\GeneralSetting::first();
                @endphp
                <div class="col-lg-5 col-xl-4 text-center text-md-left">
                    <div class="col">
                        <a href="{{ route('home') }}" class="d-block">  
                            @if($generalsetting->footer_logo != null)
                                <p style="font-size: 15px;">eBidAuction.xyz</p>
                            @elseif($generalsetting->logo != null)
                                <p style="font-size: 15px;">eBidAuction.xyz</p>
                            @else
                                <p style="font-size: 15px;">eBidAuction.xyz</p>
                            @endif
                            
                        </a>
                        <div class="d-inline-block d-md-block">
                            <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-base-1 btn-icon-left">
                                    {{ translate('Subscribe') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-xl-1 col-md-4">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{ translate('Contact Info') }}
                        </h4>
                        <ul class="footer-links contact-widget">
                            <li>
                               <span class="d-block opacity-5">{{ translate('Address') }}:</span>
                               <span class="d-block">{{ $generalsetting->address }}</span>
                            </li>
                            <li>
                               <span class="d-block opacity-5">{{translate('Phone')}}:</span>
                               <span class="d-block">{{ $generalsetting->phone }}</span>
                            </li>
                            <li>
                               <span class="d-block opacity-5">{{translate('Email')}}:</span>
                               <span class="d-block">
                                   <a href="mailto:{{ $generalsetting->email }}">{{ $generalsetting->email  }}</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{ translate('Useful Link') }}
                        </h4>
                        <ul class="footer-links">
                            @foreach (\App\Link::all() as $key => $link)
                                <li>
                                    <a href="{{ $link->url }}" title="">
                                        {{ $link->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="col text-center text-md-left">
                       <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                          {{ translate('My Account') }}
                       </h4>

                       <ul class="footer-links">
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}">
                                        {{ translate('Logout') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('user.login') }}">
                                        {{ translate('Login') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('purchase_history.index') }}">
                                    {{ translate('Order History') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wishlists.index') }}">
                                    {{ translate('My Wishlist') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders.track') }}">
                                    {{ translate('Track Order') }}
                                </a>
                            </li>
                            @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                                <li>
                                    <a href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                        <div class="col text-center text-md-left">
                            <div class="mt-4">
                                <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                                    {{ translate('Be a Seller') }}
                                </h4>
                                <a href="{{ route('shops.create') }}" class="btn btn-base-1 btn-icon-left">
                                    {{ translate('Apply Now') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 sct-color-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="copyright text-center text-md-left">
                        <ul class="copy-links no-margin">
                            <li>
                                © eBidAuction
                            </li>
                            <li>
                                <a href="{{ route('terms') }}">{{ translate('Terms') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('privacypolicy') }}">{{ translate('Privacy policy') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="text-center my-3 my-md-0 social-nav model-2">
                        @if ($generalsetting->facebook != null)
                            <li>
                                <a href="{{ $generalsetting->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->instagram != null)
                            <li>
                                <a href="{{ $generalsetting->instagram }}" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
                                    <i class="fab fa-instagram-square"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->twitter != null)
                            <li>
                                <a href="{{ $generalsetting->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="fab fa-twitter-square"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->youtube != null)
                            <li>
                                <a href="{{ $generalsetting->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="fab fa-youtube-square"></i>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="text-center text-md-right">
                        <ul class="inline-links">
                            @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="paypal" src="{{ my_asset('frontend/images/icons/cards/paypal.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="stripe" src="{{ my_asset('frontend/images/icons/cards/stripe.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="sslcommerz" src="{{ my_asset('frontend/images/icons/cards/sslcommerz-foo.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="instamojo" src="{{ my_asset('frontend/images/icons/cards/instamojo.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="razorpay" src="{{ my_asset('frontend/images/icons/cards/rozarpay.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="voguepay" src="{{ my_asset('frontend/images/icons/cards/voguepay.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="paystack" src="{{ my_asset('frontend/images/icons/cards/paystack.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="payhere" src="{{ my_asset('frontend/images/icons/cards/payhere.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                <li>
                                    <img loading="lazy" alt="cash on delivery" src="{{ my_asset('frontend/images/icons/cards/cod.png')}}" height="30">
                                </li>
                            @endif
                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                  <li>
                                    <img loading="lazy" alt="{{ $method->heading }}" src="{{ my_asset($method->photo)}}" height="30">
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
