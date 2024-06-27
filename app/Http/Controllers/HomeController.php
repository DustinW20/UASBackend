<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {

        $totalCart = 0;

        $menus = Menu::where('status', 'masih')->get();
        if (auth()->check()) {
            $cartitems = Cart::where('user_id', Auth::user()->id)->where('status', 'pending')->with('details')->get();
            $totalCart = $cartitems->sum(function ($cartItem) {
                return $cartItem->details->count();
            });
        }

        return view('home', compact('menus', 'totalCart'));
    }


    public function orders()
    {
        $totalCart = 0;

        if (auth()->check()) {
            $cartitems = Cart::where('user_id', Auth::user()->id)->where('status', 'pending')->with('details')->get();
            $totalCart = $cartitems->sum(function ($cartItem) {
                return $cartItem->details->count();
            });
        }

        $carts = Cart::where('user_id', auth()->user()->id)->where('status', '<>', 'pending')->orderBy('created_at', 'desc')->get();
        return view('order', compact('carts', 'totalCart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required'
        ]);

        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->where('status', 'pending')->first();

        if (!$cart) {
            $cart = Cart::create(['user_id' => $user->id, 'status' => 'pending']);
        }

        $cart->load('details', 'details.menu');

        foreach ($cart->details as $key => $value) {
            if ($value->menu->id == $request->menu_id) {
                return redirect()->back()->withErrors('ops menu kamu sudah ditambahkan ke cart silahkan checkout sekarang');
            }
        }
        $cartItem = $cart->details()->where('menu_id', $request->menu_id)->first();

        $menu = Menu::where('id', $request->menu_id)->first();

        CartItem::create([
            'cart_id' => $cart->id,
            'menu_id' => $request->menu_id,
            'total_price' => $menu->price
        ]);
        $cart->price += $menu->price;
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function cart()
    {
        $totalCart = 0;
        if (auth()->check()) {
            $cartitems = Cart::where('user_id', Auth::user()->id)->where('status', 'pending')->with('details')->get();
            $totalCart = $cartitems->sum(function ($cartItem) {
                return $cartItem->details->count();
            });
        }

        $carts = Cart::where('user_id', auth()->user()->id)->where('status', 'pending')->with('details', 'details.menu')->orderBy('created_at', 'asc')->get();
        return view('cart', compact('carts', 'totalCart'));
    }

    public function removeCartItem(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }

    public function updateCartItem(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartId = $cartItem->cart_id;

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $cartItem->menu->price * $request->quantity
        ]);


        $cart = Cart::where('id', $cartId)->with('details')->first();

        $totalPrice = 0;

        foreach ($cart->details as $key => $value) {
            # code...
            $totalPrice += $value->total_price;
        }
        $cart->price = $totalPrice;
        $cart->save();
        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }


    public function checkout()
    {
        // Dapatkan keranjang belanja yang masih berstatus 'pending' untuk pengguna saat ini
        $cart = Cart::where('user_id', auth()->user()->id)->where('status', 'pending')->first();

        $cart->update(['status' => 'proses']);


        return redirect()->back()->with('success', 'Checkout successful. Your order has been placed.');
    }


    public function cancelOrder(Request $request)
    {
        Cart::where('id', $request->id)->update([
            'status' => 'cancel'
        ]);

        return redirect()->back()->with('success', 'Item update successfully.');
    }

    public function about()
    {
        $totalCart = 0;

        $menus = Menu::where('status', 'masih')->get();
        if (auth()->check()) {
            $cartitems = Cart::where('user_id', Auth::user()->id)->where('status', 'pending')->with('details')->get();
            $totalCart = $cartitems->sum(function ($cartItem) {
                return $cartItem->details->count();
            });
        }
        return view('about', compact('totalCart'));
    }


    public function profile()
    {
        $totalCart = 0;

        $menus = Menu::where('status', 'masih')->get();
        if (auth()->check()) {
            $cartitems = Cart::where('user_id', Auth::user()->id)->where('status', 'pending')->with('details')->get();
            $totalCart = $cartitems->sum(function ($cartItem) {
                return $cartItem->details->count();
            });
        }
        $user = Auth::user();
        return view('profile', compact('totalCart', 'user'));
    }


    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
