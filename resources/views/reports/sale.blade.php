@extends("layouts.layout")
@section("title")
    @parent  point list
@endsection
@section("content")
    <div class="mb-5 container">
        <form action="{{route ('admin.report.saleToForm')}}" id="parametersForm" method="POST">
            @csrf
            <div class="mb-3">
                <label for="manager" class="form-label">Менеджер</label>
                <select class="form-select" id="manager" name="manager">
                    <option value="">Выберите менеджера</option>
                    @foreach($managers as $manager)
                        <option {{(isset($params["manager"]) && $params["manager"] == $manager->id) ? "selected" : ""}}  value="{{$manager->id}}">{{$manager->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="customer" class="form-label">Клиент</label>
                <select class="form-select"  id="customer" name="customer">
                    <option value="">Выберите клиента</option>
                    @foreach($customers as $customer)
                        <option {{(isset($params["customer"]) && $params["customer"] == $customer->id) ? "selected" : ""}}   value="{{$customer->id}}">{{$customer->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="scooter" class="form-label">Скутер</label>
                <select class="form-select"  id="scooter" name="scooter">
                    <option value="">Выберите скутер</option>
                    @foreach($scooters as $scooter)
                        <option {{(isset($params["scooter"]) && $params["scooter"] == $scooter->id) ? "selected" : ""}} value="{{$scooter->id}}">{{$scooter->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="point" class="form-label">Точка выдачи</label>
                <select class="form-select"  id="point" name="point">
                    <option value="">Выберите точку выдачи</option>
                    @foreach($points as $point)
                        <option  {{(isset($params["point"]) && $params["point"] == $point->id) ? "selected" : ""}} value="{{$point->id}}">{{$point->city.", ".$point->address}}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <button form="parametersForm"  type="submit" class="btn btn-primary">Сформировать отчет</button>
    </div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Покупатель</th>
                <th scope="col">Менеджер</th>
                <th scope="col">Скутер</th>
                <th scope="col">Точка выдачи</th>
                <th scope="col">Сумма</th>
                <th scope="col">Дата выдачи</th>
                <th scope="col">Дата возврата</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($rents))
                @foreach($rents as $rent)
                    <tr>
                        <th scope="row">{{$rent->id}}</th>
                        <td>{{($rent->customer) ? $rent->customer->user->name : $rent->customer_id."(информация удалена)"}}</td>
                        <td>{{($rent->manager) ? $rent->manager->user->name : $rent->manager_id."(информация удалена)"}}</td>
                        <td>{{($rent->scooter) ? $rent->scooter->name : $rent->scooter_id."(информация удалена)"}}</td>
                        <td>{{($rent->point) ? $rent->point->city.", ".$rent->point->address : $rent->point_id."(информация удалена)"}}</td>
                        <td>{{$rent->amount}}</td>
                        <td>{{$rent->date_start}}</td>
                        <td>{{$rent->date_end}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
