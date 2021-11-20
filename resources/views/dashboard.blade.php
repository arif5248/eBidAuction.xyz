@extends('layouts.app')

@section('content')
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-danger pad-all text-center mar-btm">
                <h4 class="text-light mar-btm">{{translate('Please Configure SMTP Setting to work all email sending funtionality')}}.</h4>
                <a class="btn btn-info btn-rounded" href="{{ route('smtp_settings.index') }}">Configure Now</a>
            </div>
        </div>
    </div>
@endif
@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('PRODUCTS')}}</div>
                </div>
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-lg text-main">{{translate('Total published products')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->get()->count() }}</span></p>
                @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                    <p class="text-lg text-main">{{translate('Total sellers products')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->where('added_by', 'seller')->get()->count() }}</span></p>
                @endif
                <p class="text-lg text-main">{{translate('Total admin products')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->where('added_by', 'admin')->get()->count() }}</span></p>
                <br>
                <a href="{{ route('products.admin') }}" class="btn btn-primary mar-top">{{ translate('Manage Products') }} <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Category::all()->count() }}</p>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Category')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubSubCategory::all()->count() }}</p>
                        <a href="{{ route('subsubcategories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Sub Sub Category')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubCategory::all()->count() }}</p>
                        <a href="{{ route('subcategories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Sub Category')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product brand')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Brand::all()->count() }}</p>
                        <a href="{{ route('brands.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Brand')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if((Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('SELLERS')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::all()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total approved sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 1)->get()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total pending sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 0)->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
    <div class="row">
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Category wise product sale')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Category Name')}}</th>
                                <th>{{translate('Sale')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Category::all() as $key => $category)
                                <tr>
                                    <td>{{ __($category->name) }}</td>
                                    <td>{{ \App\Product::where('category_id', $category->id)->sum('num_of_sale') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Category wise product stock')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Category Name')}}</th>
                                <th>{{translate('Stock')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Category::all() as $key => $category)
                                @php
                                    $products = \App\Product::where('category_id', $category->id)->get();
                                    $qty = 0;
                                    foreach ($products as $key => $product) {
                                        if ($product->variant_product) {
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        }
                                        else {
                                            $qty = $product->current_stock;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>{{ __($category->name) }}</td>
                                    <td>{{ $qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions)))
    <div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget pad-no">
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-3x text-main bg-primary pad-ver">{{translate('Frontend')}} <strong>{{translate('Setting')}}</strong></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Home page')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{ route('home_settings.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Policy page')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{route('privacypolicy.index', 'privacy_policy')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('General')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{route('generalsettings.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Useful link')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{route('links.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->user_type == 'admin' || in_array('8', json_decode(Auth::user()->staff->role->permissions)))
    <div class="flex-row">
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Activation')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{route('activation.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('SMTP')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('smtp_settings.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Payment method')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('payment_method.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Social media')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('social_login.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-12 flex-col-12">
        <div class="panel">
            <div class="panel-body text-center dash-widget bg-primary">
                <br>
                <br>
                <i class="demo-pli-gear icon-5x"></i>
                <br>
                <br>
                <br>
                <br>
                <p class="text-semibold text-2x text-light mar-ver">
                    {{translate('Business')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Currency')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{route('currency.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no ">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller verification')}} <br>
                    {{translate('form setting')}}
                </p>
                <br>
                <a href="{{route('seller_verification_form.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Language')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{route('languages.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Click Here')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller commission')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('business_settings.vendor_commission') }}" class="btn btn-primary mar-top btn-block">{{translate('Click Here')}}</a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
