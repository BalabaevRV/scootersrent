@extends("layouts.layout")
@section("title")
    @parent  scooters list
@endsection
@section("content")
        <div class="container">
            <form class="mb-2" action="{{route ('scootersByPoint')}}" id="pointForm" method="POST">
                @csrf
                <label for="point_id" class="form-label">Точка выдачи</label>
                <select class="form-select" aria-label="Выбор точки выдачи" id="point_id" name="point_id">
                        <option value="">Выберите точку выдачи</option>
                    @foreach($points as $point)
                        <option value="{{$point->id}}">{{$point->city.", ".$point->address}}</option>
                    @endforeach
                </select>
            </form>
            <button type="submit" type="submit" form="pointForm" class="btn btn-primary">Показать</button>
        </div>
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
                            <a href="{{route ('scooterToBook', ['id' => $scooter->id])}}" class="btn btn-sm btn-primary">Забронировать</a></button>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12">
            {{$scooters->links()}}
        </div>
@endsection







