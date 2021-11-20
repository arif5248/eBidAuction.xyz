@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{{ translate('Default Language') }}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{ translate('Default Language') }}</label>
                            </div>
                            <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                            <div class="col-lg-6">
                                <select class="form-control demo-select2-placeholder" name="DEFAULT_LANGUAGE">
                                    @foreach (\App\Language::all() as $key => $language)
                                        <option value="{{ $language->code }}" <?php if(env('DEFAULT_LANGUAGE') == $language->code) echo 'selected'?> >{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn btn-purple" type="submit">{{ translate('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('languages.create')}}" class="btn btn-rounded btn-info pull-right">{{ translate('Add New Language') }}</a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Language')}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Name')}}</th>
                            <th>{{translate('Code')}}</th>
                            <th>{{translate('RTL')}}</th>
                            <th width="10%">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($languages as $key => $language)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->code }}</td>
                                <td><label class="switch">
                                    <input onchange="update_rtl_status(this)" value="{{ $language->id }}" type="checkbox" <?php if($language->rtl == 1) echo "checked";?> >
                                    <span class="slider round"></span></label>
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                            {{translate('Actions')}} <i class="dropdown-caret"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{route('languages.show', encrypt($language->id))}}">{{translate('Translation')}}</a></li>
                                            <li><a href="{{route('languages.edit', encrypt($language->id))}}">{{translate('Edit')}}</a></li>
                                            @if($language->code != 'en')
                                                <li><a onclick="confirm_modal('{{route('languages.destroy', $language->id)}}');">{{translate('Delete')}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_rtl_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('languages.update_rtl_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
