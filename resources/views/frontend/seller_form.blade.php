@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-9 mx-auto">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Shop Informations')}}
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('shops.create') }}">{{ translate('Create Shop')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="shop" class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (!Auth::check())
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        {{ translate('User Info')}}
                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{  translate('Name') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Name') }}" name="name">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{  translate('Email') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-envelope"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{  translate('Password') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-lock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <!-- <label>{{  translate('Confirm Password') }}</label> -->
                                                    <div class="input-group input-group--style-1">
                                                        <input type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                                        <span class="input-group-addon">
                                                            <i class="text-md la la-lock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{ translate('Basic Info')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{ translate('Shop Name')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Shop Name')}}" name="name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{ translate('Trade Licence Number')}} </label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Trade Licence Number')}}" name="trade_licence" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{ translate('Logo')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="logo" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-2" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    {{ translate('Choose image')}}
                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{ translate('Address')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" required onclick="getLocation()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                <div class="form-group mt-2 mx-auto row">
                                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                </div>
                            @endif
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{ translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                    <p id="demo"></p>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    // making the CAPTCHA  a required field for form submission
    $(document).ready(function(){
        // alert('helloman');
        $("#shop").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("please verify you are humann!");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
        });
    });
</script>
<script>

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    $('longitude').val('')
    $('latitude').val('')
  }
}

function showPosition(position) {
    $('#longitude').val(position.coords.longitude)
    $('#latitude').val(position.coords.latitude)
}
</script>
@endsection
