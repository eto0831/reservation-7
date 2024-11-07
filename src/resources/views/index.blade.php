@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
    // メッセージ機能
</div>

<div class="attendance__content">
    <form class="search-form" action="/search" method="get">
        @csrf
        <div class="contact-search">
            <select class="search-form__item-select" name="area_id">
                <option value="">All area</option>
                @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="contact-search">
            <select class="search-form__item-select" name="genre_id">
                <option value="">All genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="name-search">
            <input type="text" class="search-form__item-input" placeholder="Search..." name="keyword"
                value="{{ request('keyword') ?? old('keyword') }}">
        </div>
        {{-- <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div> --}}
    </form>
    <div class="shop__wrap">
        @foreach ($shops as $shop)
        <div class="shop__content">
            <img src="{{ asset($shop->image_url) }}" alt="{{ $shop->shop_name }}" class="shop__img">
            <h2>{{ $shop->shop_name }}</h2>
            <p>
                <span>#{{ $shop->area->area_name }}</span>
                <span>#{{ $shop->genre->genre_name }}</span>
            </p>
            <div class="shop__buttons">
                <a href="/detail/{{ $shop->id }}">詳しく見る</a>
                @if ($shop->isFavorited)
                <form action="/favorite" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <button type="submit">お気に入りから外す</button>
                </form>
                @else
                <form action="/favorite" method="POST">
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <button type="submit">お気に入り</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection