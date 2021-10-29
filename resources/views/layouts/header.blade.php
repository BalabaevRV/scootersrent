<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="scooter rent" />
    <meta name="author" content="Balabaev" />
    <title>@section('title')ScooterRent — @show</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">
<!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav" style="{{isset($itIsRegistration) || isset($itIsLogin) ? 'padding-right: 17px;' : ''}}">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="/">Аренда самокатов</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            @if (auth()->check())
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    @if (auth()->user()->is_admin)
                        @include("layouts.menus.admin")
                    @elseif (auth()->user()->manager)
                        @include("layouts.menus.manager")
                   @elseif (auth())
                         @include("layouts.menus.customer")
                    @endif
                    <a class="btn btn-outline-primary rounded-pill ms-auto me-4 my-3 my-lg-0 btn-lg" href="{{route('login.logout')}}">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-box-arrow-in-right pe-2"></i>
                                    <span class="small">Выход</span>
                                </span>
                    </a>
                </div>
            @else
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <button class="btn btn-primary rounded-pill ms-auto me-4 my-3 my-lg-0 btn-lg" data-bs-toggle="modal" data-bs-target="#popUp">
                                <span class="d-flex align-items-center">
                                    <i class="bi bi-person-fill"></i>
                                    <span class="small">Вход/Регистрация</span>
                                </span>
                    </button>
                </div>
            @endif
        </div>
    </nav>
