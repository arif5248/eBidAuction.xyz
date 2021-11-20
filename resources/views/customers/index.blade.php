@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <!-- <a href="{{ route('sellers.create')}}" class="btn btn-info pull-right">{{translate('add_new')}}</a> -->
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Customers')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_customers" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
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
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Email Address')}}</th>
                    <th>{{translate('Phone')}}</th>
                    <th>{{translate('Package')}}</th>
                    <th>{{translate('Wallet Balance')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                    @if ($customer->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($customers->currentPage() - 1)*$customers->perPage() }}</td>
                            <td>@if($customer->user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$customer->user->name}}</td>
                            <td>{{$customer->user->email}}</td>
                            <td>{{$customer->user->phone}}</td>
                            <td>
                                @if ($customer->user->customer_package != null)
                                    {{$customer->user->customer_package->name}}
                                @endif
                            </td>
                            <td>{{single_price($customer->user->balance)}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('customers.login', encrypt($customer->id))}}">{{translate('Log in as this Customer')}}</a></li>
                                        @if($customer->user->banned != 1)
                                        <li><a href="#" onclick="confirm_ban('{{route('customers.ban', $customer->id)}}');">{{translate('Ban this Customer')}}  <i class="fa fa-ban text-danger" aria-hidden="true"></i> </a></li>
                                        @else
                                        <li><a href="#" onclick="confirm_unban('{{route('customers.ban', $customer->id)}}');">{{translate('Unban this Customer')}} <i class="fa fa-check text-success" aria-hidden="true"></i></a></li>
                                        @endif
                                        
                                        <li><a onclick="confirm_modal('{{route('customers.destroy', $customer->id)}}');">{{translate('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $customers->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_customers(el){
            $('#sort_customers').submit();
        }
        function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }
    </script>
@endsection
@section('modal')
    <div class="modal fade" id="confirm-ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{translate('Confirmation')}}</h4>
                </div>

                <div class="modal-body">
                    <p>{{translate('Do you really want to ban this Customer?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmation" class="btn btn-danger btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="confirm-unban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">{{translate('Confirmation')}}</h4>
                </div>

                <div class="modal-body">
                    <p>{{translate('Do you really want to unban this Customer?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmationunban" class="btn btn-success btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
