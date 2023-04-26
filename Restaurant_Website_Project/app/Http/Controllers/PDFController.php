<?php

namespace App\Http\Controllers;

use PDF;
// use Stripe\Product;
use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $product = Product::find($id);

        // Check if the product exists
        if ($product) {
            // Load the view and pass the product to it
            $pdf = PDF::loadView('myPDF', ['product' => $product]);

            // Continue with the rest of your code...
        } else {
            // Handle the case when the product is not found
        }

        return $pdf->download('itsolutionstuff.pdf');
    }
}
