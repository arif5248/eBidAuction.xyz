@extends('frontend.master')
@section('contant')
<!--category area goes here-->
    @include('frontend.inc.home.category')
<!--service area goes here-->
    @include('frontend.inc.home.service')
    
<!--product list area goes here-->
    @include('frontend.inc.home.productlist')
    
<!--advertise aria goes here-->
    @include('frontend.inc.home.advertise')
<!--individual product aria-->
    @include('frontend.inc.home.individualproduct')
<!--Used Product Aria Goes here-->
    @include('frontend.inc.home.usedproduct')
<!--Intelligence Consumer aria goes here-->
    @include('frontend.inc.home.consumer')
@endsection