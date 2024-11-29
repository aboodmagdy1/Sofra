@extends('layouts.master')

@section('css')
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
@stop

@section('title', 'Roles | Create')
@section('page-header', 'Create Roles Page')

@inject('permissionModel', 'Spatie\Permission\Models\Permission')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <x-flash-error />
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{ html()->form('POST')->route('admin.roles.store')->open() }}
                    <div class="card-body">
                        <div class="form-group">
                            {{ html()->label('Name')->for('name') }}
                            {{ html()->text('name')->class('form-control')->placeholder('Enter Name') }}
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Permissions</label>
                            <div class="permission-grid">
                                @foreach ($permissionModel->all() as $permission)
                                    <div class="permission-card">
                                        <div class="form-check">
                                            {{ html()->checkbox('permissions[]', false, $permission->name)
                                                ->class('form-check-input')
                                                ->id('permission-' . $permission->id) }}
                                            {{ html()->label($permission->name)->for('permission-' . $permission->id) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ html()->button('Submit')->class('btn btn-primary')->type('submit') }}
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
