@extends("layouts.layout")
@section("title")
    @parent  rent
@endsection
@section("content")

    <form action="{{route ('manager.SaveRent', ['id' => (isset($rent)) ? $rent->id : null])}}" id="dataRent" method="POST">
        @csrf
        <input type="hidden" id="manager_id" name="manager_id" value="{{auth()->user()->manager->id}}">
        <div class="mb-3">
            <label for="scooter_id" class="form-label">Скутер</label>
            <select class="form-select {{$errors->has('scooter_id') ? 'is-invalid' : ''}}"   id="scooter_id" name="scooter_id">
                @if (isset($rent))
                    <option  selected value="{{$rent->scooter_id}}">{{$rent->scooter->name}}</option>
               @elseif (isset($scooter))
                    <option  selected value="{{$scooter->id}}">{{$scooter->name}}</option>
                @else
                <option value="">Выберите скутер</option>
                @foreach($scooters as $scooter)
                    <option {{(old("scooter_id") == $scooter->id) ? "selected" : ""}}  value="{{$scooter->id}}">{{$scooter->name}}</option>
                @endforeach
                @endif
            </select>
            @if($errors->has("scooter_id"))
                <div class="text-danger">
                    {{$errors->first("scooter_id")}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="point_id" class="form-label">Точка выдачи</label>
            <select class="form-select {{$errors->has('point_id') ? 'is-invalid' : ''}}"  id="point_id" name="point_id">
                @if (isset($rent))
                    <option  selected value="{{$rent->point_id}}">{{$rent->point->city.", ".$rent->point->address}}</option>
                @else
                    <option value="">Выберите точку выдачи</option>
                    @foreach($points as $point)
                        <option  {{(old("point_id") == $point->id) ? "selected" : ""}}  value="{{$point->id}}">{{$point->city.", ".$point->address}}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->has("point_id"))
                <div class="text-danger">
                    {{$errors->first("point_id")}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="customer_id" class="form-label">Клиент</label>
            <select class="form-select {{$errors->has('customer_id') ? 'is-invalid' : ''}}"  id="customer_id" name="customer_id">
                @if (isset($rent))
                    <option  selected value="{{$rent->customer_id}}">{{$rent->customer->user->name}}</option>
                @elseif (isset($customer))
                        <option  selected value="{{$customer->id}}">{{$customer->name}}</option>
                @else
                    <option value="">Выберите клиента</option>
                    @foreach($customers as $customer)
                        <option {{(old("customer_id") == $customer->id) ? "selected" : ""}}   value="{{$customer->id}}">{{$customer->user->name}}</option>
                    @endforeach
                @endif
            </select>
            @if($errors->has("customer_id"))
                <div class="text-danger">
                    {{$errors->first("customer_id")}}
                </div>
            @endif
        </div>
        <div class="mb-3 col-6">
            <label for="document" class="form-label">Залоговые данные</label>
            <input type="text" class="form-control {{$errors->has('document') ? 'is-invalid' : ''}}" name="document" id="document" value="{{(isset($rent)) ? $rent->document : ((old('document')) ? old('document') : '') }}" {{isset($rent) ? "readonly" : ""}}>
            @if($errors->has("document"))
                <div class="text-danger">
                    {{$errors->first("document")}}
                </div>
            @endif
        </div>
        <div class="mb-3 col-2">
            <label for="amount" class="form-label">Стоимость</label>
            <input type="number" class="form-control {{$errors->has('amount') ? 'is-invalid' : ''}}" name="amount" id="amount" value="{{(isset($rent)) ? $rent->amount : ((old('amount')) ? old('amount') : '') }}" step="any" {{isset($rent) ? "readonly" : ""}}>
            @if($errors->has("amount"))
                <div class="text-danger">
                    {{$errors->first("amount")}}
                </div>
            @endif
        </div>
        <div class="mb-3 col-2">
            <label for="date_end" class="form-label">Дата возврата</label>
            <input type="date" class="form-control {{$errors->has('date_end') ? 'is-invalid' : ''}}" name="date_end" id="date_end" value="{{(isset($rent)) ? $rent->date_end : ((old('date_end')) ? old('date_end') : '') }}" {{isset($rent) ? "readonly" : ""}}>
            @if($errors->has("date_end"))
                <div class="text-danger">
                    {{$errors->first("date_end")}}
                </div>
            @endif
        </div>
        @if (isset($itIsEdit))
        <div class="mb-3 col-2">
            <label for="date_end" class="form-label">Статус</label>
            <select class="form-select {{$errors->has('customer_id') ? 'is-invalid' : ''}}"  id="status" name="status">
                <option {{ ($rent->status == 0) ? "selected" : ""}} value="0">Ожидает оплаты</option>
                <option {{ ($rent->status == 1) ? "selected" : ""}} value="1">Просрочен</option>
                <option {{ ($rent->status == 2) ? "selected" : ""}} value="2">Закрыт</option>
            </select>
        </div>
        @endif
    </form>
    <button class="btn btn-lg btn-primary" form="dataRent" type="submit">Сохранить</button>
    <a class="btn btn-lg btn-primary" href="/">Отмена</a>
@endsection

