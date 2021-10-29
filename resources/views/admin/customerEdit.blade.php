@extends("layouts.layout")
@section("title")
    @parent  edit customer
@endsection
@section("content")
    <div class="container">
        <form action="{{route ('admin.customer.save')}}" id="EditCustomerForm" method="POST" class="mb-3" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$customer->id}}">
            <input type="hidden" name="user_id" value="{{$customer->user_id}}">
            <input type="hidden" name="infoChange" id="infoChange" value="">
            <div>
                <div class="mb-3 col-6">
                    <label for="name_input" class="form-label">Имя</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name_input" value="{{($customer->user) ? $customer->user->name : ''}}">
                    @if($errors->has("name"))
                        <div class="text-danger">
                            {{$errors->first("name")}}
                        </div>
                    @endif
                </div>
                <div class="mb-3 col-6">
                    <label for="email_input" class="form-label">Email</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email_input" value="{{($customer->user) ? $customer->user->email : ''}}">
                    @if($errors->has("email"))
                        <div class="text-danger">
                            {{$errors->first("email")}}
                        </div>
                    @endif
                </div>
                @if (!$itIsEdit)
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Пользователь</label>
                            <select class="form-select {{$errors->has('user_id') ? 'is-invalid' : ''}}"  id="user_id" name="user_id">
                                <option value="">Выберите пользователя</option>
                                @foreach($users as $user)
                                    <option data-bs-name="{{$user->name}}" data-bs-email="{{$user->email}}" value="{{$user->id}}">{{$user->id.", ".$user->name.", ".$user->email}}</option>
                                @endforeach
                            </select>

                        @if($errors->has("user_id"))
                            <div class="text-danger">
                                {{$errors->first("user_id")}}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </form>
        <button type="submit" form="EditCustomerForm" class="btn btn-primary">Сохранить изменения</button>
        @if ($itIsEdit)
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" data-bs-id="{{$customer->id}}" data-bs-name="{{$customer->user->name}}">Удалить</button>
        @endif
        <a href="{{route ('admin.customers')}}" class="btn btn-link link-primary">Отмена</a>
        @if ($itIsEdit)
            @include("layouts.forms.confirmDelete")
        @endif
    </div>
    <script src="/js/admin.js"></script>
@endsection
