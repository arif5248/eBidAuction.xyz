@extends('layouts.app')

@section('content')

@if($type != 'Seller')
    <div class="row">
        <div class="col-lg-12 pull-right">
            <a href="{{ route('products.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Product')}}</a>
        </div>
    </div>
@endif

<br>

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ translate($type.' Products') }}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_products" action="" method="GET">
                @if($type == 'Seller')
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="user_id" name="user_id" onchange="sort_products()">
                                <option value="">All Sellers</option>
                                @foreach (App\Seller::all() as $key => $seller)
                                    @if ($seller->user != null && $seller->user->shop != null)
                                        <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name ?? '' }} ({{ $seller->user->name ?? '' }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 200px;">
                        <select class="form-control demo-select2" name="type" id="type" onchange="sort_products()">
                            <option value="">Sort by</option>
                            <option value="rating,desc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{translate('Rating (High > Low)')}}</option>
                            <option value="rating,asc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{translate('Rating (Low > High)')}}</option>
                            <option value="num_of_sale,desc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{translate('Num of Sale (High > Low)')}}</option>
                            <option value="num_of_sale,asc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{translate('Num of Sale (Low > High)')}}</option>
                            <option value="unit_price,desc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{translate('Base Price (High > Low)')}}</option>
                            <option value="unit_price,asc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{translate('Base Price (Low > High)')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
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
                    <th width="20%">{{translate('Name')}}</th>
                    @if($type == 'Seller')
                        <th>{{translate('Seller Name')}}</th>
                    @endif
                    <th>{{translate('Num of Sale')}}</th>
                    <th>{{translate('Total Stock')}}</th>
                    <th>{{translate('Base Price')}}</th>
                    <th>{{translate('Todays Deal')}}</th>
                    <th>{{translate('Rating')}}</th>
                    <th>{{translate('Published')}}</th>
                    <th>{{translate('Featured')}}</th>
                    <th>{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <a href="{{ route('product', $product->slug) }}" target="_blank" class="media-block">
                                <div class="media-left">
                                    <img loading="lazy"  class="img-md" src="{{ my_asset($product->thumbnail_img)}}" alt="Image">
                                </div>
                                <div class="media-body">{{ __($product->name ?? '') }}</div>
                            </a>
                        </td>
                        @if($type == 'Seller')
                            <td>{{ $product->user->name ?? ''}}</td>
                        @endif
                        <td>{{ $product->num_of_sale }} {{translate('times')}}</td>
                        <td>
                            @php
                                $qty = 0;
                                if($product->variant_product){
                                    foreach ($product->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                }
                                else{
                                    $qty = $product->current_stock;
                                }
                                echo $qty;
                            @endphp
                        </td>
                        <td>{{ number_format($product->unit_price,2) }}</td>
                        <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->todays_deal == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        <td>{{ $product->rating }}</td>
                        <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        <td><label class="switch">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->featured == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if ($type == 'Seller')
                                        <li><a href="{{route('products.seller.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @else
                                        <li><a href="{{route('products.admin.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @endif
                                    <li><a onclick="confirm_modal('{{route('products.destroy', $product->id)}}');">{{translate('Delete')}}</a></li>
                                    <li><a href="{{route('products.duplicate', $product->id)}}">{{translate('Duplicate')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }

    </script>
@endsection
