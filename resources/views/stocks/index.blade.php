@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('stocks.create')}}" class="btn btn-danger pull-right">{{translate('Destroy')}}</a>
        <a href="{{ route('stocks.create')}}" class="btn btn-info pull-right" style="margin-right: 10px;">{{translate('Create Stock')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{translate('Product Stocks')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Product Name')}}</th>
                    <th>{{translate('Entry Type')}}</th>
                    <th>{{translate('Quantity')}}</th>
                    <th>{{translate('Note')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($subcategories as $key => $subcategory)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{__($subcategory->name)}}</td>
                        <td>{{$subcategory->category->name}}</td>
                        <td><img loading="lazy"  class="img-md" src="{{ my_asset($subcategory->banner) }}" alt="Banner"></td>
                        <td>
                            <a href="{{route('subcategories.edit', $subcategory->id)}}" class="btn btn-mint btn-icon"><i class="demo-psi-pen-5 icon-lg"></i></a>
                            <a onclick="confirm_modal('{{route('subcategories.destroy', $subcategory->id)}}');" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>

    </div>
</div>

@endsection
