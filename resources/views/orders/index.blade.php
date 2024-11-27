@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','Index Page')
{{-- Page Content  title --}}
@section('page-header','Restaurant  Records')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-center">
            <div class="d-flex align-items-center justify-content-between">

              {{ html()->form('GET')->route('admin.orders.index')->open() }}
              <div class="d-flex ">
                {{-- Filter By Status --}}
                @foreach ($statuses as $status )
                <div class="ml-2">
                  {{html()->label($status->label())->for($status->value)}}
                {{html()->checkbox('status[]',$status->value)->checked(in_array($status->value,request()->input('status',[])))
                ->value($status->value)
                ->id($status->value)->class('mr-2')              }}
                </div>
                  
                @endforeach
                

                {{ html()->button('Filter')->type('submit')->class('btn btn-primary') }}

              </div>
              {{ html()->form()->close() }}

              {{-- Reset --}}
              {{ html()->form('GET')->route('admin.orders.index')->open() }}
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
                        <th>Restaurant Name</th>
                        <th>Total Price</th>
                        <th>Commision </th>
                        <th>Status</th>
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->restaurant->name}}</td>
                        <td>{{$record->total_price}}</td>
                        <td>{{$record->commission_price}}</td>
                        <td>{{App\Enums\OrderStatus::from($record->status)->label()}}</td>
                        <td></td>  
                        <td class='d-flex gap-4'>
                          {{html()->a()->href(route('admin.orders.show',$record->id))->class('btn btn-info')->text('Show')}}
                          
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


