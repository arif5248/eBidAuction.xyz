@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{translate('Edit Page')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="title">{{translate('Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Title')}}" id="title" name="title" value="{{ $page->title }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{translate('Slug')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $page->slug }}" class="form-control" required>
                            <small><code>http://domain.com/your-slug</code> Only a-z, numbers, hypen allowed</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="content">{{translate('Content')}}</label>
                        <div class="col-sm-9">
                            <textarea class="editor" name="content" required>
                                @php
                                    echo $page->content
                                @endphp
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{translate('Meta Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Meta Title')}}" id="meta_title" name="meta_title" value="{{ $page->meta_title }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_description">{{translate('Meta Description')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Meta Description')}}" id="meta_description" name="meta_description" value="{{ $page->meta_description }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="keywords">{{translate('Keywords')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Keywords')}}" id="keywords" name="keywords" value="{{ $page->keywords }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_image">{{translate('Meta Image')}} <small>(200x300)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="meta_image" name="meta_image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Update')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>
</div>
@endsection
