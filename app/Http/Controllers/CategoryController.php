<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $categories;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        return Category::create($request->all());
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $category->update($request->all());

        return $category;
    }

    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
