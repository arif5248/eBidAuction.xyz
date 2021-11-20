@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="align-items-center card-header d-flex justify-content-center text-center" >
                            <h3 class="d-inline-block heading-4 mb-0 mr-3 strong-600" >{{translate('2Checkout Payment')}}</h3>
                        </div>
                        <div class="card-body">
                            <form id="myCCForm" action="{{ route('twocheckout.post') }}" method="post">
                                @csrf
                              <input name="token" type="hidden" value="" />

                              <div class='form-row'>
                                  <div class='col-12 form-group required'>
                                      <label class='control-label'>{{translate('Card Number')}}</label>
                                      <input id="ccNo" autocomplete='off' class='form-control card-number' size='20' type='text'>
                                  </div>
                              </div>

                              <div class='form-row'>
                                  <div class='col-12 col-md-4 form-group cvc required'>
                                      <label class='control-label'>{{translate('CVC')}}</label>
                                      <input autocomplete='off' class='form-control card-cvc' id="cvv" placeholder='ex. 311' size='4' type='text'>
                                  </div>
                                  <div class='col-12 col-md-4 form-group expiration required'>
                                      <label class='control-label'>{{translate('Expiration Month')}}</label>
                                      <input class='form-control card-expiry-month' id="expMonth" placeholder='MM' size='2' type='text'>
                                  </div>
                                  <div class='col-12 col-md-4 form-group expiration required'>
                                      <label class='control-label'>{{translate('Expiration Year')}}</label>
                                      <input class='form-control card-expiry-year' id="expYear" placeholder='YYYY' size='4' type='text'>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-12">
                                      @if (Session::get('payment_type') == 'cart_payment')
                                          <button class="btn btn-base-1 btn-block" type="submit">{{translate('Pay Now')}} (${{ number_format(convert_to_usd(\App\Order::findOrFail(Session::get('order_id'))->grand_total), 2) }})</button>
                                      @elseif(Session::get('payment_type') == 'wallet_payment')
                                          <button class="btn btn-base-1 btn-block" type="submit">{{translate('Pay Now')}} (${{ number_format(convert_to_usd(Session::get('payment_data')['amount']), 2) }})</button>
                                      @endif
                                  </div>
                              </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

    <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

    <script type="text/javascript">

      // Called when token created successfully.
      var successCallback = function(data) {

        console.log(data);

        var myForm = document.getElementById('myCCForm');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
        myForm.submit();
      };

      // Called when token creation fails.
      var errorCallback = function(data) {
        if (data.errorCode === 200) {
          // This error code indicates that the ajax call failed. We recommend that you retry the token request.
        } else {
          alert(data.errorMsg);
        }
      };

      var tokenRequest = function() {
        // Setup token request arguments
        var args = {
          sellerId: "901419165",
          publishableKey: "AD1CC280-5B5D-43C0-A0F6-6A38F443DB21",
          ccNo: $("#ccNo").val(),
          cvv: $("#cvv").val(),
          expMonth: $("#expMonth").val(),
          expYear: $("#expYear").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
      };

      $(function() {
        // Pull in the public encryption key for our environment
        //TCO.loadPubKey('sandbox');
        TCO.loadPubKey('sandbox', function() {
            // Sandbox Public Key is loaded
            $("#myCCForm").submit(function(e) {
                e.preventDefault();
              // Call our token request function
              tokenRequest();

              // Prevent form from submitting
              return false;
            });
        });​
      });

    </script>
@endsection
