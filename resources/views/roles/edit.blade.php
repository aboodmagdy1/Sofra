@extends('layouts.master')

<style>
  .permission-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
  }
  .permission-card {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      background: #f9f9f9;
  }
</style>

{{-- browsr title --}}
@section('title','Role | Edit')
{{-- Page Content  title --}}
@section('page-header',' Edit Role ')
@inject('permissionModel', 'Spatie\Permission\Models\Permission')
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
                    <x-flash-error/>
                </h3>
              </div>


              {{html()->form('PUT')->route('admin.roles.update',$record->id)->open()}}
              <div class="card-body">
                <div class="form-group">
                  {{html()->label('Name')->for('name')}}
                  {{html()->text('name')->class('form-control')->placeholder('Enter Name')->value($record->name)}}
                  @error('name')
                  <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

            <div class="form-group">
              <label>Permissions</label>
              <div class="permission-grid">
                  @foreach ($permissionModel->all() as $permission)
                      <div class="permission-card">
                          <div class="form-check">
                              {{ html()->checkbox('permissions[]', $record->permissions->contains('name',$permission->name), $permission->name)
                                  ->class('form-check-input')
                                  ->id('permission-' . $permission->id) 
                                  ->value($permission->name)
                                  }}
                              {{ html()->label($permission->name)->for('permission-' . $permission->id) }}
                          </div>
                      </div>
                  @endforeach
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


