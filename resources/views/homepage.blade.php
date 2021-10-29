@extends("layouts.layout")
@section("title")
    @parent  home page
@endsection
@section("content")
    @if (auth()->check() && Auth::user()->is_admin)
        @include("layouts.menus.admin")
    @elseif (auth()->check() && Auth::user()->manager)
        @include("contents.managerHome")
    @elseif (auth()->check())
        @include("contents.loginHome")
    @else
        @include("contents.noLoginHome")
    @endif
@endsection

