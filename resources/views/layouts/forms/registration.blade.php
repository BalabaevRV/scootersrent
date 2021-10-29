<div class="modal-body form-collapse collapse {{old('itIsRegistration') ? 'show' : ''}}" id="bodyRegistration">
    <form action="{{route ('registration.store')}}" method="POST" id="formRegistration">
        @csrf
        <div class="mb-3">
            <label for="registrationName" class="col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control {{old('itIsRegistration') && $errors->has('name') ? 'is-invalid' : ''}}" id="registrationName" name="name" placeholder="Ваше имя" value="{{old('name') && old('itIsRegistration') ? old('name') : ''}}">
            </div>
            @if(old('itIsRegistration') && $errors->has('name'))
                <div class="text-danger">
                    {{$errors->first("name")}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="registrationEmail" class="col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control {{old('itIsRegistration') && $errors->has('email') ? 'is-invalid' : ''}}" id="registrationEmail" name="email" placeholder="email@example.com"  value="{{old('email') && old('itIsRegistration')  ? old('email') : ''}}">
            </div>
            @if(old('itIsRegistration') && $errors->has('email'))
                <div class="text-danger">
                    {{$errors->first("email")}}
                </div>
            @endif
            <p class="">Будет использоваться в качестве логина</p>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control {{old('itIsRegistration') && $errors->has('password')  ? 'is-invalid' : ''}}" id="registrationPassword" name="password" autocomplete="off">
            </div>
            @if(old('itIsRegistration') && $errors->has("password"))
                <div class="text-danger">
                    {{$errors->first("password")}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="col-form-label">Потвердите пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="registrationPassword_confirmation" name="password_confirmation" autocomplete="off">
            </div>
        </div>
        <input type="hidden" name="itIsRegistration" value="true">
    </form>
    <div class="modal-footer justify-content-start">
        <button type="submit" class="btn btn-primary rounded-pill btn-lg" form="formRegistration">
            <span class="d-flex align-items-center">
                <span class="small">Зарегистрироваться</span>
            </span>
        </button>
        <hr>
        <p>Уже есть аккаунт? <button class="btn btn-link"  data-bs-toggle="collapse" data-bs-target=".form-collapse" aria-expanded="false" aria-controls="bodyLogin bodyRegistration">Войти</button></p>
    </div>
</div>
