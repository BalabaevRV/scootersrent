@extends("layouts.layout")
@section("title")
    @parent  customers list
@endsection
@section("content")
    <a href="{{route ('admin.customers.new')}}" class="btn btn-primary">Создать пользователя</a>
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
        @foreach($customers as $customer)
            <tr>
                <td scope="row">{{$customer->id}}</td>
                <td>{{$customer->user_id}}</td>
                <td>{{$customer->user->name}}</td>
                <td>{{$customer->user->email}}</td>
                <td>
                    <a href="{{route ('admin.customers.edit', ['id' => $customer->id])}}" class="btn btn-link link-primary">Редактировать</a>
                    <button class="btn btn-link link-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$customer->id}}" data-bs-name="{{$customer->id}}">Удалить</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col-12">
        {{$customers->links()}}
    </div>
    @include("layouts.forms.confirmDelete")
@endsection







