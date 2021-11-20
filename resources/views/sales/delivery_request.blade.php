@extends('layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Orders')}}</h3>

        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type Order code & hit Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('Order Code') }}</th>
                    <th>{{ translate('Num. of Products') }}</th>
                    <th>{{ translate('Customer') }}</th>
                    <th>{{ translate('Amount') }}</th>
                    <th>{{ translate('Delivery Status') }}</th>
                    <th>{{ translate('Payment Status') }}</th>
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <th>{{ translate('Refund') }}</th>
                    @endif
                    <th width="10%">{{translate('options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                       <td>
                            {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                        </td>
                        <td>
                            <a href="#{{ $order->code }}" onclick="show_admin_order_details({{ $order->id }})">{{ $order->code }}</a>
                        </td>
                        <td>
                            @php 
                            $request_orders_count = \App\OrderDetail::where('order_id', $order->id)->count();
                            @endphp

                            {{$request_orders_count}}
                        </td>
                        <td>
                            @php
                            $shipping_address = json_decode($order->shipping_address);
                            @endphp
                            @if ($shipping_address != null)
                                {{ $shipping_address->name }}
                            @else
                                Guest ({{ $order->guest_id }})
                            @endif
                        </td>
                        <td>
                            {{ single_price($order->grand_total) }}
                        </td>
                        <td>
                            @if($order->delivery_status == "on_delivery")
                                On Delivery
                            @endif
                        </td>
                        <td>
                            <span class="badge badge--2 mr-4">
                                @if ($order->payment_status == 'paid')
                                    <i class="bg-green"></i> {{ translate('Paid') }}
                                @else
                                    <i class="bg-red"></i> {{ translate('Unpaid') }}
                                @endif
                            </span>
                        </td>
                         @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                            <td>
                                @if (count($order->refund_requests) > 0)
                                    {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                @else
                                    {{ translate('No Refund') }}
                                @endif
                            </td>
                        @endif
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('sales.show', encrypt($order->id))}}">{{translate('View')}}</a></li>
                                    <li><a href="{{ route('customer.invoice.download', $order->id) }}">{{translate('Customer Invoice')}}</a></li>
                                    <li><a href="{{ route('seller.invoice.download', $order->id) }}">{{translate('Seller Invoice')}}</a></li>
                                    <li><a href="{{ route('admin.invoice.download', $order->id) }}">{{translate('Admin Invoice')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');">{{translate('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <div id="order-details-modal-body">

            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
        function show_admin_order_details(order_id)
        {
            $('#order-details-modal-body').html(null);

            if(!$('#modal-size').hasClass('modal-lg')){
                $('#modal-size').addClass('modal-lg');
            }

            $.post('http://localhost/app/admin/orders/details', {_token : '{{ @csrf_token() }}', order_id : order_id}, function(data){                
                $('#order-details-modal-body').html(data);
                $('#order_details').modal();
                $('.c-preloader').hide();
            });
        }
    </script>
       <script>
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>
@endsection
