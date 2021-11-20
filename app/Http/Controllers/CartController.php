<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use Session;
use App\Color;
use App\Bid;
use Cookie;
use Auth;
use App\User;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        return view('frontend.view_cart', compact('categories'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        $max_bidding = Bid::where('product_id',$product->id)->max('price');
        return view('frontend.partials.addToCart', compact('product','max_bidding'));
    }

    public function updateNavCart(Request $request)
    {
        return view('frontend.partials.cart');
    }

    public function addToCart(Request $request)
    {
            $product = '';
            $data = '';
            $message = '';
            $empty_balance = '';
            $auth = false;
            if(!Auth::check()){
                $auth = true;
                $message = 'Please Sign in for bidding';
            }else{
                $user = User::find(Auth::id());
                if($user->balance < $request->bidding_price){
                    $empty_balance = true;
                    $message = 'insufficient balance';
                }else{
                    $product = Product::find($request->id);
                    $data = array();
                    $data['id'] = $product->id;
                    $data['price'] = $request->bidding_price;
                    $data['description'] = $request->description;
                    $add_bid = new Bid();
                    $add_bid->buyer_id = Auth::id();
                    $add_bid->seller_id = $product->user_id;
                    $add_bid->product_id = $product->id;
                    $add_bid->price = $request->bidding_price;
                    $add_bid->description = $request->description;
                    $add_bid->save();
                    $message = 'Your bid sent successfully';
                }   
        } 
        return view('frontend.partials.addedToCart', compact('product', 'data', 'empty_balance','message','auth'));
    }

    public function addToCartByProductDetails(Request $request)
    {
            $request->validate([
                'bidding_price' => 'required',
            ]);
            $product = '';
            $data = '';
            $message = '';
            $empty_balance = '';
            if(!Auth::check()){
                flash(translate('Please Sing in for bidding'))->error();
                return redirect()->back();
            }else{
                $user = User::find(Auth::id());
                if($user->balance < $request->bidding_price){
                    $empty_balance = true;
                    flash(translate('insufficient balance'))->error();
                    return redirect()->back();
                }else{
                    $product = Product::find($request->id);
                    $data = array();
                    $data['id'] = $product->id;
                    $data['price'] = $request->bidding_price;
                    $data['description'] = $request->description;
                    $add_bid = new Bid();
                    $add_bid->buyer_id = Auth::id();
                    $add_bid->seller_id = $product->user_id;
                    $add_bid->product_id = $product->id;
                    $add_bid->price = $request->bidding_price;
                    $add_bid->description = $request->description;
                    $add_bid->save();
                    flash(translate('Your bid sent successfully'))->success();
                    return redirect()->back();
                }   
        } 
        
    }

    public function bidList(){
        $bids = Bid::where('seller_id', Auth::id())->get();
        return view('frontend.buyer_bids',compact('bids'));
    }

    public function approveBid($id){
        $update_bid = Bid::find($id);
        $update_bid->status = 'Approved';
        $update_bid->update();

        //commision calculation
        $main_price_for_seller =  $update_bid->price - $update_bid->price * 10/100;
        $admin_commission = $update_bid->price * 10/100;


        $customer_balance = User::where('id', $update_bid->buyer_id)->first();
        $customer_balance->balance = $customer_balance->balance - $update_bid->price;
        $customer_balance->update();
        $seller_balance = User::where('id',$update_bid->seller_id)->first();
        $seller_balance->balance = $seller_balance->balance + $main_price_for_seller;
        $seller_balance->update();
        $admin = User::where('id','11')->first();
        $admin->balance = $admin->balance + $admin_commission;
        $admin->update();
        $user = User::where('id',$update_bid->buyer_id)->first();
        $email = $user->email;
                Mail::raw("Your requested bidding has beed approved by seller. Please check your bidding list", function($message) use($email)
                    {
                        $message->from(env('MAIL_FROM_ADDRESS'), 'Online Shop');

                        $message->to($email);
                    });
        flash(translate('Bid request approved successfully'))->success();
        return redirect()->back();
    }


    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart', collect([]));
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        return view('frontend.partials.cart_details');
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if($key == $request->key){
                $product = \App\Product::find($object['id']);
                if($object['variant'] != null && $product->variant_product){
                    $product_stock = $product->stocks->where('variant', $object['variant'])->first();
                    $quantity = $product_stock->qty;
                    if($quantity >= $request->quantity){
                        if($request->quantity >= $product->min_qty){
                            $object['quantity'] = $request->quantity;
                        }
                    }
                }
                elseif($request->quantity >= $product->min_qty){
                    $object['quantity'] = $request->quantity;
                }
            }
            return $object;
        });
        $request->session()->put('cart', $cart);

        return view('frontend.partials.cart_details');
    }
}
