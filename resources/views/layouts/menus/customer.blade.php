<ul class="navbar-nav ms-auto me-4 my-3 my-lg-0 align-items-center">
    <li class="nav-item">
        <a href="{{route ('scooterList') }}" class="btn btn-primary rounded-pill ms-auto me-4 my-3 my-lg-0 btn-lg">
            <span class="d-flex align-items-center">
                <span class="small">Выбрать скутер</span>
            </span>
        </a>
    </li>
    @if (auth()->user()->scooter)
        <li class="nav-item align-items-center">
            Вы забронировали самокат <b>{{auth()->user()->scooter->name}}</b>
        </li>
    @endif
</ul>

