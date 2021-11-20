<div class="panel-heading">
    <h3 class="panel-title">{{translate('Add Your Cart Base Coupon')}}</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{translate('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{translate('Coupon code')}}" id="coupon_code" name="coupon_code" class="form-control" required>
    </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">{{translate('Minimum Shopping')}}</label>
   <div class="col-lg-9">
      <input type="number" min="0" step="0.01" placeholder="{{translate('Minimum Shopping')}}" name="min_buy" class="form-control" required>
   </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">{{translate('Discount')}}</label>
   <div class="col-lg-8">
      <input type="number" min="0" step="0.01" placeholder="{{translate('Discount')}}" name="discount" class="form-control" required>
   </div>
   <div class="col-lg-1">
      <select class="demo-select2" name="discount_type">
         <option value="amount">$</option>
         <option value="percent">%</option>
      </select>
   </div>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label">{{translate('Maximum Discount Amount')}}</label>
   <div class="col-lg-9">
      <input type="number" min="0" step="0.01" placeholder="{{translate('Maximum Discount Amount')}}" name="max_discount" class="form-control" required>
   </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">{{translate('Date')}}</label>
    <div class="col-lg-9">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date">
                <span class="input-group-addon">{{translate('to')}}</span>
                <input type="text" class="form-control" name="end_date">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('.demo-select2').select2();
    });

</script>
