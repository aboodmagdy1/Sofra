@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Settings | Edit')
{{-- Page Content  title --}}
@section('page-header',' Edit Settings ')

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
                    <x-flash-success/>
                    <x-flash-error/>
                </h3>
              </div>


              {{html()->form('PUT')->route('admin.updateSettings')->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('About')->for('name')}}
                  {{html()->text('about')->class('form-control')->placeholder('Enter About app')->value($record->about)}}
                  @error('about')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                  {{html()->label('Commission %')->for('com')}}
                  {{ html()->number('commission')
                  ->name('commission')
                  ->class('form-control')
                  ->placeholder('Enter Commission in %')
                  ->id('com')
                  ->value($record->commission) }}               
                     @error('commission')
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


