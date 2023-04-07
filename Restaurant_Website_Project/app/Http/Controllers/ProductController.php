<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = collect();
        Product::chunk(100, function ($chunk) use ($products) {
            $products = $products->concat($chunk);
        });
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproductRequest $request)
    {
        $product = Product::create($request->except('image_url') + ['user_id' => Auth::id()]);
        
        if ($request->hasFile('image')) {
            // upload the new image
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $filename);
            $product->image = $filename;
            
            // update the image URL
            $product->image_url = asset('uploads/products/' . $filename);
        }
        
        if ($product->save()) {
            return redirect()->route('products.index')
                    ->with('success', 'Product created successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to create product.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproductRequest $request, product $product)
    {
        $product->update($request->except('image_url'));
        
        if ($request->hasFile('image')) {
            
            // if a new image was uploaded, delete the old one first
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            // upload the new image
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $filename);
            $product->image = $filename;

            // $product->image_url = asset('uploads/products/' . $filename);
        } 
        
        elseif ($request->has('remove_image')) {
            // if remove image checkbox was checked, delete the old image
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                unlink(public_path('uploads/products/' . $product->image));
            }
            
            $product->image = null;
        }
        
        if ($product->save()) {
            return redirect()->route('products.index')
                    ->with('success', 'Product updated successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to update product.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
