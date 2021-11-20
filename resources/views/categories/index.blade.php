@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('categories.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Category')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Categories')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_categories" action="" method="GET">
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
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Banner')}}</th>
                    <th>{{translate('Icon')}}</th>
                    <th>{{translate('Featured')}}</th>
                    <th>{{translate('Commission')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                        <td>{{__($category->name)}}</td>
                        <td><img loading="lazy"  class="img-md" src="{{ my_asset($category->banner) }}" alt="{{translate('banner')}}"></td>
                        <td><img loading="lazy"  class="img-xs" src="{{ my_asset($category->icon) }}" alt="{{translate('icon')}}"></td>
                        <td><label class="switch">
                            <input onchange="update_featured(this)" value="{{ $category->id }}" type="checkbox" <?php if($category->featured == 1) echo "checked";?> >
                            <span class="slider round"></span></label></td>
                        <td>{{ $category->commision_rate }} %</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('categories.edit', encrypt($category->id))}}">{{translate('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('categories.destroy', $category->id)}}');">{{translate('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $categories->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured categories updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
