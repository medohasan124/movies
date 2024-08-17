@extends('layout.home')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@lang('Dashboard')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class='col-md-12'>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">@lang('admin.roles') </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.roles.update',$ModelsRole->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('admin.roles')</label>
                                        <input type="text" name="name" id="name" value="{{ $ModelsRole->name }}"
                                            class="form-control">
                                    </div>

                                    <?php

                                    $roles = ['create', 'read', 'update', 'delete'];

                                    ?>

                                    @foreach ($roles as $index => $role)
                                        <div class="custom-control custom-checkbox ">
                                            {{ $ModelsRole->name .'-'.$role  }}
                                            <input class="custom-control-input record_select role"
                                                id="customCheckbox{{ $role }}" name='role[]'
                                                value='{{ $role }}' type="checkbox"
                                                @if ($ModelsRole->hasPermission($ModelsRole->name . 'create-' .$role )) checked @endif>
                                            <label for="customCheckbox{{ $role }}"
                                                class="custom-control-label">@lang('admin.' . $role)</label>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" style="background-color: #28a745" class="btn btn-success">@lang('admin.save') <i
                                            class='fas fa-save'></i> </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->



                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@push('script')
    <script></script>
@endpush
