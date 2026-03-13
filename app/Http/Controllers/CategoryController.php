<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('admin', except: ['index','store','show','update'])];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'categories' => Category::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
           'name'=>'required|string|max:255|unique:categories,name'
        ]);

        $category = Category::create($validate);

        return response()->json([
            'message'=>'new category created successfully!',
            'category'=>$category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'category' => $category
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name'=>'required|string|max:255|unique:categories,name,'.$category->id
        ]);

        $category->update($validate);

        return response()->json([
            'message'=> "the category updated successfully!",
            'category'=>$category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            "message"=>"category '{$category->name}' deleted with success!"
        ], 200);
    }
}
