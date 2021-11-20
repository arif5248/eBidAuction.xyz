@extends('layouts.app')

@section('content')

    <div class="pad-all text-center">
        <form class="" action="{{ route('seller_report.index') }}" method="GET">
            <div class="box-inline mar-btm pad-rgt">
                 {{ translate('Sort by verificarion status') }}:
                 <div class="select">
                     <select class="demo-select2" name="verification_status" required>
                        <option value="1">{{ translate('Approved') }}</option>
                        <option value="0">{{ translate('Non Approved') }}</option>
                     </select>
                 </div>
            </div>
            <button class="btn btn-default" type="submit">{{ translate('Filter') }}</button>
        </form>
    </div>


    <div class="col-md-offset-2 col-md-8">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{ translate('Seller report') }}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>{{ translate('Seller Name') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Shop Name') }}</th>
                                <th>{{ translate('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellers as $key => $seller)
                                @if($seller->user != null)
                                    <tr>
                                        <td>{{ $seller->user->name }}</td>
                                        <td>{{ $seller->user->email }}</td>
                                        <td>{{ $seller->user->shop->name }}</td>
                                        <td>
                                            @if ($seller->verification_status == 1)
                                                <div class="label label-table label-success">
                                                    {{translate('Verified')}}
                                                </div>
                                            @elseif ($seller->verification_info != null)
                                                <a href="{{ route('sellers.show_verification_request', $seller->id) }}">
                                                    <div class="label label-table label-info">
                                                        {{translate('Requested')}}
                                                    </div>
                                                </a>
                                            @else
                                                <div class="label label-table label-danger">
                                                    {{translate('Not Verified')}}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
