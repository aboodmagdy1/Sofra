@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Index Page')
{{-- Page Content  title --}}
@section('page-header','User  Records')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3 class="card-title ">
              <a class="btn btn-primary" href={{route('admin.users.create')}}> Create User</a>
            </h3>
            <div class="d-flex align-items-center justify-content-between">

              
              {{ html()->form('GET')->route('admin.users.index')->open() }}
                <div class="d-flex ">
                  {{-- Search  --}}
                    {{ html()->text('filters[email]')
                    ->class('form-control mr-2')->placeholder('User  Email') ->value(request()->input('filters.email'))}}
                    {{ html()->button('Filter')->type('submit')->class('btn btn-primary') }}
                </div>
              {{ html()->form()->close() }}

              {{-- Reset --}}
              {{ html()->form('GET')->route('admin.restaurants.index')->open() }}
                {{ html()->button('Reset')->type('submit')->class('btn btn-success  ml-1') }}
              {{ html()->form()->close() }}
     
          </div>
          <div class="d-block ml-2">
                @error('restaurant_name')
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role </th>
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      @if ($record->id == Auth::user()->id)
                      
                      @continue
                      @else 
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>
                          @foreach ($record->roles as $role )
                          <span class="badge badge-info">{{$role->name}}</span> 
                        @endforeach
                        </td>
                        <td class='d-flex gap-4'>
                          {{html()->a()->href(route('admin.users.edit',$record->id))->class('btn btn-info')->text('Edit')}}
                          {{-- active  --}}
                          {{html()->form('PUT')->route('admin.users.update',$record->id)->open()}}
                          @if($record->is_active)
                          {{html()->button('Deactivate')->class('btn btn-warning')->type('submit')}}
                          {{html()->hidden('is_active',0)}}
                          @else
                          {{html()->button('Activate')->class('btn btn-success')->type('submit')}}
                          {{html()->hidden('is_active',1)}}
                          @endif

                          {{html()->form()->close()}}
                          {{-- Delete --}}
                        {{html()->form('DELETE')->route('admin.users.destroy',$record->id)->open()}}
                        {{html()->button('Delete')->class('btn btn-danger')->type('submit')}}
                        {{html()->form()->close()}}

                        </td>
                      </tr>
                        
                      @endif
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


