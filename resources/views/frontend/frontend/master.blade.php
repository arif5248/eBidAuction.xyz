<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fedo</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
</head>
<body>
<!--header area goes here-->
@include('frontend.inc.header')
<!--navbar area goes here-->
@if(request()->is('/'))
    @include('frontend.inc.navbar')
@else
    @include('frontend.inc.collapsnav')
@endif


@yield('contant')
<!--footer aria goes here-->

@include('frontend.inc.footer')

<!-- Modal for shopping cart-->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="show-cart table">

                </table>
                <div>Total price: $<span class="total-cart"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Order now</button>
            </div>
        </div>
    </div>
</div>









<!--optional javascript-->

<!--<script src="js/jquery-3.4.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/jquery-2.2.3.min.js') }}"></script>
<script type='text/javascript' src=" {{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/timer.js') }}"></script>
<script type='text/javascript' src="{{ asset('frontend/js/bootstrap.min.js ') }}"></script>
<script src="{{ asset('frontend/js/shopping-cart.js ') }}"></script>




<script type="text/javascript">

    // jquery for to top

    $(document).ready(function(){
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('#back-to-top').tooltip('show');

    });


    // navbar fixed js goes here

    $(document).ready(function() {

        $(window).scroll(function () {

            console.log($(window).scrollTop());

            if ($(window).scrollTop() > 2000) {
                $('.fixed').addClass('fixed-top');
            }

            if ($(window).scrollTop() < 551) {
                $('.fixed').removeClass('fixed-top');
            }
        });
    });


</script>
@stack('js')



</body>
</html>
