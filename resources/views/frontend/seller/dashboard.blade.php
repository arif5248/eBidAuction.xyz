@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{ translate('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-upload"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\Product::where('user_id', Auth::user()->id)->get()) }}</span>
                                        <span class="d-block sub-title">{{ translate('Products')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-cart-plus"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</span>
                                        <span class="d-block sub-title">{{ translate('Total sale')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center blue-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-dollar"></i>
                                        @php
                                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orderDetails as $key => $orderDetail) {
                                                if($orderDetail->order->payment_status == 'paid'){
                                                    $total += $orderDetail->price;
                                                }
                                            }
                                        @endphp
                                        <span class="d-block title heading-3 strong-400">{{ single_price($total) }}</span>
                                        <span class="d-block sub-title">{{ translate('Total earnings')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-check-square-o"></i>
                                        <span class="d-block title heading-3 strong-400">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</span>
                                        <span class="d-block sub-title">{{ translate('Successful orders')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 text-center">
                                        {{ translate('Orders')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <table class="table mb-0 table-bordered" style="font-size:14px;">
                                            <tr>
                                                <td>{{ translate('Total orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{ translate('Pending orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{ translate('Cancelled orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</strong></td>
                                            </tr>
                                            <tr >
                                                <td>{{ translate('Successful orders')}}:</td>
                                                <td><strong class="heading-6">{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="bg-white mt-4 p-5 text-center">
                                    <div class="mb-3">
                                        @if(Auth::user()->seller->verification_status == 0)
                                            <img loading="lazy"  src="{{ my_asset('frontend/images/icons/non_verified.png') }}" alt="" width="130">
                                        @else
                                            <img loading="lazy"  src="{{ my_asset('frontend/images/icons/verified.png') }}" alt="" width="130">
                                        @endif
                                    </div>
                                    @if(Auth::user()->seller->verification_status == 0)
                                        <a href="{{ route('shop.verify') }}" class="btn btn-styled btn-base-1">{{ translate('Verify Now')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 text-center">
                                        {{ translate('Products')}}
                                    </div>
                                    <div class="form-box-content p-3 category-widget">
                                        <ul class="clearfix">
                                            @foreach (\App\Category::all() as $key => $category)
                                                @if(count($category->products->where('user_id', Auth::user()->id))>0)
                                                    <li><a>{{  __($category->name) }}<span>({{ count($category->products->where('user_id', Auth::user()->id)) }})</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="text-center">
                                            <a href="{{ route('seller.products.upload')}}" class="btn pt-3 pb-1">{{ translate('Add New Product')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2 clearfix ">
                                            {{ translate('Purchased Package')}}
                                        </div>
                                        @php
                                            $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                                        @endphp
                                        <div class="form-box-content p-3">
                                            @if($seller_package != null)
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><img alt="Package Logo" src="{{ my_asset($seller_package->logo) }}" style="height:100px; width:90px;"></center>
                                                    <br>
                                                    <strong><p>{{ translate('Product Upload Remaining')}}: {{ Auth::user()->seller->remaining_uploads }} {{ translate('Times')}}</p></strong>
                                                    <strong><p>{{ translate('Digital Product Upload Remaining')}}: {{ Auth::user()->seller->remaining_digital_uploads }} {{ translate('Times')}}</p></strong>
                                                    <strong><p>{{ translate('Package Expires at')}}: {{ Auth::user()->seller->invalid_at }}</p></strong>
                                                    <strong><p><div class="name mb-0">{{ translate('Current Package')}}: {{ $seller_package->name }} <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span></div></p></strong>
                                                </div>
                                            @else
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><strong><p>{{ translate('Package Not Found')}}</p></strong></center>
                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ route('seller_packages_list') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{ translate('Upgrade Package')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="bg-white mt-4 p-4 text-center">
                                    <div class="heading-4 strong-700">{{ translate('Shop')}}</div>
                                    <p>{{ translate('Manage & organize your shop')}}</p>
                                    <a href="{{ route('shops.index') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{ translate('Go to setting')}}</a>
                                </div>
                                <div class="bg-white mt-4 p-4 text-center">
                                    <div class="heading-4 strong-700">{{ translate('Payment')}}</div>
                                    <p>{{ translate('Configure your payment method')}}</p>
                                    <a href="{{ route('profile') }}" class="btn btn-styled btn-base-1 btn-outline btn-sm">{{ translate('Configure Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
