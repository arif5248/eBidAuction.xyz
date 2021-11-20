@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    {{ translate('Please enter the opt number')}}
                                </h1>
                            </div>
                            
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('verify.otp') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{$email}}">
                                        <div class="form-group">
                                            <input type="number" class="form-control h-auto form-control-lg {{ $errors->has('otp') ? ' is-invalid' : '' }}" placeholder="{{ translate('OPT')}}" name="otp" id="otp">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-styled btn-base-1 btn-md w-100">{{  translate('Verify') }}</button>
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
