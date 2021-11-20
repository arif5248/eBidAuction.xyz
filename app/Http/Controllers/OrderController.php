<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Product;
use App\Color;
use App\OrderDetail;
use App\CouponUsage;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use CoreComponentRepository; 
use Carbon\Carbon; 

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_status != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }

        $orders = $orders->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.seller.orders', compact('orders','payment_status','delivery_status', 'sort_search'));
    }

    public function orders_return(Request $request)    
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->where('order_details.return_request','admin_requested')
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_status != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.return_request', 'admin_requested');
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }

        $orders = $orders->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.seller.return_orders', compact('orders','payment_status','delivery_status', 'sort_search'));
    }

    /**
     * Display a listing of the resource to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', $admin_user_id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_type != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('orders.index', compact('orders','payment_status','delivery_status', 'sort_search', 'admin_user_id'));
    }

    public function admin_orders_delivery_request(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.delivery_status', 'on_delivery')
                    ->paginate(15);
        //dd($orders); die;
        return view('sales.delivery_request', compact('orders'));
    }

    public function admin_orders_return_request(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository(); 

        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.return_request', 'buyer_requested')
                    ->paginate(15);
        //dd($orders); die;
        return view('sales.return_request', compact('orders'));
    }

    public function customer_return_request($order_id){
        $delivered = OrderDetail::where('order_id',$order_id)->first();
        $delivered_date =  Carbon::parse($delivered->updated_at)->addDays(7); 
        if($delivered_date > Carbon::now()){
        $return_request = OrderDetail::where('order_id',$order_id)->first();
        $return_request->return_request = 'buyer_requested';
        $return_request->save();
        flash(translate('Return request sent successfully'))->success();
        }else{
            flash(translate('Return date is expired'))->error();
            return redirect()->back();
        }

        return redirect()->back();
        
    }

    public function admin_return_request($order_id){
        $return_request = OrderDetail::where('order_id',$order_id)->first();
        $return_request->return_request = 'admin_requested';
        $return_request->save();
        flash(translate('Return request sent successfully'))->success();
        return redirect()->back();
    }

    public function seller_return_approve($order_id){
        $return_request = OrderDetail::where('order_id',$order_id)->first();
        $return_request->return_request = 'approved';
        $return_request->delivery_status = 'return';
        $return_request->save();
        flash(translate('Return approved successfully'))->success();
        return redirect()->back();
    }



    /**
     * Display a listing of the sales to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository(); 

        $sort_search = null;
        $orders = Order::orderBy('code', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('sales.index', compact('orders', 'sort_search'));
    }

    public function bkashlist()
    {
        $bkashlist = DB::table('bkashstores')->paginate(15);
        // dd($bkashlist);
        return view('sales.bkash_list', compact('bkashlist'));
    }

    public function bkashapprove($id)
    {
        $tnx_id = $id;
        $var = DB::table('bkashstores')->where('tnx_id', $tnx_id)->first();
        $approved = DB::table('bkashstores')->where('tnx_id', $tnx_id)->update(['status'=>'approved']);
        $amount = $var->amount;
        $user_id = $var->user_id;
        $user = DB::table('users')->where('id', $user_id)->first();
        $balance = $amount + $user->balance;
        $updated_balance = DB::table('users')->where('id', $user_id)->update(['balance'=>$balance]);
        if ($approved) {  
            flash(translate('Bkash recharge approved successfully'))->success();  
            return redirect()->to('/admin/bkash/list');
        }
    }

    public function bkashreject($id)
    {
        $tnx_id = $id;
        $rejected = DB::table('bkashstores')->where('tnx_id', $tnx_id)->update(['status'=>'rejected']);
        if ($rejected) {
            flash(translate('Bkash recharge rejected successfully'))->success();    
            return redirect()->to('/admin/bkash/list');
        }
    }


    public function order_index(Request $request)
    {

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
        else{
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.shipping_type', 'pickup_point')
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
        else{
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        return view('sales.show', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }
        else{
            $order->guest_id = mt_rand(100000, 999999);
        }

        $order->shipping_address = json_encode($request->session()->get('shipping_info'));

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His').rand(10,99);
        $order->date = strtotime('now');

        if($order->save()){
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();

            //Order Details Storing
            foreach (Session::get('cart') as $key => $cartItem){
                $product = Product::find($cartItem['id']);

                if($product->added_by == 'admin'){
                    array_push($admin_products, $cartItem['id']);
                }
                else{
                    $product_ids = array();
                    if(array_key_exists($product->user_id, $seller_products)){
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem['id']);
                    $seller_products[$product->user_id] = $product_ids;
                }

                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];

                $product_variation = $cartItem['variant'];

                if($product_variation != null){
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }
                else {
                    $product->current_stock -= $cartItem['quantity'];
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  =$order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];

                //Dividing Shipping Costs
                if ($cartItem['shipping_type'] == 'home_delivery') {
                    $order_detail->shipping_cost = getShippingCost($key);
                    $shipping += $order_detail->shipping_cost;
                }
                else{
                    $order_detail->shipping_cost = 0;
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if(Session::has('coupon_discount')){
                $order->grand_total -= Session::get('coupon_discount');
                $order->coupon_discount = Session::get('coupon_discount');

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }

            $order->save();

            //stores the pdf for invoice
            $pdf = PDF::setOptions([
                            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                            'logOutputFile' => storage_path('logs/log.htm'),
                            'tempDir' => storage_path('logs/')
                        ])->loadView('invoices.customer_invoice', compact('order'));
            $output = $pdf->output();
    		file_put_contents('public/invoices/'.'Order#'.$order->code.'.pdf', $output);

            $array['view'] = 'emails.invoice';
            $array['subject'] = 'Order Placed - '.$order->code;
            $array['from'] = env('MAIL_USERNAME');
            $array['content'] = translate('Hi. A new order has been placed. Please check the attached invoice.');
            $array['file'] = 'public/invoices/Order#'.$order->code.'.pdf';
            $array['file_name'] = 'Order#'.$order->code.'.pdf';

            foreach($seller_products as $key => $seller_product){
                try {
                    Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {

                }
            }

            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value){
                try {
                    $otpController = new OTPVerificationController;
                    $otpController->send_order_code($order);
                } catch (\Exception $e) {

                }
            }

            //sends email to customer with the invoice pdf attached
            if(env('MAIL_USERNAME') != null){
                try {
                    Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                    Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {

                }
            }
            unlink($array['file']);

            $request->session()->put('order_id', $order->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order != null){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delete();
            }
            $order->delete();
            flash(translate('Order has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        //$order->viewed = 1;
        $order->save();
        return view('frontend.partials.order_details_seller', compact('order'));  
    }


    public function sale_order_details(Request $request){
        $order = Order::findOrFail($request->order_id);
        //$order->viewed = 1;
        $order->save();
        return view('sales.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->save();
        if(Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('order_id', $order->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        return 1;
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();
        if(Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('order_id', $order->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();


        if($order->payment_status == 'paid' && $order->commission_calculated == 0){
            if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                if ($order->payment_type == 'cash_on_delivery') {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                                $seller->save();
                            }
                        }
                    }
                    else{
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                                $seller->save();
                            }
                        }
                    }
                }
                elseif($order->manual_payment) {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                                $seller->save();
                            }
                        }
                    }
                    else{
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                                $seller->save();
                            }
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                $clubpointController = new ClubPointController;
                $clubpointController->processClubPoints($order);
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }
        return 1;
    }
}
