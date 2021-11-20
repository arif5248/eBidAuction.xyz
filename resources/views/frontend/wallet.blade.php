@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content"> 
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('My Wallet')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('wallet.index') }}">{{ translate('My Wallet')}}</a></li>
                                        </ul>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget text-white mt-4 c-pointer">
                                    <i class="fa fa-dollar"></i>
                                    <span class="d-block title heading-3 strong-400">{{ single_price(Auth::user()->balance) }}</span>
                                    <span class="d-block sub-title">{{  translate('Wallet Balance') }}</span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_wallet_modal()">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{  translate('Recharge From SSL') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_bkash_wallet_modal()">
                                    <i class="la la-plus"></i>
                                    <span class="d-block title heading-6 strong-400 c-base-1">{{  translate('Recharge From Bkash') }}</span>
                                </div>
                            </div>

                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                <div class="col-md-4">
                                    <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" onclick="show_make_wallet_recharge_modal()">
                                        <i class="la la-plus"></i>
                                        <span class="d-block title heading-6 strong-400 c-base-1">{{  translate('Offline Recharge Wallet') }}</span>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{ translate('Wallet recharge history')}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{  translate('Date') }}</th>
                                            <th>{{ translate('Amount')}}</th>
                                            <th>{{ translate('Payment Method')}}</th>
                                            <th>{{ translate('Approval')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($wallets) > 0)
                                            @foreach ($wallets as $key => $wallet)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                                    <td>{{ single_price($wallet->amount) }}</td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}</td>
                                                    <td>
                                                        @if ($wallet->offline_payment)
                                                            @if ($wallet->approval)
                                                                {{  translate('Approved') }}
                                                            @else
                                                                {{  translate('Pending') }}
                                                            @endif
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{  translate('No history found.') }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $wallets->links() }}
                            </ul>
                        </div>
                        <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{ translate('Bkash recharge history')}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{  translate('Date') }}</th>
                                            <th>{{ translate('Amount')}}</th>
                                            <th>{{ translate('Number')}}</th>
                                            <th>{{ translate('Transaction Id')}}</th>
                                            <th>{{ translate('Status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($bkashlist) > 0)
                                            @foreach ($bkashlist as $key => $bkash)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($bkash->date)) }}</td>
                                                    <td>{{ $bkash->amount }}</td>
                                                    <td>{{ $bkash->number }}</td>
                                                    <td>{{ $bkash->tnx_id }}</td>
                                                    <td>
                                                        @if ($bkash->status == 'pending')
                                                            {{  translate('Pending') }}
                                                        @elseif ($bkash->status == 'approved')
                                                            {{ translate('Approved') }}
                                                        @elseif ($bkash->status == 'rejected')
                                                            {{ translate('Rejected') }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination-wrapper py-4">  
                            <ul class="pagination justify-content-end">
                                {{ $bkashlist->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Recharge From SSL')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('wallet.recharge') }}" method="post">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Amount')}} <span class="required-star">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" class="form-control mb-3" name="amount" placeholder="{{ translate('Amount')}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Payment Method')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="payment_option">
                                        @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                            <option value="paypal">{{ translate('Paypal')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                            <option value="stripe">{{ translate('Stripe')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                            <option value="sslcommerz">{{ translate('SSLCommerz')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                            <option value="instamojo">{{ translate('Instamojo')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                            <option value="paystack">{{ translate('Paystack')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                            <option value="voguepay">{{ translate('VoguePay')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
                                            <option value="payhere">{{ translate('Payhere')}}</option>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                            <option value="razorpay">{{ translate('Razorpay')}}</option>
                                        @endif
                                        @if (\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                            <option value="paytm">{{ translate('Paytm')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1">{{ translate('Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bkash_wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5"><?php echo e(translate('Recharge From Bkash')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('bkash.wallet_store', Auth::user()->id) }}" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo e(translate('Amount')); ?> <span class="required-star">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" class="form-control mb-3" name="amount" placeholder="<?php echo e(translate('Amount')); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo e(translate('Number')); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input type="number" class="form-control mb-3" name="number" placeholder="<?php echo e(translate('Mobile Number')); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label><?php echo e(translate('TNX ID')); ?></label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" name="tnx_id" placeholder="<?php echo e(translate('Transaction Id')); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1"><?php echo e(translate('Confirm')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="offline_wallet_recharge_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Offline Recharge Wallet')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="offline_wallet_recharge_modal_body"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }

        function show_make_wallet_recharge_modal(){
            $.post('{{ route('offline_wallet_recharge_modal') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#offline_wallet_recharge_modal_body').html(data);
                $('#offline_wallet_recharge_modal').modal('show');
            });
        }

        function show_bkash_wallet_modal(){
            $('#bkash_wallet_modal').modal('show');
        }
    </script>
@endsection
