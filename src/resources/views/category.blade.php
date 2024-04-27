@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
    <div class="category__alert">
        {{-- Category作成成功メッセージ --}}
        @if (session('message'))
            <div class="category__alert--success">
                {{ session('message') }}
            </div>
        @endif
        {{-- Category入力内容のエラー表示 --}}
        @if ($errors->any())
            <div class="category__alert--danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="category__content">
        {{-- カテゴリ作成欄 --}}
        <form action="/categories" class="create-form" method="post">
            @csrf
            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>
        </form>

        <div class="category-table">
            <table class="category-table__inner">
                <tr class="category-table__row">
                    <th class="category-table__header">category</th>
                </tr>
                @foreach ($categories as $category)
                    <tr class="category-table__row">
                        <td class="category-table__item">
                            {{-- カテゴリ更新処理 --}}
                            <form action="/categories/update" class="update-form" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="update-form__item">
                                    <input type="text" class="update-form__item-input" name="name" value="{{ $category['name'] }}">
                                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                                </div>
                                {{-- 更新ボタン --}}
                                <div class="update-form__button">
                                    <button class="update-form__button-submit"
                                        type="submit
                                    ">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="category-table__item">
                            {{-- カテゴリ削除処理 --}}
                            <form action="/categories/delete" class="delete-form" method="POST">
                                @method('DELETE')
                                @csrf
                                {{-- 削除ボタン --}}
                                <div class="delete-form__button">
                                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
@endsection
