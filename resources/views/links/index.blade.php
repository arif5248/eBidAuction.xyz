@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('links.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Link')}}</a>
        </div>
    </div>

    <br>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Useful Link')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th>{{translate('Name')}}</th>
                        <th width="10%">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $key => $link)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$link->name}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('links.edit', encrypt($link->id))}}">{{translate('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('links.destroy', $link->id)}}');">{{translate('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
