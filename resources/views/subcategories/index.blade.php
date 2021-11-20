@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('subcategories.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Subcategory')}}</a>
    </div>
</div>
  
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Sub-Categories')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_subcategories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
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
                    <th>{{translate('Subcategory')}}</th>
                    <th>{{translate('Category')}}</th>
                    <th>{{translate('Banner')}}</th>
                    <th>{{translate('Icon')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategories as $key => $subcategory)
                    @if ($subcategory->category != null)
                        <tr>
                            <td>{{ ($key+1) + ($subcategories->currentPage() - 1)*$subcategories->perPage() }}</td>
                            <td>{{__($subcategory->name)}}</td>
                            <td>{{$subcategory->category->name}}</td>
                            <td><img loading="lazy"  class="img-md" src="{{ my_asset($subcategory->banner) }}" alt="{{translate('banner')}}"></td>
                            <td><img loading="lazy"  class="img-xs" src="{{ my_asset($subcategory->icon) }}" alt="{{translate('icon')}}"></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('subcategories.edit', encrypt($subcategory->id))}}">{{translate('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('subcategories.destroy', $subcategory->id)}}');">{{translate('Delete')}}</a></li>
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
                {{ $subcategories->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
