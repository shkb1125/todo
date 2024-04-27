<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        // Todoモデルから取ってきた値を$todosに詰めてindex.blade.phpに渡す
        // return view('index', compact('todos'));
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['category_id', 'content']);
        // Todoモデルからcreateメソッドを呼びインスタンスの作成 → 属性(取り出したcontentの値を持つ$todo)の代入 → データの保存
        Todo::create($todo);
        // 元の画面にリダイレクトで表示させる
        // return redirect('/');
        // 元の画面にリダイレクトしてメッセージを表示させる
        return redirect('/')->with('message', 'Todoを作成しました');
    }
    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->todo_id)->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }
    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
