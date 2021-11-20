@extends('layouts.app')

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Product Bulk Upload')}}</h3>
        </div>
        <div class="panel-body">
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>{{ translate('Step 1')}}:</strong>
                <p>1. {{translate('Download the skeleton file and fill it with proper data')}}.</p>
                <p>2. {{translate('You can download the example file to understand how the data must be filled')}}.</p>
                <p>3. {{translate('Once you have downloaded and filled the skeleton file, upload it in the form below and submit')}}.</p>
                <p>4. {{translate('After uploading products you need to edit them and set product\'s images and choices')}}.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ my_asset('download/product_bulk_demo.xlsx') }}" download><button class="btn btn-primary">{{ translate('Download CSV')}}</button></a>
            </div>
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>{{translate('Step 2')}}:</strong>
                <p>1. {{translate('Category,Sub category,Sub Sub category and Brand should be in numerical ids')}}.</p>
                <p>2. {{translate('You can download the pdf to get Category,Sub category,Sub Sub category and Brand id')}}.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ route('pdf.download_category') }}"><button class="btn btn-primary">{{translate('Download Category')}}</button></a>
                <a href="{{ route('pdf.download_sub_category') }}"><button class="btn btn-primary">{{translate('Download Sub category')}}</button></a>
                <a href="{{ route('pdf.download_sub_sub_category') }}"><button class="btn btn-primary">{{translate('Download Sub Sub category')}}</button></a>
                <a href="{{ route('pdf.download_brand') }}"><button class="btn btn-primary">{{translate('Download Brand')}}</button></a>
            </div>
            <br>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <h1 class="panel-title"><strong>{{translate('Upload Product File')}}</strong></h1>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('bulk_product_upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="bulk_file" required>
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit">{{translate('Upload CSV')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
