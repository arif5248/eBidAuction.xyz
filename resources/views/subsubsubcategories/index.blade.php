@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('subsubsubcategories.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Sub Subcategory')}}</a>
    </div>
</div>
  
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Sub-Sub-Sub-categories')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_subsubcategories" action="" method="GET">
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
                    <th>{{translate('Sub Sub Subcategory')}}</th>
                    <th>{{translate('Sub Subcategory')}}</th>
                    <th>{{translate('Subcategory')}}</th>
                    <th>{{translate('category')}}</th>
                    <th>{{translate('banner')}}</th>
                    <th>{{translate('icon')}}</th>
                    {{-- <th>{{translate('Attributes')}}</th> --}}
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($subsubsubcategories as $key => $subsubsubcategory)
                  @if ($subsubsubcategory->subsubcategory != null && $subsubsubcategory->subsubcategory->subcategory != null)
                  <tr>
                      <td>{{ ($key+1) + ($subsubsubcategories->currentPage() - 1)*$subsubsubcategories->perPage() }}</td>
                      <td>{{__($subsubsubcategory->name)}}</td>
                      <td>{{$subsubsubcategory->subsubcategory->name}}</td>
                      <td>{{$subsubsubcategory->subsubcategory->subcategory->name}}</td>
                      <td>{{$subsubsubcategory->subsubcategory->subcategory->category->name}}</td>
                      <td><img loading="lazy"  class="img-md" src="{{ my_asset($subsubsubcategory->banner) }}" alt="{{translate('banner')}}"></td>
                      <td><img loading="lazy"  class="img-xs" src="{{ my_asset($subsubsubcategory->icon) }}" alt="{{translate('icon')}}"></td>
                      <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                {{translate('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('subsubsubcategories.edit', encrypt($subsubsubcategory->id))}}">{{translate('Edit')}}</a></li>
                                <li><a onclick="confirm_modal('{{route('subsubsubcategories.destroy', $subsubsubcategory->id)}}');">{{translate('Delete')}}</a></li>
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
               {{ $subsubsubcategories->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

