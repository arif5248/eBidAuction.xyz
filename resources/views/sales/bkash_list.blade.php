@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Orders')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('User ID') }}</th>
                    <th>{{ translate('Date') }}</th>
                    <th>{{ translate('Amount') }}</th>
                    <th>{{ translate('Number') }}</th>
                    <th>{{ translate('Transaction Id') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bkashlist as $key => $bkash)
                    <tr>
                        <td>
                            {{ ($key+1) }}
                        </td>
                        <td>
                            {{ $bkash->user_id }}
                        </td>
                        <td>
                            {{ date('d-m-Y', strtotime($bkash->date)) }}
                        </td>
                        <td>
                            {{ $bkash->amount }}
                        </td>
                        <td>
                            {{ $bkash->number }}
                        </td>
                        <td>
                            {{ $bkash->tnx_id }}
                        </td>
                        <td>
                            {{ $bkash->status }}
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('sales.bkash.approved', $bkash->tnx_id)}}">{{translate('Approved')}}</a></li>
                                    <li><a href="{{ route('sales.bkash.rejected', $bkash->tnx_id) }}">{{translate('Rejected')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrapper py-4">
    <ul class="pagination justify-content-end">
        {{ $bkashlist->links() }}
    </ul>
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
    </script>
@endsection
