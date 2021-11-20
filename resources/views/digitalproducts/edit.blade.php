@extends('layouts.app')

@section('content')
	<div>
		<h1 class="page-header text-overflow">{{ translate('Edit Digital Product') }}</h1>
	</div>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<form class="form form-horizontal mar-top" action="{{route('digitalproducts.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
				<input name="_method" type="hidden" value="PATCH">
				<input type="hidden" name="id" value="{{ $product->id }}">
				@csrf
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">{{translate('General')}}</h3>
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
									<option>{{translate('Select an option') }}</option>
									@foreach(\App\Category::where('digital', 1)->get() as $category)
										<option value="{{ $category->id }}" <?php if($product->category_id == $category->id) echo "selected"; ?> >{{__($category->name)}}</option>
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
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Product File')}}</label>
							<div class="col-lg-7">
								<input type="file" class="form-control" name="file">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Tags')}}</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}" data-role="tagsinput">
							</div>
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">{{translate('Images')}}</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Main Images')}}</label>
							<div class="col-lg-7">
								<div id="photos">
									@if(is_array(json_decode($product->photos)))
										@foreach (json_decode($product->photos) as $key => $photo)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ my_asset($photo) }}" alt="" class="img-responsive">
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
												<img src="{{ my_asset($product->thumbnail_img) }}" alt="" class="img-responsive">
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
					<div class="panel-heading">
						<h3 class="panel-title">{{translate('Meta Tags')}}</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-lg-2 control-label">{{translate('Slug')}}</label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="slug" value="{{ $product->slug }}" placeholder="{{translate('Slug')}}">
							</div>
						</div>

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
												<img src="{{ my_asset($product->meta_img) }}" alt="" class="img-responsive">
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
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">{{translate('Price')}}</h3>
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
									<option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> >$</option>
									<option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> >%</option>
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
									<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >$</option>
									<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >%</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">{{translate('Description')}}</h3>
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
				<div class="panel-footer text-right">
					<button type="submit" name="button" class="btn btn-purple">{{ translate('Save') }}</button>
				</div>
			</div>
		</form>
	</div>

@endsection

@section('script')

	<script type="text/javascript">

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
		});
	}

	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('subsubcategories.get_brands_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
			$('#brand_id').html(null);
			for (var i = 0; i < data.length; i++) {
				$('#brand_id').append($('<option>', {
					value: data[i].id,
					text: data[i].name
				}));
			}
			$("#brand_id > option").each(function() {
				if(this.value == '{{$product->brand_id}}'){
					$("#brand_id").val(this.value).change();
				}
			});

			$('.demo-select2').select2();

		});
	}

	$(document).ready(function(){
		$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
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
		get_brands_by_subsubcategory();
	});

</script>

@endsection
