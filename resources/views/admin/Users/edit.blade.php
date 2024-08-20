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
                                <h3 class="card-title">@lang('admin.users') </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.User.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <label>@lang('admin.name')</label>
                                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                                            </div>
                                            <div class='col-md-6'>
                                                <label>@lang('admin.email')</label>
                                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
                                            </div>

                                            <div class='col-md-6'>
                                                <label>@lang('admin.password')</label>
                                                <input type="password" name="password" id="password"  class="form-control" >
                                            </div>
                                            <div class='col-md-6'>
                                                <label>@lang('admin.repeatPassword')</label>
                                                <input type="password" name="password_confirmation"   id="password" class="form-control" >
                                            </div>
                                            <div class='col-md-6'>
                                                <label>@lang('admin.image')</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>



                                            <div class='col-md-6'>
                                                <label>@lang('admin.roles')</label>

                                               <select class='form-control' name="role">
                                                @foreach ($Role as $row)
                                                <option
                                                @if ($user->hasRole($row->name))
                                                    selected
                                                @endif
                                                value='{{ $row->id }}'
                                                >{{ $row->name }}</option>
                                                @endforeach

                                               </select>
                                            </div>
                                            <div class='col-md-6'>
                                                <label>@lang('admin.image')</label>
                                                <img
                                                @if(asset('storage/'.$user->image == null))
                                                    src="{{$user->image}}"
                                                @else
                                                     src="{{ asset('storage/'.$user->image) }}"
                                                @endif
                                                alt="" width="100px" height="100px">
                                            </div>
                                        </div>

                                    </div>



                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">@lang('admin.save') <i
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
