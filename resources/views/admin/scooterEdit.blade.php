@extends("layouts.layout")
@section("title")
    @parent  scooter edit
@endsection
@section("content")
    <div class="container">
        <form action="{{route ('admin.scooters.save')}}" id="EditScooterForm" method="POST" class="mb-3" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$scooter->id}}">
            <div>
                <div class="mb-3 col-6">
                    <label for="nameScooter" class="form-label">Имя</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" id="nameScooter" value="{{$scooter->name}}">
                    @if($errors->has("name"))
                        <div class="text-danger">
                            {{$errors->first("name")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="descriptionScooter" class="form-label">Описание</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" name="description" id="descriptionScooter" rows="3">{{$scooter->description}}</textarea>
                    @if($errors->has("description"))
                        <div class="text-danger">
                            {{$errors->first("description")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3 col-2">
                    <label for="priceScooter" class="form-label">Цена</label>
                    <input type="number" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" name="price" id="priceScooter" value="{{$scooter->price}}" step="any">
                    @if($errors->has("price"))
                        <div class="text-danger">
                            {{$errors->first("price")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="point_id" class="form-label">Точка выдачи</label>
                    <select class="form-select {{$errors->has('point_id') ? 'is-invalid' : ''}}" aria-label="Default select example" id="point_id" name="point_id">
                        @if ($scooter->id == "")
                            <option value="">Выберите точку выдачи</option>
                        @endif
                        @foreach($points as $point)
                            <option value="{{$point->id}}" @if($point->id == $scooter->id) selected @endif>{{$point->city.", ".$point->address}}</option>
                        @endforeach
                    </select>
                    @if($errors->has("point_id"))
                        <div class="text-danger">
                            {{$errors->first("point_id")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    @if($scooter->img)
                        <img src="{{asset('storage/'.$scooter->img)}}" class="img-thumbnail" alt="{{$scooter->name}}" width="200" height="200">
                    @endif
                    <label for="formFile" class="form-label">Изображение скутера</label>
                    <input class="form-control {{$errors->has('img') ? 'is-invalid' : ''}}" type="file" name="img" id="formFile">
                    @if($errors->has("img"))
                        <div class="text-danger">
                            {{$errors->first("img")}}
                        </div>
                    @endif
                </div>
            </div>
        </form>
        <button type="submit" form="EditScooterForm" class="btn btn-primary">Сохранить изменения</button>
        @if ($itIsEdit)
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$scooter->id}}" data-bs-name="{{$scooter->name}}">Удалить</button>
        @endif
        <a href="{{route ('admin.scooters')}}" class="btn btn-link link-primary">Отмена</a>
        @if ($itIsEdit)
            @include("layouts.forms.confirmDelete")
        @endif
    </div>
@endsection
