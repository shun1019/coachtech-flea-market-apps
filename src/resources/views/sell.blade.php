@extends('layouts.app')

@section('title', '商品の出品 - COACHTECH')

@section('content')
<div class="sell-form">
    <h1>商品の出品</h1>

    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- 商品画像 -->
        <div class="sell-form__group">
            <label for="image">商品画像</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品の詳細 -->
        <h2>商品の詳細</h2>

        <!-- カテゴリー -->
        <div class="sell-form__group">
            <label>カテゴリー</label>
            <div class="sell-category-tags">
                <span>ファッション</span>
                <span>家電</span>
                <span>インテリア</span>
                <span>レディース</span>
                <span>メンズ</span>
                <span>コスメ</span>
                <span>本</span>
                <span>ゲーム</span>
                <span>スポーツ</span>
                <span>キッチン</span>
                <span>ハンドメイド</span>
                <span>アクセサリー</span>
                <span>おもちゃ</span>
                <span>ベビー・キッズ</span>
            </div>
        </div>

        <!-- 商品の状態 -->
        <div class="sell-form__group">
            <label for="condition">商品の状態</label>
            <select id="condition" name="condition">
                <option value="">選択してください</option>
                <option value="新品">新品</option>
                <option value="中古 - ほぼ新品">中古 - ほぼ新品</option>
                <option value="中古 - 良好">中古 - 良好</option>
                <option value="中古 - 可">中古 - 可</option>
            </select>
            @error('condition')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- 商品名と説明 -->
        <h2>商品名と説明</h2>

        <div class="sell-form__group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="sell-form__group">
            <label for="description">商品の説明</label>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- 販売価格 -->
        <div class="sell-form__group">
            <label for="price">販売価格</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" required>
            @error('price')
            <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- 出品ボタン -->
        <button type="submit" class="sell-btn-submit">出品する</button>
    </form>
</div>
@endsection