@extends("layouts.layout")
@section("title")
    @parent  rents list
@endsection
@section("content")
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Скутер</th>
                <th scope="col">Точка выдачи</th>
                <th scope="col">Клиент</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($scooters as $scooter)
                    <tr>
                        <th scope="row">{{$scooter->id}}</th>
                        <td>{{$scooter->name}}</td>
                        <td>{{$scooter->point->city.", ".$scooter->point->address}}</td>
                        <td>{{$scooter->user->name}}</td>
                        <td>
                            <a href="{{route ('manager.createRentByBooking', ['id' => $scooter->id, 'user' => $scooter->customerBook])}}" class="btn btn-link link-primary">Cоздать выдачу</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
