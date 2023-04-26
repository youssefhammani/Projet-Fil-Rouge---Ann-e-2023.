<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\orders;
use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public  function userInfo($id)
    {
        // $info = User::where('id', $id)->first();
        $info = User::where('id','=', $id)->get();
        // dd($info);

        return view('home.profile', compact('info'));
    }

    public function addToCart($id)
    {
        $basket = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($basket as $value) {
            if ($value->product_id == $id) {
                return back()->with('succes', 'you added');
            }
        }

        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;
        $cart->save();

        return back()->with('succes', 'you added');
    }

    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors([
                'error' => 'User not authenticated',
            ]);
        }

        $buy = Cart::select('*')
            ->where('basket.user_id', $user->id)
            ->join('users', 'users.id', '=', 'basket.user_id')
            ->join('products', 'products.id', '=', 'basket.product_id')
            ->whereNull('products.deleted_at')
            ->get();

        if ($buy) {
            return view('home.buying1', compact('buy'))->with('success', 'hsdlkfj');
        } else {
            return back()->withErrors([
                'error' => 'fhdskf',
            ]);
        }
    }

    public function confirm()
    {
        return view('home.stripe');
    }

    public function Basket(Request $request)
    {
        // return view('stripe');
        // dd($request->all());
        $yha = session()->get('orders', []);
        for ($i = 0; $i <= count($request->all()); $i++) {
            $ss = $request->input('product_id' . $i);
            $ss1 = $request->input('product_qty_' . $i);
            // dd($ss1);
            // if (isset($ss1) && !empty($ss1)) {
            $order = [
                'product_id' => $ss,
                'Quantity' => $ss1,
                'user_id' => Auth::user()->id,
                'Total' => 20,
            ];
            $orders[] = $order;
            // }
        }
        // dd($orders);
        session()->put('orders', $orders);
        return view('stripe');
    }

    public function getOrders()
    {
        $info = orders::where('orders.user_id', Auth::user()->id)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->get();

        return view('home.buying', ['info' => $info]);
    }

    public function checkOut()
    {
        $info = orders::where('orders.user_id', Auth::user()->id)
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->get();

        return view('admin.users.checkout', ['info' => $info]);
    }

    public function deleteOreder($id)
    {
        $order = orders::where('product_id', $id)->first()->delete();
        // dd($order);
        if ($order) {
            return back()->with('success', 'order in deleted successfelly');
        } else {
            return back()->withErrors([
                'error' => 'is not deleted',
            ]);
        }
    }

    public function doneOreder($id)
    {
        $order = orders::where('product_id', $id)->first();

        $order->Status = 'true';
        $order->save();

        return back()->with('succes', 'Order Complete');
    }

    public static function numOfDishes()
    {
        
    }
}
