@extends('layouts.master')

@section('css')
@stop

{{-- browsr title --}}
@section('title','District | Create')
{{-- Page Content  title --}}
@section('page-header',' Create District Page')

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
              <!-- /.card-header -->
              <!-- form start -->
              {{html()->form('PUT')->route('admin.districts.update',$record->id)->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->name('name')->class('form-control')->placeholder('Enter Name')->value($record->name)}}
                  @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                  {{html()->label('City')->for('city')}}
                  {{html()->select('city_id')->class('form-control')->placeholder('Select City')->id('city')}}
                  @error('city_id')
                  <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
            </div>
            <div class="card-footer">
              {{html()->button('Update')->class('btn btn-primary')->type('submit')}}
            </div>
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


@push('scripts')
<script>
  $(document).ready(function () {
      // Fetch cities immediately when the page loads
      fetchCities();

      function fetchCities() {
          $.ajax({
              url: '{{ route("cities") }}', // API route to fetch cities
              method: 'GET',
              success: function (data) {
                  let cityDropdown = $('#city');
                  cityDropdown.empty(); // Clear existing options
                  cityDropdown.append('<option value="" disabled>Select City</option>'); // Placeholder

                  // Populate options
                  $.each(data.data, function (index, city) {
                      let isSelected = city.id == '{{ $record->city_id }}' ? 'selected' : '';
                      cityDropdown.append('<option value="' + city.id + '" ' + isSelected + '>' + city.name + '</option>');
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