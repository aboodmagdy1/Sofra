@extends('layouts.guest')
@section('title','Forgot Password | Page')

@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <p class="h1"> Sofra Dashboard</p>

          </div>
          <div class="card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily reset it.</p>
            {{html()->form('POST')->route('admin.submitResetPassword')->open()}}
            <div class="input-group mb-3">
                {{html()->email('email')->class('form-control')->placeholder('Email')->required()}}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('email')
              <div class=" mb-2 text-red">{{ $message }}</div>
              @enderror

              <div class="input-group mb-3">
                {{html()->number('reset_code')->class('form-control')->placeholder('Reset Code')->required()}}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-code"></span>
                  </div>
                </div>
            </div>
            @error('reset_code')
            <div class=" mb-2 text-red">{{ $message }}</div>
            @enderror

            <div class="input-group mb-3">
              {{html()->password('password')->class('form-control')->placeholder('New Password')->required()}}
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
          </div>
          @error('password')
          <div class=" mb-2 text-red">{{ $message }}</div>
          @enderror

          <div class="input-group mb-3">
            {{html()->password('password_confirmation')->class('form-control')->placeholder('Password Confirmation')->required()}}
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
        </div>
        @error('password_confirmation')
        <div class=" mb-2 text-red">{{ $message }}</div>
        @enderror

            <x-flash-success/>
            <x-flash-error/>
            <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                </div>
                <!-- /.col -->
            </div>
            {{html()->form()->close()}}
            <p class="mt-3 mb-1">
              <a href="{{route('admin.login')}}">Login</a>
            </p>
              
            
          </div>
          <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection 