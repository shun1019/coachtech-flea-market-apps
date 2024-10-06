@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="register-form mt-5">
        <h2 class="text-center">商品登録</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 商品名 -->
            <div class="form-group">
                <label class="form-label" for="name">商品名 <span class="required">必須</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="商品名を入力">
                @error('name')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- 価格 -->
            <div class="form-group">
                <label class="form-label" for="price">値段 <span class="required">必須</span></label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="価格を入力">
                @error('price')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- 商品画像 -->
            <div class="form-group">
                <label class="form-label" for="image">商品画像 <span class="required">必須</span></label>
                <input type="file" name="image" id="image" class="form-control-file">
                @error('image')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- 季節 -->
            <div class="form-group">
                <label class="form-label">季節 <span class="required">必須</span> <small class="select-season__label">複数選択可</small></label>
                <div class="season-checkboxes">
                    @foreach($seasons as $season)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="season[]" id="season_{{ $season->id }}" value="{{ $season->id }}" {{ is_array(old('season')) && in_array($season->id, old('season')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="season_{{ $season->id }}">{{ $season->name }}</label>
                    </div>
                    @endforeach
                </div>
                @error('season')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- 商品説明 -->
            <div class="form-group">
                <label class="form-label" for="description">商品説明 <span class="required">必須</span></label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="form-group__btn">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-warning">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection