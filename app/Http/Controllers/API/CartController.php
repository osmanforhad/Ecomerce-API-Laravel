<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * function for
     * Add to Cart
     * 
     * Product
     */
    public function addtocart(Request $request)
    {
        //checked the user is Logged in or not
        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;

            //check the product exists or not
            $product_check = Product::where('id', $product_id)->first();
            if ($product_check) {

                if (Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json([
                        'status' => 409,
                        'message' => $product_check->name.' Already Added to Cart',
                    ]);
                } else {

                    $caetItem = new Cart;

                    $caetItem->user_id = $user_id;
                    $caetItem->product_id = $product_id;
                    $caetItem->product_qty = $product_qty;

                    $caetItem->save();

                    return response()->json([
                        'status' => 201,
                        'message' => $product_check->name.' Added to Cart',
                    ]);
                }
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'Product not Found',
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Login to Add to Cart',
            ]);
        }
    }

    /**
     * function for
     * View Cart data
     * 
     */
    public function viewcart()
    {
        //checked the user is Logged in or not
        if (auth('sanctum')->check()) { 

            $user_id = auth('sanctum')->user()->id;

            $cartItems = Cart::where('user_id', $user_id)->get();

            return response()->json([
                'status' => 200,
                'carts' => $cartItems,
            ]);

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Login to View Cart Data',
            ]);
        }
    }

     /**
     * function for
     * 
     * Update Cart Quantity
     * 
     * as 
     * Increment / Decrement
     * 
     */
    public function upadtecartquantity($cart_id, $scope)
    {
        //checked the user is Logged in or not
        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;

            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();

            if($scope == "inc") {

                $cartItem->product_qty += 1;

            } else if($scope == "dec") {

                $cartItem->product_qty -= 1;
            }

            $cartItem->update();

            return response()->json([
                'status' => 200,
                'message' => 'Quantity Updated in Cart',
            ]);

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please Login to continue',
            ]);
        }
    }

    /**
     * function for
     * 
     * Remove Cart Item
     * 
     * from
     * Shopping Cart
     * 
     */
    public function deletecartitem($cart_id)
    {
        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;

            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();

            if($cartItem) {

                $cartItem->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Cart Item Removed Successfully',
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Cart itme not Found',
                ]);
            }

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please Login to continue',
            ]);
        }
    }

}
