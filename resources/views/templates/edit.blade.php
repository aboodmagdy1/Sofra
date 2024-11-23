@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','X | Create')
{{-- Page Content  title --}}
@section('page-header',' Create X Page')

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
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="" method="">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      id="name"
                      placeholder="Enter Name"
                      :value="old('name')"
                    />
                   @error('name')
                    <span class="text-danger">{{$message}}</span>
                  @enderror
                  </div>                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                    Submit
                  </button>
                </div>
              </form>

              {{html()->form('PUT')->route('')->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->class('form-control')->placeholder('Enter Name')}}
                  @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                
            </div>
            <div class="card-footer">
              {{html()->button('Submit')->class('btn btn-primary')->type('submit')}}

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


