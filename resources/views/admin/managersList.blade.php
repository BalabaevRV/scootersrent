@extends("layouts.layout")
@section("title")
    @parent  managers list
@endsection
@section("content")
    <a href="{{route ('admin.managers.new')}}" class="btn btn-primary">Создать менеджера</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">id пользователя</th>
            <th scope="col">Имя</th>
            <th scope="col">email</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($managers as $manager)
            <tr>
                <td scope="row">{{$manager->id}}</td>
                <td>{{$manager->user_id}}</td>
                <td>{{$manager->user->name}}</td>
                <td>{{$manager->user->email}}</td>
                <td>
                    <a href="{{route ('admin.managers.edit', ['id' => $manager->id])}}" class="btn btn-link link-primary">Редактировать</a>
                    <button class="btn btn-link link-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$manager->id}}" data-bs-name="{{$manager->id}}">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-12">
        {{$managers->links()}}
    </div>
    @include("layouts.forms.confirmDelete")
@endsection







