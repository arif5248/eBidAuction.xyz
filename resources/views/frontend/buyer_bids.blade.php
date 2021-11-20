@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Bids')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('seller.product.bids') }}">{{ translate('Bids')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist items -->

                        <div>
                            <div class="card no-border mt-5">
                            <div class="card-header py-3">
                                <h4 class="mb-0 h6">{{ translate('Customer Bid List')}}</h4>
                            </div>
                            <div>
                                <table class="table table-sm table-responsive-md mb-0">
                                    <thead>
                                        <tr>                                            
                                        	<th>{{  translate('Sl') }}</th>
                                            <th>{{ translate('Customer Name')}}</th>
                                            <th>{{ translate('Product')}}</th>
                                            <th>{{ translate('Price')}}</th>
                                            <th>{{ translate('Description')}}</th>
                                            <th>{{ translate('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($bids) > 0)
                                            @foreach ($bids as $key => $bid)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $bid->buyer->name }}</td>
                                                    <td>{{ $bid->product->name }}</td>
                                                    <td>{{ $bid->price }}</td>
                                                    <td>{{ $bid->description }}</td>
                                                    @if($bid->status == 'Pending')
                                                    <td><a href="{{route('bid.approve',$bid->id)}}" class="text-danger">Pending</a></td>
                                                    @else
                                                    <td><a href="#" class="text-success">Approve</a></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center pt-5 h4" colspan="100%">
                                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                                <span class="d-block">{{  translate('No history found.') }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
<script type="text/javascript">
function copyText() {
  /* Get the text field */
  var copyText = document.getElementById("referCode");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */

  $('#codeButton').removeClass('btn-primary');
  $('#codeButton').addClass('btn-success');
}
</script>
  
@endsection
