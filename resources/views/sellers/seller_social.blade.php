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
                    <th>{{ translate('Shop Name') }}</th>
                    <th>{{ translate('Facebook') }}</th>
                    <th>{{ translate('Youtube') }}</th>
                    <th>{{ translate('twitter') }}</th>
                    <th>{{ translate('Google') }}</th>
                    <th width="10%">{{translate('options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allSocialLinks as $key => $links)
                    <tr>
                         <td>
                            {{ ($key+1) + ($allSocialLinks->currentPage() - 1)*$allSocialLinks->perPage() }}
                        </td>
                        <td>
                            @php 
                            $shop_name = \App\Shop::where('id',$links->shop_id)->first();
                            @endphp
                            {{$shop_name->name}}
                        </td>
                        <td>
                            {{$links->facebook}}
                        </td>
                        <td>
                            {{$links->youtube}}
                        </td>
                        <td>
                            {{$links->twitter}}
                        </td>
                        <td>
                            {{$links->google}}
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('seller.links.approve', $links->id)}}">{{translate('Approve')}}</a></li>
                                    <li><a href="{{ route('seller.links.remove', $links->id) }}">{{translate('Remove')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $allSocialLinks->appends(request()->input())->links() }}
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
