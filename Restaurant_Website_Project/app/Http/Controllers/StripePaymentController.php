<?php
    
namespace App\Http\Controllers;

use App\Models\Cart;
use Stripe;
use Session;
use App\Models\orders;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        // dd($request);
        // dd();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = \Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
            if (!$charge) {
                return redirect()->back();
            } else {
                $orders = session()->get('orders');
                foreach ($orders as $order) {
                    if(isset($order['Quantity']) && !empty($order['product_id'])) {
                    $order1 = new orders;
                    $order1->Quantity = $order['Quantity'];
                    $order1->product_id = $order['product_id'];
                    $order1->user_id = Auth::user()->id;
                    $order1->Total = 20;
                    $order1->save();
                    // $test = product::select('Quantity')->where('id', $order['product_id'])->get();
                    // dd($test);
                    // $product = product::find($order['product_id']);
                    // if ($product) {
                    //     $product->Quantity -= intval($order['Quantity']);
                    //     $product->save();
                    // }
                    }
                    $Product = Cart::where('product_id', $order['product_id'])
                        ->where('user_id', Auth::user()->id)
                        ->first();
                    if ($Product) {
                        $Product->delete();
                    }
                }
            }

            // dd($info);
            return view('oui');
        } catch (CardException $e) {
            // Handle card errors
            Session::flash('error', $e->getError()->message);
        } catch (Exception $e) {
            // Handle other errors
            Session::flash('error', 'An error occurred while processing your payment.');
        }

        return back();
    }
}