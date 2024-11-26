@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Index Page')
{{-- Page Content  title --}}
@section('page-header','Contacts Records')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-between">

              {{-- Filter --}}
              {{ html()->form('GET')->route('admin.contacts.index')->open() }}
              <div class="d-flex ">
                  {{html()->select('type',
                  [
                    'complaint'=>"Complaint" 
                    ,'suggestion'=>"Suggestion"
                    ,'query'=>"Query"
                ],request()->input('type'),['class'=>'form-control mr-2 p-2'])}}
                  

                {{ html()->button('Filter By Type ')->type('submit')->class('btn btn-primary') }}
              </div>
              {{ html()->form()->close() }}

              {{-- Reset --}}
              {{ html()->form('GET')->route('admin.contacts.index')->open() }}
                {{ html()->button('Reset')->type('submit')->class('btn btn-success  ml-1') }}
              {{ html()->form()->close() }}
     
          </div>
          <div class="d-block ml-2">
                @error('type')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
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
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Message </th>
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->full_name}}</td>
                        <td>{{$record->email}}</td>  
                        <td>{{$record->phone}}</td>
                        <td>{{$record->type}}</td>
                        <td>{{$record->message}}</td>  
                        <td class='d-flex gap-4'>
                        {{html()->form('DELETE')->route('admin.contacts.destroy',$record->id)->open()}}
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