@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Method | Edit')
{{-- Page Content  title --}}
@section('page-header',' Edit Method ')

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
                  
                </h3>
              </div>


              {{html()->form('PUT')->route('admin.permissions.update',$record->id)->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->class('form-control')->placeholder('Enter Name')->value($record->name)}}
                  @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                  {{html()->label('Display Name')->for('name')}}
                  {{html()->text('display_name')->class('form-control')->placeholder('Enter Display Name')->value($record->display_name)}}
                  @error('display_name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                
            </div>
            <div class="card-footer">
              {{html()->button('Update')->class('btn btn-primary')->type('submit')}}

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


