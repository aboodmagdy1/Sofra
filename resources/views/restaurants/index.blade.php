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

              {{ html()->form('GET')->route('admin.restaurants.index')->open() }}
              <div class="d-flex ">
                {{-- Search  --}}
                  {{ html()->text('filters[name]')
                  ->class('form-control mr-2')->placeholder('Restaurant Name') ->value(request()->input('filters.name'))}}
                {{ html()->button('Search')->type('submit')->class('btn btn-primary') }}

                {{-- Filter by category --}}
                {{html()->select('filters[category_id]')->id('categories')->class('form-control mr-2')
                ->placeholder('Select Category')->value(request()->input('filters.category_id'))}}
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
                        <th>Restaurant Name</th>
                        <th>Email</th>
                        <th>District </th>
                        <th>Rate</th>
                        <th>Actions</th>

                      </tr>
                  </thead>
                    <tbody>
                      @foreach ($records as $record )
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{$record->district->name}}</td>
                        <td>{{$record->avg_rate}}</td>  
                        <td class='d-flex gap-4'>
                          {{html()->a()->href(route('admin.restaurants.show',$record->id))->class('btn btn-info')->text('Show')}}
                          {{-- active  --}}
                          {{html()->form('PUT')->route('admin.restaurants.update',$record->id)->open()}}
                          @if($record->is_active)
                          {{html()->button('Deactivate')->class('btn btn-warning')->type('submit')}}
                          {{html()->hidden('is_active',0)}}
                          @else
                          {{html()->button('Activate')->class('btn btn-success')->type('submit')}}
                          {{html()->hidden('is_active',1)}}
                          @endif

                          {{html()->form()->close()}}
                          {{-- Delete --}}
                        {{html()->form('DELETE')->route('admin.restaurants.destroy',$record->id)->open()}}
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


@push('scripts')
<script>
  $(document).ready(function () {
      // Fetch Categories immediately on start select
      let  categoryDropdown = $('#categories');
      fetchCategories();

      function fetchCategories() {
          $.ajax({
              url: '{{ route('restaurant_categories') }}', // API route to fetch cities
              method: 'GET',
              success: function (data) {

                  categoryDropdown.empty(); // Clear existing options
                  categoryDropdown.append('<option value="">Select Category</option>');
                  // Populate options
                  $.each(data.data, function (index, category) {
                     let isSelected = category.id == '{{ request()->input('filters.category_id') }}' ? 'selected' : '';
                      categoryDropdown.append('<option value="' + category.id + '" ' + isSelected + '>' + category.name + '</option>');
                  });
              },
              error: function () {
                  alert('Failed to fetch cities. Please try again later.');
              }
          });
      }
  });
</script>
  
@endpush