@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('sellers.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Seller')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading bord-btm clearfix pad-all h-100">
            <h3 class="panel-title pull-left pad-no">{{translate('Sellers list')}}</h3>
            <div class="pull-right clearfix">
                <form class="" id="sort_sellers" action="" method="GET">
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 300px;">
                            <select class="form-control demo-select2" name="approved_status" id="approved_status" onchange="sort_sellers()">
                                <option value="">{{translate('Filter by Approval')}}</option>
                                <option value="1"  @isset($approved) @if($approved == 'paid') selected @endif @endisset>{{translate('Approved')}}</option>
                                <option value="0"  @isset($approved) @if($approved == 'unpaid') selected @endif @endisset>{{translate('Non-Approved')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name or email & Enter') }}">
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
                    <th>{{translate('Phone')}}</th>
                    <th>{{translate('Email Address')}}</th>
                    <th>{{translate('Verification Info')}}</th>
                    <th>{{translate('Approval')}}</th>
                    <th>{{ translate('Num. of Products') }}</th>
                    <th>{{ translate('Due to seller') }}</th>
                    <th>{{ translate('Comission') }}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $key => $seller)
                    @if($seller->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($sellers->currentPage() - 1)*$sellers->perPage() }}</td>
                            <td>@if($seller->user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$seller->user->name}}</td>
                            <td>{{$seller->user->phone}}</td>
                            <td>{{$seller->user->email}}</td>
                            <td>
                                @if ($seller->verification_info != null)
                                    <a href="{{ route('sellers.show_verification_request', $seller->id) }}">
                                        <div class="label label-table label-info">
                                            {{translate('Show')}}
                                        </div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <label class="switch">
                                    <input onchange="update_approved(this)" value="{{ $seller->id }}" type="checkbox" <?php if($seller->verification_status == 1) echo "checked";?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>{{ \App\Product::where('user_id', $seller->user->id)->count() }}</td>
                            <td>
                                @if ($seller->admin_to_pay >= 0)
                                    {{ single_price($seller->admin_to_pay) }}
                                @else
                                    {{ single_price(abs($seller->admin_to_pay)) }} (Due to Admin)
                                @endif
                            </td>
                            <td>{{$seller->user->commission}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a onclick="show_seller_profile('{{$seller->id}}');">{{translate('Profile')}}</a></li>
                                        <li><a href="{{route('sellers.login', encrypt($seller->id))}}">{{translate('Log in as this Seller')}}</a></li>
                                        <li><a onclick="show_seller_payment_modal('{{$seller->id}}');">{{translate('Pay Now')}}</a></li>
                                        <li><a href="{{route('sellers.payment_history', encrypt($seller->id))}}">{{translate('Payment History')}}</a></li>
                                        <li><a href="{{route('sellers.edit', encrypt($seller->id))}}">{{translate('Edit')}}</a></li>
                                        @if($seller->user->banned != 1)
                                        <li><a href="#" onclick="confirm_ban('{{route('sellers.ban', $seller->id)}}');">{{translate('Ban this seller')}}  <i class="fa fa-ban text-danger" aria-hidden="true"></i> </a></li>
                                        @else
                                        <li><a href="#" onclick="confirm_unban('{{route('sellers.ban', $seller->id)}}');">{{translate('Unban this seller')}} <i class="fa fa-check text-success" aria-hidden="true"></i></a></li>
                                        @endif
                                        <li><a data-toggle="modal" data-target="#exampleModal{{$seller->user->id}}">{{translate('Set Commission')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('sellers.destroy', $seller->id)}}');">{{translate('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                            <!--Set Commission Modal -->
                            <div class="modal fade" id="exampleModal{{$seller->user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form class="form-group" id="commission-form" action="{{route('seller.set.commission')}}" method="post">
                                        @csrf
                                  <div class="modal-body">
                                    
                                        <label>Set Commission</label>
                                        <input class="form-control" type="number" name="commission" id="commission"/>
                                        <input type="hidden" name="seller_id" value="{{$seller->user->id}}">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                                </div>
                                </form>
                              </div>
                            </div>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="pull-right">
                    {{ $sellers->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>






@endsection

@section('script')
    <script type="text/javascript">
        function show_seller_payment_modal(id){
            $.post('{{ route('sellers.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id){
            $.post('{{ route('sellers.profile_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#profile_modal #modal-content').html(data);
                $('#profile_modal').modal('show', {backdrop: 'static'});
            });
        }

        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('sellers.approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Approved sellers updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_sellers(el){
            $('#sort_sellers').submit();
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
                    <p>{{translate('Do you really want to ban this seller?')}}</p>
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
                    <p>{{translate('Do you really want to unban this seller?')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{translate('Cancel')}}</button>
                    <a id="confirmationunban" class="btn btn-success btn-ok">{{translate('Proceed!')}}</a>
                </div>
            </div>
        </div>
    </div>
    

@endsection