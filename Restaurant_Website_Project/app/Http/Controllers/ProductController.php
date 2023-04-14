<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Support\Facades\DB;
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
        $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->selectRaw('products.*, categories.category, users.name as user_name')
        ->whereNull('products.deleted_at')
        ->get();
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function getProducts()
    {
        // $products = $this->index();
        // $categories = $this->create();
        $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->selectRaw('products.*, categories.category, users.name as user_name')
        ->whereNull('products.deleted_at')
        ->get();

        $dataCategories = Category::all();

        return view('home.menu', ['Product_R' => $products, 'categories' => $dataCategories]);
    }

    public function buying($id)
    {
        $buy = product::where('id', $id)->whereNull('deleted_at')->first();

        return view('home.buying', ['buy' => $buy]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproductRequest $request)
    {
        $product = new Product($request->only(['name', 'description', 'price']));
        $product->category_id = $request->input('category'); // set the category_id attribute
        $product->user_id = Auth::id();
           
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images/products/'), $filename);
            // $product->setAttribute('image_url', asset('uploads/images/products/' . $filename));
            $product->image_url = $filename;
        } else {
            // get the default value from the $attributes array
            $defaultImageUrl = $product->getAttributes()['image_url'];
            $product->image_url = $defaultImageUrl;
        }

        if ($product->save()) {
            return redirect()->route('admin.products.index')
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
    public function edit($id)
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->selectRaw('products.*, categories.category')
        ->whereNull('products.deleted_at')
        ->find($id);

        $categories = Category::pluck('category', 'id')->all();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproductRequest $request, $id)
    {
        $product = Product::where('id', $id)->whereNull('deleted_at')->first();
        if (!$product) {
            return back()->withErrors([
                'error' => 'Product not found or has been deleted.'
            ]);
        }

        $product->fill($request->only(['name', 'description', 'price', 'category']));
        $product->user_id = Auth::id();

        if ($request->hasFile('image')) {
            // if a new image was uploaded, delete the old one first
            if ($product->image_url && file_exists(public_path('uploads/images/products/' . $product->image_url))) {
                unlink(public_path('uploads/images/products/' . $product->image));
            }
            // upload the new image
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images/products'), $filename);
            $product->image_url = $filename;

            // $product->image_url = asset('uploads/images/products/' . $filename);
        } else {
            $defaultImageUrl = $product->getAttributes()['image_url'];
            $product->image_url = $defaultImageUrl;
        }

        if ($product->update()) {
            return redirect()->route('admin.products.index')
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
    public function destroy($id)
    {
        $product = Product::where('id', $id)->whereNull('deleted_at')->first();
        $product->delete();
        
        if ($product->trashed()) {
            return redirect()->route('admin.products.index')
                    ->with('success', 'Product deleted successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Product not found or already deleted.'
            ]);
        }
    }
}
