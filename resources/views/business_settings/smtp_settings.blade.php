@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{translate('SMTP Settings')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('MAIL DRIVER')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <select class="demo-select2" name="MAIL_DRIVER" onchange="checkMailDriver()">
                                <option value="sendmail" @if (env('MAIL_DRIVER') == "sendmail") selected @endif>{{ translate('Sendmail') }}</option>
                                <option value="smtp" @if (env('MAIL_DRIVER') == "smtp") selected @endif>{{ translate('SMTP') }}</option>
                                <option value="mailgun" @if (env('MAIL_DRIVER') == "mailgun") selected @endif>{{ translate('Mailgun') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="smtp">
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_HOST">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL HOST')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="{{ translate('MAIL HOST') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_PORT">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL PORT')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="{{ translate('MAIL PORT') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL USERNAME')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="{{ translate('MAIL USERNAME') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL PASSWORD')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="{{ translate('MAIL PASSWORD') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL ENCRYPTION')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="{{ translate('MAIL ENCRYPTION') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL FROM ADDRESS')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="{{ translate('MAIL FROM ADDRESS') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAIL FROM NAME')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="{{ translate('MAIL FROM NAME') }}">
                            </div>
                        </div>
                    </div>
                    <div id="mailgun">
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAILGUN DOMAIN')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAILGUN_DOMAIN" value="{{  env('MAILGUN_DOMAIN') }}" placeholder="{{ translate('MAILGUN DOMAIN') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                            <div class="col-lg-3">
                                <label class="control-label">{{translate('MAILGUN SECRET')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="MAILGUN_SECRET" value="{{  env('MAILGUN_SECRET') }}" placeholder="{{ translate('MAILGUN SECRET') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel bg-gray-light">
            <div class="panel-body">
                <h4>{{translate('Instruction')}}</h4>
                <p class="text-danger">{{ translate('Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.') }}</p>
                <hr>
                <p>{{ translate('For Non-SSL') }}</p>
                <ul class="list-group">
                    <li class="list-group-item text-dark">{{ translate('Select \'sendmail\' for Mail Driver if you face any issue after configuring \'smtp\' as Mail Driver ') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail port as \'587\'') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Encryption as \'ssl\' if you face issue with \'tls\'') }}</li>
                </ul>
                <p>{{ translate('For SSL') }}</p>
                <ul class="list-group mar-no">
                    <li class="list-group-item text-dark">{{ translate('Select \'sendmail\' for Mail Driver if you face any issue after configuring \'smtp\' as Mail Driver') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Host according to your server Mail Client Manual Settings') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail port as \'465\'') }}</li>
                    <li class="list-group-item text-dark">{{ translate('Set Mail Encryption as \'ssl\'') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function(){
            checkMailDriver();
        });
        function checkMailDriver(){
            if($('select[name=MAIL_DRIVER]').val() == 'mailgun'){
                $('#mailgun').show();
                $('#smtp').hide();
            }
            else{
                $('#mailgun').hide();
                $('#smtp').show();
            }
        }
    </script>

@endsection
