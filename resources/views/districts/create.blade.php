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
              {{html()->form('POST')->route('admin.districts.store')->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->name('name')->class('form-control')->placeholder('Enter Name')}}
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
              {{html()->button('Submit')->class('btn btn-primary')->type('submit')}}
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
      // Trigger when the dropdown gets focus
      $('#city').on('focus', function () {
          if ($(this).children('option').length === 1) { // Check if options are already populated
              fetchCities();
          }
      });

      function fetchCities() {
          $.ajax({
              url: '{{ route("cities") }}', // API route
              method: 'GET',
              success: function (data) {
                  let cityDropdown = $('#city');
                  cityDropdown.empty(); // Clear existing options
                  cityDropdown.append('<option value="" disabled selected>Select City</option>'); // Placeholder

                  // Populate options
                  $.each(data.data, function (index, city) {
                      cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
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