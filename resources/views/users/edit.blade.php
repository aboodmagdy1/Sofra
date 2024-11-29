@extends('layouts.master')

<style>
  .role-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 15px;
  }
  .role-card {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      background: #f9f9f9;
  }
</style>


{{-- browsr title --}}
@section('title','User| Edit')
{{-- Page Content  title --}}
@section('page-header',' Edit User Page')

@inject('roleModel', 'Spatie\Permission\Models\Role')
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
                  <x-flash-error />
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{html()->form('PUT')->route('admin.users.update',$record->id)->open()}}
              <div class="card-body">
                <div class="form-group">
                  <label>Role</label>
                  <div class="role-grid">
                      @foreach ($roleModel->all() as $role)
                          <div class="role-card">
                              <div class="form-check">
                                  {{ html()->radio('role', $record->hasRole($role->name), $role->name)
                                      ->class('form-check-input')
                                      ->id('role-' . $role->id) 
                                      ->value($role->name)
                                      }}
                                  {{ html()->label($role->name)->for('role-' . $role->id) }}
                              </div>
                          </div>
                      @endforeach

                      @error('role')
                          <span class="text-danger">{{ $message }}</span>
                        
                      @enderror
                  </div>

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

