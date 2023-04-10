<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('deleted_at')->get();
        return view('admin.categories.index', compact('categories'));

        // $categories = collect();
        // Category::whereNull('deleted_at')->chunk(100, function ($chunk) use ($categories) {
        //     $categories = $categories->concat($chunk);
        // });
        // return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        // dd($request);
        // $user = Auth::user();
        $category = Category::create([
            'category' => $request->name,
            'user_id' => Auth::id(),
        ]);
        
        if ($category) {
            return back()
                    ->with('success', 'Category created successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to create category.'
            ]);
        }
    }

    /**
     * Display the specified resource.  
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return view('categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, $id)
    {
        $category = Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();        
        if (!$category) {
            return back()->withErrors([
                'error' => 'Category not found.'
            ]);
        }
        
        $category->update([
            'category' => $request->name,
            'user_id' => Auth::id(),
        ]);
        
        if ($category->wasChanged()) {
            return redirect()->route('admin.categories.index')
                    ->with('success', 'Category updated successfully');
        } else {
            return back()->with('error', 'No changes were made to the category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->whereNull('deleted_at')->firstOrFail();
        $category->delete();
        
        if ($category->trashed()) {
            return redirect()->route('admin.categories.index')
                    ->with('success', 'Category soft deleted successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to soft delete category.'
            ]);
        }
    }
}
