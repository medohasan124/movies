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
                            <li class="breadcrumb-item active">@lang('admin.Users')</li>
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
                        <div> <x-notify::notify /></div>
                        <div>
                            @permission('users-create')
                                <a href='{{ route('admin.User.create') }}' class='btn btn-success'>
                                    <i class=' fas fa-plus'></i>
                                </a>
                            @endpermission
                            @permission('users-delete')
                                @include('admin.Users.bulckDelete')
                            @endpermission
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th><input class='all-checkbox' type="checkbox"></th>
                                    <th>#</th>
                                    <th>@lang('admin.name')</th>
                                    <th>@lang('admin.roles')</th>
                                    <th>@lang('admin.date')</th>
                                    <th>@lang('admin.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('admin.User.data') }}"
                },

                columns: [{
                        data: 'checkbox',
                        searchable: true,
                        orderable: false,
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'id',
                        searchable: true
                    },
                    {
                        data: 'name',
                        searchable: true
                    },
                    {
                        data: 'roles',
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        searchable: true
                    },
                    {
                        data: 'action',
                        searchable: false
                    },
                ],
            });
        });

        $(document).on('change', '.all-checkbox', function() {
            $('.record_select').prop('checked', this.checked);
            getRecordSelect();
        });

        $(document).on('change', '.record_select', function() {
            var allChecked = $('.record_select:checked').length === $('.record_select').length;
            $('.all-checkbox').prop('checked', allChecked);
            getRecordSelect();
        });

        function getRecordSelect() {

            if ($('.record_select:checked').length >= 2) {
                console.log('yes');
                $('.bulckDelete').removeAttr('disabled');
            } else {
                $('.bulckDelete').attr('disabled', 'disabled');
            }

        }

        $('.bulckDeleteEnd').on('click', function() {

            var recordsId = [];
            $.each($('.record_select:checked'), function() {
                recordsId.push($(this).val());
            });

            $('.buclkDeleteInput').val(recordsId);


        })
    </script>
@endpush
