<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

    public function addToCart($id)
    {
        // $buy = product::where('id', $id)->whereNull('deleted_at')->first();
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;
        $cart->save();

        return redirect()->back();
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
        $orders = session()->get('orders', []);
        for($i = 0; $i <= count($request->all()); $i++)
        {
            $ss = $request->input('product_id'.$i);
            $ss1 = $request->input('product_qty_'.$i);
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
}
