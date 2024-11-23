@extends('layouts.guest')
@section('title','Login Page')


@section('css')
<link rel="stylesheet" href="{{asset('assets/css/icheck-bootstrap.min.css')}}">


@endsection

@section('body-class','hold-transition login-page')
@section('content')
 <div class="hold-transition login-page">
     <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-primary">
         <div class="card-header text-center">
             <p class="h1">Sofra Dashboard</p>
         </div>
         <div class="card-body">
                {{html()->form('POST')->route('admin.loginSubmit')->open()}}
                <div class="input-group mb-3">
                    {{html()->email('email')->class('form-control')->placeholder('Email')->required()}}
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                </div>
                @error('email')
                 {{$message}}
                @enderror

                <div class="input-group mb-3">
                    {{html()->password('password')->class('form-control')->placeholder('Password')->required()}}

                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                </div>
 
                @error('password')
                    {{$message}}
                @enderror
                <div class="row ">
                    <p class="">
                        <a href="{{route('admin.forgotPassword')}}">I forgot my password</a>
                    </p>

                        <div class="col-12">
                          <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->

                  <x-flash-success />
                    <x-flash-error />
         </div>

         <!-- /.card-body -->
         </div>
         <!-- /.card -->
     </div>
 </div>

@endsection


