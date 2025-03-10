<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Add Roles </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Abdul Rauf" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('icon.png') }}">

    <link href="{{ asset('assets/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">
        <!-- ========== Left Sidebar ========== -->
        @include('nav')
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
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
                                <h4 class="page-title mb-0">Add Roles</h4>
                            </div>
                            <div class="col-lg-6">
                               <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item active">Add Roles</li>
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
                                    <form role="form" action="{{ url('roles/' . $role->id .'/give-permissions') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <label class="col-sm-3 col-form-label">
                                            <h4>Role: <span style="color: blue;">{{ ucfirst($role->name) }}</span></h4>
                                        </label>
                                        <div class="row mb-2">
                                            <label for="" class="col-sm-3 col-form-label"><b>Permissions</b>:</label>
                                            <div class="col-12 mt-4">
                                                <div class="row">
                                                    @foreach ($permissions as $permission)
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="permissions[]" class="form-check-input" id="checkmeout{{$loop->iteration}}" value="{{$permission->name}}" {{in_array($permission->id, $rolePermisions) ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="checkmeout{{$loop->iteration}}">{{$permission->name}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end mt-4">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                    <!--end row-->


                </div> <!-- container -->
            </div> <!-- content -->
            <!-- Footer Start -->
            @include('footer')
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- Knob charts js -->
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- Sparkline Js-->
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <!-- Dashboard init-->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <!-- JavaScript code to validate the form -->
    <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            var name = document.getElementById('name').value;

            function addDangerClass(elementId) {
                document.getElementById(elementId).classList.add('text-danger');
            }

            function removeDangerClass(elementId) {
                document.getElementById(elementId).classList.remove('text-danger');
            }

            if (name.trim() === '') {
                event.preventDefault();
                document.getElementById('nameError').innerText = 'Name is required';
                addDangerClass('nameError');
            } else {
                document.getElementById('nameError').innerText = '';
                removeDangerClass('nameError');
            }
        });
    </script>



</body>

</html>
