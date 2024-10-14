@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="tab">
    <a href="#" class="active">おすすめ</a>
    <a href="#">マイリスト</a>
</div>

@endsection