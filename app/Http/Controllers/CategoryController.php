<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories->load("products"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::create($request->all());

        activity("Create", "Category :name created.", [
            ":name" => $category->name
        ]);

        return response()->json($category);
    }

    public function show(Category $category)
    {
        activity("Read", "Category :name read.", [
            ":name" => $category->name
        ]);

        return response()->json($category->load("products"));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $category->update($request->all());

        activity("Update", "Category :name updated.", [
            ":name" => $category->name
        ]);

        return response()->json($category);
    }

    public function destroy(Category $category)
    {

        activity("Delete", "Category :name deleted.", [
            ":name" => $category->name
        ]);

        return response()->json($category->delete());
    }
}
