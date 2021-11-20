@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('coupon.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Coupon')}}</a>
        </div>
    </div><br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Coupon Information')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Code')}}</th>
                        <th>{{translate('Type')}}</th>
                        <th>{{translate('Start Date')}}</th>
                        <th>{{translate('End Date')}}</th>
                        <th width="10%">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>@if ($coupon->type == 'cart_base')
                                    {{ translate('Cart Base') }}
                                @elseif ($coupon->type == 'product_base')
                                    {{ translate('Product Base') }}
                            @endif</td>
                            <td>{{ date('d-m-Y', $coupon->start_date) }}</td>
                            <td>{{ date('d-m-Y', $coupon->end_date) }}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('coupon.edit', encrypt($coupon->id))}}">{{translate('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('coupon.destroy', $coupon->id)}}');">{{translate('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
