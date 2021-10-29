@extends("layouts.layout")
@section("title")
    @parent  point edit
@endsection
@section("content")
    <div class="container">
        <form action="{{route ('admin.point.save')}}" id="EditPointForm" method="POST" class="mb-3" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$point->id}}">
            <div>
                <div class="mb-3 col-6">
                    <label for="cityPoint" class="form-label">Город</label>
                    <input type="text" class="form-control {{$errors->has('city') ? 'is-invalid' : ''}}" name="city" id="cityPoint" value="{{$point->city}}">
                    @if($errors->has("city"))
                        <div class="text-danger">
                            {{$errors->first("city")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3 col-6">
                    <label for="addressPoint" class="form-label">Улица</label>
                    <input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" name="address" id="addressPoint" value="{{$point->address}}">
                    @if($errors->has("address"))
                        <div class="text-danger">
                            {{$errors->first("address")}}
                        </div>
                    @endif
                </div>
            </div>
        </form>
        @if ($itIsEdit)
            <div>
                <button id="btnListScooter" class="{{($point->scooters_count>0) ? 'btn-lg' : ''}} btn btn-link mb-3">На точке находится {{$point->scooters_count}}</button>
                <ul style="display: none" id="ulListScooter">
                    @foreach($scooters as $scooter)
                        <li>{{$scooter->name}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" form="EditPointForm" class="btn btn-primary">Сохранить изменения</button>
        @if ($itIsEdit)
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$point->id}}" data-bs-name="{{$point->city . $point->address}}">Удалить</button>
        @endif
        <a href="{{route ('admin.points')}}" class="btn btn-link link-primary">Отмена</a>
        @if ($itIsEdit)
            @include("layouts.forms.confirmDelete")
        @endif
    </div>
    <script src="/js/admin.js"></script>
@endsection
