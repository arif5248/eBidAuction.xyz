@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Sub Subcategory Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('subsubcategories.update', $subsubcategory->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required value="{{$subsubcategory->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Category')}}</label>
                    <div class="col-sm-9">
                        <select name="category_id" id="category_id" class="form-control sub-demo-select2" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{__($category->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Subcategory')}}</label>
                    <div class="col-sm-9">
                        <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2" required>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{translate('Banner')}} <small>(200x300)</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="banner" name="banner" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="icon">{{translate('Icon')}} <small>(32x32)</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="icon" name="icon" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{translate('Meta Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $subsubcategory->meta_title }}" placeholder="{{translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{translate('Description')}}</label>
                    <div class="col-sm-9">
                        <textarea name="meta_description" rows="8" class="form-control">{{ $subsubcategory->meta_description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{translate('Slug')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $subsubcategory->slug }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection


@section('script')

<script type="text/javascript">


    function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $('#sub_category_id').html(null);
            var extra = "";
		    for (var i = 0; i < data.length; i++) {
                data[i].id == '{{ $subsubcategory->sub_category_id }}' ? extra = "selected " : extra = "";
		    
                $('#sub_category_id').append($(`<option value="${data[i].id}" ${extra}>${data[i].name}</option>`));
		    }	    

		    $('.sub-demo-select2').select2();		    
		});
	}

    $('.demo-select2').select2();

    $(document).ready(function(){

        $("#category_id > option").each(function() {
            if(this.value == '{{$subsubcategory->subcategory->category_id}}'){
                $("#category_id").val(this.value).change();
            }
        });

        get_subcategories_by_category();
    });

    $('#category_id').on('change', function() {
        get_subcategories_by_category();
    });

</script>

@endsection
