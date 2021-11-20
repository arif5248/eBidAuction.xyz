@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('1. My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-map-o"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('2. Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('3. Delivery info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
                                <i class="la la-credit-card"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('4. Payment')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-check-circle"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('5. Confirmation')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-3 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST" id="checkout-form">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4 py-3">
                                    <h3 class="heading heading-5 strong-500">
                                        {{ translate('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="row">
                                                @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paypal">
                                                            <input type="radio" id="" name="payment_option" value="paypal" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/paypal.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Stripe">
                                                            <input type="radio" id="" name="payment_option" value="stripe" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/stripe.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="sslcommerz">
                                                            <input type="radio" id="" name="payment_option" value="sslcommerz" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/sslcommerz.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Instamojo">
                                                            <input type="radio" id="" name="payment_option" value="instamojo" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/instamojo.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Razorpay">
                                                            <input type="radio" id="" name="payment_option" value="razorpay" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/rozarpay.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paystack">
                                                            <input type="radio" id="" name="payment_option" value="paystack" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/paystack.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="VoguePay">
                                                            <input type="radio" id="" name="payment_option" value="voguepay" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/vogue.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
                                                   <div class="col-6">
                                                       <label class="payment_option mb-4" data-toggle="tooltip" data-title="payhere">
                                                           <input type="radio" id="" name="payment_option" value="payhere" class="online_payment" checked>
                                                           <span>
                                                               <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/payhere.png')}}" class="img-fluid">
                                                           </span>
                                                       </label>
                                                   </div>
                                               @endif
                                                @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paytm">
                                                            <input type="radio" id="" name="payment_option" value="paytm" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy" src="{{ my_asset('frontend/images/icons/cards/paytm.jpg')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                                    @php
                                                        $digital = 0;
                                                        foreach(Session::get('cart') as $cartItem){
                                                            if($cartItem['digital'] == 1){
                                                                $digital = 1;
                                                            }
                                                        }
                                                    @endphp
                                                    @if($digital != 1)
                                                        <div class="col-6">
                                                            <label class="payment_option mb-4" data-toggle="tooltip" data-title="Cash on Delivery">
                                                                <input type="radio" id="" name="payment_option" value="cash_on_delivery" class="online_payment" checked>
                                                                <span>
                                                                    <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/cod.png')}}" class="img-fluid">
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if (Auth::check())
                                                    @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                                        @foreach(\App\ManualPaymentMethod::all() as $method)
                                                          <div class="col-6">
                                                              <label class="payment_option mb-4" data-toggle="tooltip" data-title="{{ $method->heading }}">
                                                                  <input type="radio" id="" name="payment_option" value="{{ $method->heading }}" onchange="toggleManualPaymentData({{ $method->id }})">
                                                                  <span>
                                                                      <img loading="lazy"  src="{{ my_asset($method->photo)}}" class="img-fluid">
                                                                  </span>
                                                              </label>
                                                          </div>
                                                        @endforeach

                                                        @foreach(\App\ManualPaymentMethod::all() as $method)
                                                          <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                              @php echo $method->description @endphp
                                                              @if ($method->bank_info != null)
                                                                  <ul>
                                                                      @foreach (json_decode($method->bank_info) as $key => $info)
                                                                          <li>Bank Name - {{ $info->bank_name }}, Account Name - {{ $info->account_name }}, Account Number - {{ $info->account_number}}, Routing Number - {{ $info->routing_number }}</li>
                                                                      @endforeach
                                                                  </ul>
                                                              @endif
                                                          </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3 bg-gray text-left p-3 d-none">
                                        <div id="manual_payment_description">

                                        </div>
                                    </div>
                                    @if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                        <div class="or or--1 mt-2">
                                            <span>or</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-lg-8 col-md-10 mx-auto">
                                                <div class="text-center bg-gray py-4">
                                                    <i class="fa"></i>
                                                    <div class="h5 mb-4">{{ translate('Your wallet balance :')}} <strong>{{ single_price(Auth::user()->balance) }}</strong></div>
                                                    @if(Auth::user()->balance < $total)
                                                        <button type="button" class="btn btn-base-2" disabled>{{ translate('Insufficient balance')}}</button>
                                                    @else
                                                        <button  type="button" onclick="use_wallet()" class="btn btn-base-1">{{ translate('Pay with wallet')}}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3">
                                <input id="agree_checkbox" type="checkbox" required>
                                <label for="agree_checkbox">{{ translate('I agree to the')}}</label>
                                <a href="{{ route('terms') }}">{{ translate('terms and conditions')}}</a>,
                                <a href="{{ route('returnpolicy') }}">{{ translate('return policy')}}</a> &
                                <a href="{{ route('privacypolicy') }}">{{ translate('privacy policy')}}</a>
                            </div>

                            <div class="row align-items-center pt-3">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{ translate('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" onclick="submitOrder(this)" class="btn btn-styled btn-base-1">{{ translate('Complete Order')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
          $(".online_payment").click(function(){
            $('#manual_payment_description').parent().addClass('d-none');
          });
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
            }
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id){
            $('#manual_payment_description').parent().removeClass('d-none');
            $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
        }
    </script>
@endsection
