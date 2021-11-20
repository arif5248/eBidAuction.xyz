
<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{translate('Update Currency')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form class="form-horizontal" action="{{ route('your_currency.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $currency->id }}">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">{{translate('Name')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $currency->name }}" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="symbol">{{translate('Symbol')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Symbol')}}" id="symbol" name="symbol" value="{{ $currency->symbol }}" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="code">{{translate('Code')}}</label>
            <div class="col-sm-10">
                <input type="text" placeholder="{{translate('Code')}}" id="code" name="code" value="{{ $currency->code }}" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="exchange_rate">{{translate('Exchange Rate')}}</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" min="0" placeholder="{{translate('Exchange Rate')}}" id="exchange_rate" name="exchange_rate" value="{{ $currency->exchange_rate }}" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
    </div>
</form>
