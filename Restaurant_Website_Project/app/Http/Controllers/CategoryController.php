<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        // return view('categories.index', compact('categories'));

        $categories = collect(); // create an empty collection to store categories
        Category::whereNull('deleted_at')->chunk(100, function ($chunk) use ($categories) {
            $categories = $categories->concat($chunk); // append the retrieved chunk of categories to the collection
        });
        return view('admin.categories.index', ['categories' => $categories]); // pass the collection of categories to the view
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
        // $user = Auth::user();
        $category = Category::create([
            'name' => $request->input('name'),
            'user_id' => Auth::id(),
        ]);
        // $category = Category::create($request->all() + ['user_id' => $user->id]);
        
        if ($category) {
            return redirect()->route('categories.index')
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
    public function edit(category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecategoryRequest  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        $category->update($request->validated());
        
        if ($category->wasChanged()) {
            // return redirect()->back()->with('success', 'Category updated successfully');
            return redirect()->route('categories.index')
                    ->with('success', 'Category updated successfully');
        } else {
            // return redirect()->back()->with('error', 'No changes were made to the category');
            return back()->withErrors([
                'error' => 'Category not found.'
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        
        if ($category->trashed()) {
            return redirect()->route('categories.index')
                    ->with('success', 'Category soft deleted successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to soft delete category.'
            ]);
        }
    }
}
