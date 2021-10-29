@extends("layouts.layout")
@section("title")
    @parent  scooters list
@endsection
@section("content")
    <a href="{{route ('admin.scooters.new')}}" class="btn btn-primary">Создать скутер</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">Описание</th>
                <th scope="col">Точка выдачи</th>
                <th scope="col">Цена</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($scooters as $scooter)
                    <tr>
                        <th scope="row">{{$scooter->id}}</th>
                        <td>{{$scooter->name}}</td>
                        <td>{{$scooter->description}}</td>
                        @if ($scooter->point)
                            <td>{{$scooter->point->city.', '.$scooter->point->address}}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{$scooter->price}}</td>
                        <td>
                            <a href="{{route ('admin.scooters.edit', ['id' => $scooter->id])}}" class="btn btn-link link-primary">Редактировать</a>
                            <button class="btn btn-link link-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$scooter->id}}" data-bs-name="{{$scooter->name}}">Удалить</button>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12">
            {{$scooters->links()}}
        </div>
        @include("layouts.forms.confirmDelete")
@endsection







