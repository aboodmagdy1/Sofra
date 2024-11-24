@extends('layouts.master')
@section('titlte','Profile Page')

@section('content')
<div class="hold-transition sidebar-mini">
  
    <section class="content">
      <div class="container-fluid">
        <x-flash-success/>
        <x-flash-error/>
        <div class="row">

          <div class="col-md-3">
            <!-- Profile Data -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                <p class="text-muted text-center">{{Auth::user()->email}}</p>
              </div>
            </div>
          </div>

          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">

              <div class="card-header p-2 text-center mt-2">
                <p class="text-bold">Settings</p>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">

                    {{html()->form('PUT')->route('admin.updateProfile')->class('form-horizontal')->open()}}
                      <div class="form-group row">
                        {{html()->label('Name')->class('col-sm-2 col-form-label')->for('name')}}
                        {{html()->text('name')->class('form-control col-sm-10')->id('name')->placeholder(Auth::user()->name)->value(Auth::user()->name) }}
                      </div>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      <div class="form-group row">
                        {{html()->label('Email')->class('col-sm-2 col-form-label')->for('email')}}
                        {{html()->email('email')->class('form-control col-sm-10')->id('email')->placeholder(Auth::user()->email)->value(Auth::user()->email) }}
                      </div>
                         @error('email')
                            <span class="text-danger">{{$message}}</span>
                         @enderror

                      <div class="form-group row">
                        {{html()->label('Password')->class('col-sm-2 col-form-label')->for('pass')}}
                        {{html()->password('password')->class('form-control col-sm-10 ')->id('pass')->placeholder('Password')}}
                      </div>
                      
                       @error('password')
                         <span class="text-danger">{{$message}}</span>
                        @enderror
                      <div class="form-group row">
                        {{html()->label('Confirm Password')->class('col-sm-2 col-form-label')->for('cPass')}}
                        {{html()->password('confirm_password')->class('form-control col-sm-10')->id('cPass')->placeholder('Confirm Password')}}
                      </div>   
                        @error('confirm_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror                 
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    {{html()->form()->close()}}
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection