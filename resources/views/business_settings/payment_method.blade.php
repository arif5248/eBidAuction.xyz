@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Paypal Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    <input type="hidden" name="payment_method" value="paypal">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Paypal Client Id')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYPAL_CLIENT_ID" value="{{  env('PAYPAL_CLIENT_ID') }}" placeholder="{{ translate('Paypal Client ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Paypal Client Secret')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYPAL_CLIENT_SECRET" value="{{  env('PAYPAL_CLIENT_SECRET') }}" placeholder="{{ translate('Paypal Client Secret') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Paypal Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="paypal_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'paypal_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Sslcommerz Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="sslcommerz">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Sslcz Store Id')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="SSLCZ_STORE_ID" value="{{  env('SSLCZ_STORE_ID') }}" placeholder="{{translate('Sslcz Store Id')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Sslcz store password')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="SSLCZ_STORE_PASSWD" value="{{  env('SSLCZ_STORE_PASSWD') }}" placeholder="{{translate('Sslcz store password')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Sslcommerz Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="sslcommerz_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'sslcommerz_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Stripe Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="stripe">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STRIPE_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Stripe Key')}}</label>
                        </div>
                        <div class="col-lg-6">
                        <input type="text" class="form-control" name="STRIPE_KEY" value="{{  env('STRIPE_KEY') }}" placeholder="{{ translate('STRIPE KEY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STRIPE_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Stripe Secret')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="STRIPE_SECRET" value="{{  env('STRIPE_SECRET') }}" placeholder="{{ translate('STRIPE SECRET') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('RazorPay Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="razorpay">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="RAZOR_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('RAZOR KEY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="RAZOR_KEY" value="{{  env('RAZOR_KEY') }}" placeholder="{{ translate('RAZOR KEY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="RAZOR_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('RAZOR SECRET')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="RAZOR_SECRET" value="{{  env('RAZOR_SECRET') }}" placeholder="{{ translate('RAZOR SECRET') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Instamojo Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="instamojo">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="IM_API_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('API KEY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="IM_API_KEY" value="{{  env('IM_API_KEY') }}" placeholder="{{ translate('IM API KEY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="IM_AUTH_TOKEN">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('AUTH TOKEN')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="IM_AUTH_TOKEN" value="{{  env('IM_AUTH_TOKEN') }}" placeholder="{{ translate('IM AUTH TOKEN') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Instamojo Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="instamojo_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'instamojo_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('PayStack Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="paystack">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYSTACK_PUBLIC_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('PUBLIC KEY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYSTACK_PUBLIC_KEY" value="{{  env('PAYSTACK_PUBLIC_KEY') }}" placeholder="{{ translate('PUBLIC KEY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYSTACK_SECRET_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('SECRET KEY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYSTACK_SECRET_KEY" value="{{  env('PAYSTACK_SECRET_KEY') }}" placeholder="{{ translate('SECRET KEY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MERCHANT_EMAIL">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('MERCHANT EMAIL')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="MERCHANT_EMAIL" value="{{  env('MERCHANT_EMAIL') }}" placeholder="{{ translate('MERCHANT EMAIL') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('VoguePay Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="voguepay">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="VOGUE_MERCHANT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('MERCHANT ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="VOGUE_MERCHANT_ID" value="{{  env('VOGUE_MERCHANT_ID') }}" placeholder="{{ translate('MERCHANT ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="voguepay_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'voguepay_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('Payhere Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="payhere">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYHERE_MERCHANT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('PAYHERE MERCHANT ID')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYHERE_MERCHANT_ID" value="{{  env('PAYHERE_MERCHANT_ID') }}" placeholder="{{ translate('PAYHERE MERCHANT ID') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYHERE_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('PAYHERE SECRET')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYHERE_SECRET" value="{{  env('PAYHERE_SECRET') }}" placeholder="{{ translate('PAYHERE SECRET') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYHERE_CURRENCY">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('PAYHERE CURRENCY')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="PAYHERE_CURRENCY" value="{{  env('PAYHERE_CURRENCY') }}" placeholder="{{ translate('PAYHERE CURRENCY') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Payhere Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="switch">
                                <input value="1" name="payhere_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'payhere_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
