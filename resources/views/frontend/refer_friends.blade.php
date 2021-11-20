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
                                        {{ translate('Refer a friend')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('refer.friends') }}">{{ translate('Refer a friend')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist items -->

                        <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                            <h1 class="text-center">Refer a Friend</h1>
                            @php 
                            $refer_code = \App\User::where('id',Auth::user()->id)->first();
                            @endphp
                            <input type="text" class="form-control" readonly="" id="referCode" name="" value="{{$refer_code->referral_code}}">
                            <button class="btn btn-primary" onclick="copyText()" id="codeButton">Copy code</button>
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
