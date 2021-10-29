<div class="modal-body form-collapse collapse {{old('itIsRegistration') ? '' : 'show'}}" id="bodyLogin">
    <form action="{{route ('login.login')}}" method="POST" id="formLogin">
        @csrf
        <div class="mb-3">
            <label for="loginEmail" class="col-form-label">Логин</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control {{$errors->has('email') && old('itIsLogin')  ? 'is-invalid' : ''}}" id="loginEmail" name="email" placeholder="email@example.com"  value="{{old('email') && old('itIsLogin')  ? old('email') : ''}}">
            </div>
            @if(old("itIsLogin") && $errors->has("email"))
                <div class="text-danger">
                    {{$errors->first("email")}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control {{$errors->has('password') && old('itIsLogin')  ? 'is-invalid' : ''}}" id="loginPassword" name="password" autocomplete="off">
            </div>
            @if(old("itIsLogin") && $errors->has("password"))
                <div class="text-danger">
                    {{$errors->first("password")}}
                </div>
            @endif
        </div>
        <input type="hidden" name="itIsLogin" value="true">
    </form>
    <div class="modal-footer justify-content-start">
        <button type="submit"  class="btn btn-primary rounded-pill btn-lg" form="formLogin">
            <span class="d-flex align-items-center">
                <span class="small">Войти</span>
            </span>
        </button>
        <hr>
        <p>Еще нет аккаунта? <button class="btn btn-link"  data-bs-toggle="collapse" data-bs-target=".form-collapse" aria-expanded="false" aria-controls="bodyLogin bodyRegistration">Зарегистрироваться</button></p>
    </div>
</div>
