@extends('layouts.app')

@section('content')
<div>
    <h1 class="page-header text-overflow">{{ translate('Edit Product') }}</h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
			<input name="_method" type="hidden" value="POST">
			<input type="hidden" name="id" value="{{ $product->id }}">
			@csrf
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Information')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Product Name')}}</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="name" placeholder="{{translate('Product Name')}}" value="{{$product->name}}" required>
                        </div>
                    </div>
                    <div class="form-group" id="category">
                        <label class="col-lg-2 control-label">{{translate('Category')}}</label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                            	<option>{{ translate('Select an option') }}</option>
                            	@foreach($categories as $category)
                            	    <option value="{{$category->id}}" <?php if($product->category_id == $category->id) echo "selected"; ?> >{{__($category->name)}}</option>
                            	@endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="subcategory">
                        <label class="col-lg-2 control-label">{{translate('Subcategory')}}</label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>

                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="subsubcategory">
                        <label class="col-lg-2 control-label">{{translate('Sub Subcategory')}}</label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="brand">
                        <label class="col-lg-2 control-label">{{translate('Brand')}}</label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
								<option value="">{{ ('Select Brand') }}</option>
								@foreach (\App\Brand::all() as $brand)
									<option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
								@endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Unit')}}</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="unit" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" value="{{$product->unit}}" required>
                        </div>
                    </div>
                    <div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Minimum Qty')}}</label>
						<div class="col-lg-7">
							<input type="number" class="form-control" name="min_qty" value="@if($product->min_qty <= 1){{1}}@else{{$product->min_qty}}@endif" min="1" required>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Tags')}}</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">
                        </div>
                    </div>
					@php
					    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
					@endphp
					@if ($pos_addon != null && $pos_addon->activated == 1)
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Barcode')}}</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="barcode" placeholder="{{ translate('Barcode') }}" value="{{ $product->barcode }}">
							</div>
						</div>
					@endif

					@php
					    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
					@endphp
					@if ($refund_request_addon != null && $refund_request_addon->activated == 1)
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Refundable')}}</label>
							<div class="col-lg-7">
								<label class="switch" style="margin-top:5px;">
									<input type="checkbox" name="refundable" @if ($product->refundable == 1) checked @endif>
		                            <span class="slider round"></span></label>
								</label>
							</div>
						</div>
					@endif
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Images')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Gallery Images')}}</label>
						<div class="col-lg-7">
							<div id="photos">
								@if(is_array(json_decode($product->photos)))
									@foreach (json_decode($product->photos) as $key => $photo)
										<div class="col-md-4 col-sm-4 col-xs-6">
											<div class="img-upload-preview">
												<img loading="lazy"  src="{{ my_asset($photo) }}" alt="" class="img-responsive">
												<input type="hidden" name="previous_photos[]" value="{{ $photo }}">
												<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Thumbnail Image')}} <small>(290x300)</small></label>
						<div class="col-lg-7">
							<div id="thumbnail_img">
								@if ($product->thumbnail_img != null)
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="img-upload-preview">
											<img loading="lazy"  src="{{ my_asset($product->thumbnail_img) }}" alt="" class="img-responsive">
											<input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Videos')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Provider')}}</label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
								<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{translate('Youtube')}}</option>
								<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{translate('Dailymotion')}}</option>
								<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{translate('Vimeo')}}</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Video Link')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="{{ translate('Video Link') }}">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Variation')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="{{translate('Colors')}}" disabled>
						</div>
						<div class="col-lg-7">
							<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
								@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
									<option value="{{ $color->code }}" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-2">
							<label class="switch" style="margin-top:5px;">
								<input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>
						</div>
	                    <div class="col-lg-7">
	                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="{{ translate('Choose Attributes') }}">
								@foreach (\App\Attribute::all() as $key => $attribute)
									<option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
								@endforeach
	                        </select>
	                    </div>
	                </div>

					<div class="">
						<p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>
						<br>
					</div>

					<div class="customer_choice_options" id="customer_choice_options">
						@foreach (json_decode($product->choice_options) as $key => $choice_option)
							<div class="form-group">
								<div class="col-lg-2">
									<input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
									<input type="text" class="form-control" name="choice[]" value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}" placeholder="{{ translate('Choice Title') }}" disabled>
								</div>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="{{ translate('Enter choice values') }}" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">
								</div>
								<div class="col-lg-2">
									<button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>
								</div>
							</div>
						@endforeach
					</div>
					{{-- <div class="form-group">
						<div class="col-lg-2">
							<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()">{{ translate('Add more customer choice option') }}</button>
						</div>
					</div> --}}
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product price + stock')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Unit price')}}</label>
                        <div class="col-lg-7">
                            <input type="text" placeholder="{{translate('Unit price')}}" name="unit_price" class="form-control" value="{{$product->unit_price}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Purchase price')}}</label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="{{translate('Purchase price')}}" name="purchase_price" class="form-control" value="{{$product->purchase_price}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Tax')}}</label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="{{translate('tax')}}" name="tax" class="form-control" value="{{$product->tax}}" required>
                        </div>
                        <div class="col-lg-1">
                            <select class="demo-select2" name="tax_type" required>
                            	<option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> >{{translate('Flat')}}</option>
                            	<option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> >{{translate('Percent')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Discount')}}</label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="{{translate('Discount')}}" name="discount" class="form-control" value="{{ $product->discount }}" required>
                        </div>
                        <div class="col-lg-1">
                            <select class="demo-select2" name="discount_type" required>
                            	<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >{{translate('Flat')}}</option>
                            	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >{{translate('Percent')}}</option>
                            </select>
                        </div>
                    </div>
					<div class="form-group" id="quantity">
						<label class="col-lg-2 control-label">{{translate('Quantity')}}</label>
						<div class="col-lg-7">
							<input type="number" value="{{ $product->current_stock }}" step="1" placeholder="{{translate('Quantity')}}" name="current_stock" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="sku_combination" id="sku_combination">

					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('Product Description')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
                        <label class="col-lg-2 control-label">{{translate('Description')}}</label>
                        <div class="col-lg-9">
                            <textarea class="editor" name="description">{{$product->description}}</textarea>
                        </div>
                    </div>
				</div>
			</div>
			@if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping')
                <div class="panel">
    				<div class="panel-heading bord-btm">
    					<h3 class="panel-title">{{translate('Product Shipping Cost')}}</h3>
    				</div>
    				<div class="panel-body">
    					<div class="row bord-btm">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title">{{translate('Free Shipping')}}</h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Status')}}</label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free') checked @endif>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    						</div>
    					</div>

    					<div class="row bord-btm">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title">{{translate('Flat Rate')}}</h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Status')}}</label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type == 'flat_rate') checked @endif>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-lg-2 control-label">{{translate('Shipping cost')}}</label>
    								<div class="col-lg-7">
    									<input type="number" min="0" step="0.01" placeholder="{{translate('Shipping cost')}}" name="flat_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" required>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
            @endif
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('PDF Specification')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('PDF Specification')}}</label>
						<div class="col-lg-7">
							<input type="file" class="form-control" placeholder="{{translate('PDF')}}" name="pdf" accept="application/pdf">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title">{{translate('SEO Meta Tags')}}</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Meta Title')}}</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{translate('Meta Title')}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{translate('Description')}}</label>
						<div class="col-lg-7">
							<textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{ translate('Meta Image') }}</label>
						<div class="col-lg-7">
							<div id="meta_photo">
								@if ($product->meta_img != null)
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="img-upload-preview">
											<img loading="lazy"  src="{{ my_asset($product->meta_img) }}" alt="" class="img-responsive">
											<input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info">{{ translate('Update Product') }}</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('script')

<script type="text/javascript">

	// var i = $('input[name="choice_no[]"').last().val();
	// if(isNaN(i)){
	// 	i =0;
	// }

	function add_more_customer_choice_option(i, name){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{{ translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	// $('input[name="unit_price"]').on('keyup', function() {
	//     update_sku();
	// });

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination_edit') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if (data.length > 1) {
				   $('#quantity').hide();
			   }
			   else {
					$('#quantity').show();
			   }
		   }
	   });
	}

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subcategory_id > option").each(function() {
		        if(this.value == '{{$product->subcategory_id}}'){
		            $("#subcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subsubcategory_id > option").each(function() {
		        if(this.value == '{{$product->subsubcategory_id}}'){
		            $("#subsubcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	// function get_brands_by_subsubcategory(){
	// 	var subsubcategory_id = $('#subsubcategory_id').val();
	// 	$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
	// 	    $('#brand_id').html(null);
	// 	    for (var i = 0; i < data.length; i++) {
	// 	        $('#brand_id').append($('<option>', {
	// 	            value: data[i].id,
	// 	            text: data[i].name
	// 	        }));
	// 	    }
	// 	    $("#brand_id > option").each(function() {
	// 	        if(this.value == '{{$product->brand_id}}'){
	// 	            $("#brand_id").val(this.value).change();
	// 	        }
	// 	    });
	//
	// 	    $('.demo-select2').select2();
	//
	// 	});
	// }

	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_attributes_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#choice_attributes').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#choice_attributes').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
			$("#choice_attributes > option").each(function() {
				var str = @php echo $product->attributes @endphp;
		        $("#choice_attributes").val(str).change();
		    });

			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});

		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    //get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

	$('#choice_attributes').on('change', function() {
		//$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(j, attribute){
			flag = false;
			$('input[name="choice_no[]"]').each(function(i, choice_no) {
				if($(attribute).val() == $(choice_no).val()){
					flag = true;
				}
			});
            if(!flag){
				add_more_customer_choice_option($(attribute).val(), $(attribute).text());
			}
        });

		var str = @php echo $product->attributes @endphp;

		$.each(str, function(index, value){
			flag = false;
			$.each($("#choice_attributes option:selected"), function(j, attribute){
				if(value == $(attribute).val()){
					flag = true;
				}
			});
            if(!flag){
				//console.log();
				$('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
			}
		});

		update_sku();
	});

</script>

@endsection
