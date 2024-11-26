@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Index Page')
{{-- Page Content  title --}}
@section('page-header','Commission Records')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">
              <a class="btn btn-primary" href={{route('admin.commisions.create')}}> Add Commission</a>
            </h3>
            <div class="d-flex align-items-center justify-content-between">

              {{-- Filter --}}
              {{ html()->form('GET')->route('admin.commisions.index')->open() }}
              <div class="d-flex ">
                  {{ html()->number('filters[restaurant_id]')->class('form-control mr-2')->placeholder('Restaurant ID') }}
                  {{ html()->number('filters[amount]')->class('form-control mr-2')->placeholder('amount') }}
                {{ html()->button('Filter')->type('submit')->class('btn btn-primary') }}
              </div>
              {{ html()->form()->close() }}

              {{-- Reset --}}
              {{ html()->form('GET')->route('admin.commisions.index')->open() }}
                {{ html()->button('Reset')->type('submit')->class('btn btn-success  ml-1') }}
              {{ html()->form()->close() }}
          </div>
          </div>
          <x-flash-success/>
          <x-flash-error/>

          <!-- /.card-header -->
          <div class="card-body">
           @if($records->count()>0)
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th>Restaurant Name</th>
                        <th>Amount</th>
                        <th>Details</th>
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->restaurant->name}}</td>
                        <td>{{$record->amount}}</td>  
                        <td>{{$record->details}}</td>
                        <td class='d-flex gap-4'>
                          <a  href="{{route('admin.commisions.edit',$record->id)}}" class="btn btn-info mr-2">Edit</a>
                        {{html()->form('DELETE')->route('admin.commisions.destroy',$record->id)->open()}}
                        {{html()->button('Delete')->class('btn btn-danger')->type('submit')}}


                        {{html()->form()->close()}}
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                </table>
                <div class="card-footer d-flex justify-content-center">
                  {{ $records->links('pagination::bootstrap-4') }}
              </div>
            
          @else
          <div class="text-bold text-center" role="alert">
            No records found
          </div>

           @endif
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')

@stop