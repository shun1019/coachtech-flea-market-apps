@extends('layouts.toppage-header')

@section('title', '商品詳細 - COACHTECH')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="item-detail">
    <div class="item-detail__image">
        <img src="{{ asset('storage/products/' . $item->image) }}" alt="商品画像">
        <p>商品画像</p>
    </div>
    <div class="item-detail__info">
        <h2>{{ $item->name }}</h2>
        <p class="brand">ブランド名</p>
        <p class="price">¥{{ number_format($item->price) }} <span>(税込)</span></p>
        <div class="item-detail__likes">
            <span>☆</span>
            <span>{{ $item->likes_count }}</span>
            <span>コメント {{ $item->comments_count }}</span>
        </div>
        <button class="btn-purchase">購入手続きへ</button>

        <h3>商品説明</h3>
        <p>{{ $item->description }}</p>

        <h3>商品の情報</h3>
        <p>カテゴリー: 洋服・メンズ</p>
        <p>商品の状態: 良好</p>

        <h3>コメント ({{ $comments->count() }})</h3>
        <div class="comments">
            @foreach($comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name }}</strong></p>
                <p>{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>

        <form action="{{ route('comment.store', $item->id) }}" method="POST">
            @csrf
            <textarea name="comment" rows="3" placeholder="商品へのコメント"></textarea>
            <button type="submit" class="btn-comment">コメントを送信する</button>
        </form>
    </div>
</div>
@endsection