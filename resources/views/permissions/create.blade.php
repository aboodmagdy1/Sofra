@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Permission | Create')
{{-- Page Content  title --}}
@section('page-header',' Create  Permission Page')

@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                    <x-flash-error/>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{html()->form('POST')->route('admin.permissions.store')->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->class('form-control')->placeholder('Enter Name')}}
                  @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                  {{html()->label('Display Name')->for('display')}}
                  {{html()->text('display_name')->class('form-control')->placeholder('Enter Display Name')}}
                  @error('display_name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
            </div>
            <div class="card-footer">
              {{html()->button('Submit')->class('btn btn-primary')->type('submit')}}
            </div>
            {{html()->form()->close()}}
            </div>
            
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6"></div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection


