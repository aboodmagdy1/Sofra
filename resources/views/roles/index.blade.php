@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Index Page')
{{-- Page Content  title --}}
@section('page-header','Role Records')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-center">
            <h3 class="card-title">
              <a class="btn btn-primary" href={{route('admin.roles.create')}}> Create Role</a>
            </h3>
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
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        
                        <td class='d-flex gap-4'>
                          <a  href="{{route('admin.roles.edit',$record->id)}}" class="btn btn-info mr-2">Edit</a>
                        {{html()->form('DELETE')->route('admin.roles.destroy',$record->id)->open()}}
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