@extends("layouts.layout")
@section("title")
    @parent  point list
@endsection
@section("content")
    <a href="{{route ('admin.point.new')}}" class="btn btn-primary">Создать точку выдачи</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Город</th>
            <th scope="col">Адрес</th>
            <th scope="col">Скутеров на точке</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($points as $point)
            <tr>
                <th scope="row">{{$point->id}}</th>
                <td>{{$point->city}}</td>
                <td>{{$point->address}}</td>
                <td>{{$point->scooters_count}}</td>
                <td>
                    <a href="{{route ('admin.point.edit', ['id' => $point->id])}}" class="btn btn-link link-primary">Редактировать</a>
                    <button class="btn btn-link link-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$point->id}}" data-bs-name="{{$point->city.', '.$point->address}}">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-12">
        {{$points->links()}}
    </div>
    @include("layouts.forms.confirmDelete")
@endsection
