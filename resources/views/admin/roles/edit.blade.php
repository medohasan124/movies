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


                            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>@lang('admin.roles')</label>
                                        <input type="text" name="name" id="name" value="{{ $role->name }}"
                                            class="form-control">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>permission</th>
                                                    <th>description</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Permission as $key => $per)
                                                    <tr>
                                                        <td>{{ $per->id }}</td>


                                                        <td>
                                                            <div class="custom-control custom-checkbox d-inline">
                                                                <input class="custom-control-input record_select role"
                                                                    id="{{ $per->id }}customCheckbox"
                                                                    name='permission[]' value='{{ $per->id }}'
                                                                    type="checkbox"
                                                                    @if($role->hasPermission($per->name))

                                                                    checked

                                                                    @endif

                                                                     >
                                                                <label for="{{ $per->id }}customCheckbox"
                                                                    class="custom-control-label">{{ $per->name }}</label>
                                                            </div>
                                                        </td>

                                                        <td>{{ $per->description }}</td>
                                                    <tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">@lang('admin.update') <i
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
