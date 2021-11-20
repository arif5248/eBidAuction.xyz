@extends('layouts.app')

@section('content')
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{translate('Classified Products')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Image')}}</th>
                    <th>{{translate('Uploaded By')}}</th>
                    <th>{{translate('Customer Status')}}</th>
                    <th>{{translate('Published')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><a href="{{ route('customer.product', $product->slug) }}" target="_blank">{{$product->name}}</a></td>
                        <td><img class="img-md" src="{{ my_asset($product->thumbnail_img) }}" alt="Logo"></td>
                        <td>{{$product->added_by}}</td>
                        <td>
                            @if ($product->status == 1)
                                <span class="badge badge-success">{{ translate('PUBLISHED') }}</span>
                            @else
                                <span class="badge badge-danger">{{ translate('UNPUBLISHED') }}</span>
                            @endif
                        </td>
                        <td>
                            <label class="switch">
                            <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('customer.product', $product->slug)}}">{{translate('Show')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('customer_products.destroy', $product->id)}}}}');">{{translate('Delete')}}</a></li>
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

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('classified_products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
