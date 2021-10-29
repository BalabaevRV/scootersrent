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
                <th scope="col">Клиент</th>
                <th scope="col">Точка выдачи</th>
                <th scope="col">Скутер</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Дата выдачи</th>
                <th scope="col">Дата Возврата</th>
                <th scope="col">Статус</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($rents as $rent)
                <tr>
                    <th scope="row">{{$rent->id}}</th>
                    <td>{{$rent->customer->user->name}}</td>
                    <td>{{$rent->point->city.", ".$rent->point->address}}</td>
                    <td>{{$rent->scooter->name}}</td>
                    <td>{{$rent->amount}}</td>
                    <td>{{$rent->date_start}}</td>
                    <td>{{$rent->date_end}}</td>
                    @switch($rent->status)
                        @case(0)
                            <td>Ожидается</td>
                            @break
                        @case(1)
                            <td>Просрочен</td>
                            @break
                        @case(2)
                            <td>Оплачен</td>
                            @break
                        @default
                            <td></td>
                            @break
                    @endswitch
                    @if ($itIsEdit)
                        <td>
                            <a href="{{route ('manager.editRent', ['id' => $rent->id])}}" class="btn btn-link link-primary">Принять</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12">
            {{$rents->links()}}
        </div>
    </div>
@endsection
