<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{ translate('Order id')}}: {{ $order->code }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@php
    $status = $order->orderDetails->first()->delivery_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        <ul class="process-steps clearfix">
            <li @if($status == 'pending') class="active" @else class="done" @endif>
                <div class="icon">1</div>
                <div class="title">{{ translate('Order placed')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done" @endif>
                <div class="icon">2</div>
                <div class="title">{{ translate('On review')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done" @endif>
                <div class="icon">3</div>
                <div class="title">{{ translate('On delivery')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                <div class="icon">4</div>
                <div class="title">{{ translate('Delivered')}}</div>
            </li>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left">{{ translate('Order Summary')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Customer')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Shipping address')}}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}, {{ json_decode($order->shipping_address)->country }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Order date')}}:</td>
                            <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Order status')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Total order amount')}}:</td>
                            <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Shipping method')}}:</td>
                            <td>{{ translate('Flat shipping rate')}}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{ translate('Order Details')}}</div>
                <div class="card-body pb-0">
                    <table class="details-table table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="30%">{{ translate('Product')}}</th>
                                <th>{{ translate('Variation')}}</th>
                                <th>{{ translate('Quantity')}}</th>
                                <th>{{ translate('Delivery Type')}}</th>
                                <th>{{ translate('Price')}}</th>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                    <th>{{ translate('Refund')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a>
                                        @else
                                            <strong>{{  translate('Product Unavailable') }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $orderDetail->variation }}
                                    </td>
                                    <td>
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>
                                        @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            {{  translate('Home Delivery') }}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->name }} ({{  translate('Pickip Point') }})
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ single_price($orderDetail->price) }}</td>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        @php
                                            $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        @endphp
                                        <td>
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered')
                                                <a href="{{route('refund_request_send_page', $orderDetail->id)}}" class="btn btn-styled btn-sm btn-base-1">{{  translate('Send') }}</a>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <span class="strong-600">{{  translate('Pending') }}</span>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <span class="strong-600">{{  translate('Approved') }}</span>
                                            @elseif ($orderDetail->product->refundable != 0)
                                                <span class="strong-600">{{  translate('N/A') }}</span>
                                            @else
                                                <span class="strong-600">{{  translate('Non-refundable') }}</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{ translate('Order Ammount')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{ translate('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Shipping')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{ translate('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-base-1">{{ translate('Make Payment')}}</button>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('{{ route('checkout.make_payment') }}', {_token:'{{ csrf_token() }}', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }
</script>
