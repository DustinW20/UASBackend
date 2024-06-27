<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function index()
    {
        $totalSoldToday = CartItem::whereDate('created_at', Carbon::today())->sum('quantity');


        $menus = Menu::count();


        $monthlyRevenue = Cart::selectRaw('SUM(price) as total, EXTRACT(MONTH FROM created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'done')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Ensure all months are present
        for ($i = 1; $i <= 12; $i++) {
            if (!array_key_exists($i, $monthlyRevenue)) {
                $monthlyRevenue[$i] = 0;
            }
        }
        ksort($monthlyRevenue);
        return view('admin.index', compact('monthlyRevenue', 'menus', 'totalSoldToday'));
    }


    public function menu()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }


    public function menuCreate()
    {
        return view('admin.menu-create');
    }


    public function menuStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu created successfully.');
    }

    public function menuEdit($id)
    {
        $menu = Menu::where('id', $id)->first();

        return view('admin.menu-edit', compact('menu'));
    }



    public function menuDestroy($id)
    {

        $menu = Menu::where('id', $id)->first();

        if ($menu->image && file_exists(public_path('img/' . $menu->image))) {
            unlink(public_path('img/' . $menu->image));
        }
        $menu->delete();
        return redirect()->route('admin.menu')->with('success', 'Menu deleted successfully.');
    }

    public function menuUpdate(Request $request,  $id)
    {
        $menu = Menu::where('id', $id)->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image && file_exists(public_path('img/' . $menu->image))) {
                unlink(public_path('img/' . $menu->image));
            }
            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $menu->image = $imageName;
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $menu->image,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu updated successfully.');
    }


    public function orderUpdate(Request $request, $id)
    {
        $order = Cart::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.riwayat')->with('success', 'Order status updated successfully');
    }

    public function orderDestroy($id)
    {
        $order = Cart::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.riwayat')->with('success', 'Order deleted successfully');
    }


    public function order()
    {

        $orders = Cart::with('details.menu')->where('status', 'proses')->orderBy('status', 'asc')->get();

        return view('admin.order', compact('orders'));
    }

    public function riwayat()
    {

        $orders = Cart::with('details.menu')->where('status', '<>', 'proses')->orderBy('status', 'asc')->get();
        foreach ($orders as $key => $value) {
            # code...
            $itemMenu = '';
            foreach ($value->details as $keyItemCart => $valueItemCart) {
                # code...
                $itemMenu = $itemMenu.''.$valueItemCart->menu->name.',';
                $orders[$key]['totalHarga'] += $valueItemCart['total_price'];
                $orders[$key]['totalQuantity'] += $valueItemCart['quantity'];
                $orders[$key]['menu'] = $itemMenu;
            }
        }

        return view('admin.riwayat', compact('orders'));
    }

    public function profile()
    {

        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
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

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
