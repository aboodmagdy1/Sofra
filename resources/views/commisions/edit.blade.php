@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Commision | Edit')
{{-- Page Content  title --}}
@section('page-header',' Edit Commision ')

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


              {{html()->form('PUT')->route('admin.commisions.update',$record->id)->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Restaurant ID')->for('restaurant_id')}}
                  {{html()->number('restaurant_id')->class('form-control')->placeholder('Enter Restaurant ID')->value($record->restaurant_id)}}
                  @error('restaurant_id')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                  {{html()->label('Amount')->for('amount')}}
                  {{html()->number('amount')->class('form-control')->placeholder('Enter Amount')->value($record->amount)}}
                  @error('amount')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                  {{html()->label('Details')->for('details')}}
                  {{html()->text('details')->class('form-control')->placeholder('Enter Details')->value($record->details)}}
                  @error('details')
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


