<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }
    // カテゴリの新規作成
    public function store(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::create($category);
        return redirect('/categories')->with('message','カテゴリを作成しました');
    }
    // カテゴリの更新
    public function update(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::find($request->id)->update($category);
        return redirect('/categories')->with('message','カテゴリを更新しました');
    }
    //カテゴリの削除
    public function delete(Request $request)
    {
        Category::find($request->category_id)->delete();
        return redirect('/categories')->with('message','カテゴリを削除しました');
    }
}
