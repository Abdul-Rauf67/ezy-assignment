<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

    <head>
        <meta charset="utf-8" />
        <title>Roles </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Abdul Rauf" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('icon.png') }}">

        <!-- Morris CSS -->
        <link href="{{ asset('assets/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('assets/js/config.js') }}"></script>
    </head>
    <body>

        <!-- Begin page -->
        <div class="layout-wrapper">
            <!-- ========== Left Sidebar ========== -->
            @include('nav')
            <!-- Start Page Content here -->
            <div class="page-content">
                <!-- ========== Topbar Start ========== -->
                @include('topnav')
                <!-- ========== Topbar End ========== -->
                <div class="px-3">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="py-3 py-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title mb-0">View Roles</h4>
                                </div>
                                <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item active">View Roles</li>
                                    </ol>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        @if (session('status'))
                                            <h6 class="alert alert-success">{{ session('status') }}</h6>
                                        @endif
                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <td>IDs</td>
                                                    <td>Name</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                <tr>
                                                    <td>{{$role->id}}</td>
                                                    <td>{{$role->name}}</td>
                                                    <td>

                                                        @can('update role')
                                                        <a href="{{ url('roles/' . $role->id . '/edit') }}" class="btn btn-outline-primary" data-mdb-ripple-color="dark"><i class="fa fa-edit"></i> Edit</a>
                                                        @endcan
                                                        @can('delete role')
                                                        <a href="{{ url('roles/' . $role->id . '/delete') }}" class="btn btn-outline-danger" data-mdb-ripple-color="dark" onclick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash"></i> Delete</a>

                                                        @endcan
                                                        <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"class="btn btn-outline-primary" data-mdb-ripple-color="dark"><i class="fa fa-plus"></i> Allow Permissions</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div><!-- end row-->
                    </div> <!-- container -->
                </div> <!-- content -->
                <!-- Footer Start -->
                @include('footer')
                <!-- end Footer -->
            </div>
            <!-- End Page content -->
        </div>
        <!-- END wrapper -->

        <!-- App js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <!-- third party js -->
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <!-- third party js ends -->

        <!-- Datatables js -->
        <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>


    </body>
</html>
