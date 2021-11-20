@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Product Reviews')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_by_rating" action="{{ route('reviews.index') }}" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="rating" id="rating" onchange="filter_by_rating()">
                            <option value="">{{translate('Filter by Rating')}}</option>
                            <option value="rating,desc">{{translate('Rating (High > Low)')}}</option>
                            <option value="rating,asc">{{translate('Rating (Low > High)')}}</option>
                        </select>
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
                    <th>{{translate('Product')}}</th>
                    <th>{{translate('Product Owner')}}</th>
                    <th>{{translate('Customer')}}</th>
                    <th>{{translate('Rating')}}</th>
                    <th>{{translate('Comment')}}</th>
                    <th>{{translate('Published')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $key => $review)
                    @if ($review->product != null && $review->user != null)
                        <tr>
                            <td>{{ ($key+1) + ($reviews->currentPage() - 1)*$reviews->perPage() }}</td>
                            <td><a href="{{ route('product', $review->product->slug) }}" target="_blank">{{ translate($review->product->name) }}</a>@if ($review->viewed == 0) <span class="badge badge-success">{{ translate('New') }}</span> @endif</td>
                            <td>{{ $review->product->added_by }}</td>
                            <td>{{ $review->user->name }} ({{ $review->user->email }})</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->comment }}</td>
                            <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $review->id }}" type="checkbox" <?php if($review->status == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $reviews->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('reviews.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published reviews updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
        function filter_by_rating(el){
            var rating = $('#rating').val();
            if (rating != '') {
                $('#sort_by_rating').submit();
            }
        }
    </script>
@endsection
