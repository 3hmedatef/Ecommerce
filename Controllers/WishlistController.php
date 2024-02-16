<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class WishlistController extends Controller
{
    public function getwishlistedproducts()
    {
        $items=Cart::instance("wishlist")->content();
        return view('wishlist',['items'=>$items]);
    }
    public function addproductToWishlist(Request $request)
    {
        Cart::instance("wishlist")->add($request->id,$request->name,1,$request->price)->associate("App\Models\product");
        return response()->json(['status'=>200,'message'=>'Success | item successfully added to your wishlist.']);
    }
    public function removproductfromwishlist(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance("wishlist")->remove($rowId);
        return redirect()->route('wishlist.list');
    }
    public function clearwishlist()
    {
        Cart::instance("wishlist")->destroy();
        return redirect()->route('wishlist.list');

    }
    public function moveToCart(Request $request)
    {
        $item=Cart::instance('wishlist')->get($request->rewId);
        Cart::instance('wishlist')->remove($request->rewId);
        Cart::instance('cart')->add($item->model->id,$item->model->name,1,$item->model->regular_price)->associate("App\Models\product");
        return redirect()->route('wishlist.list');
    }
}
