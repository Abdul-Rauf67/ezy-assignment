<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Add User </title>
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
                                <h4 class="page-title mb-0">Add Users</h4>
                            </div>
                            <div class="col-lg-6">
                               <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item active">Add User</li>
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
                                    <h4 class="header-title mb-3">Add New User</h4>
                                    <!-- Add error message containers under each input field -->
                                    <form method="post" action="{{url('users')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input id="name" class="form-control" type="text" name="name">
                                            <div id="nameError" class="error-message"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input id="email" class="form-control" type="email" name="email">
                                            <div id="emailError" class="error-message"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="text" name="password" id="password" class="form-control">
                                            <div id="passwordError" class="error-message"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="re_password">Re-type Password</label>
                                            <input type="text" name="re_password" id="re_password" class="form-control">
                                            <div id="rePasswordError" class="error-message"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role">Role</label>
                                            <select name="roles[]" id="role" class="form-control">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role => $name)
                                                    <option value="{{ $role }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
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
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var rePassword = document.getElementById('re_password').value;

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

            if (email.trim() === '') {
                event.preventDefault();
                document.getElementById('emailError').innerText = 'Email is required';
                addDangerClass('emailError');
            } else {
                document.getElementById('emailError').innerText = '';
                removeDangerClass('emailError');
            }

            // Check if password is empty
            if (password.trim() === '') {
                event.preventDefault();
                document.getElementById('passwordError').innerText = 'Password is required';
                addDangerClass('passwordError');
            } else {
                document.getElementById('passwordError').innerText = '';
                removeDangerClass('passwordError');
            }

            // Check if retype password matches password
            if (rePassword !== password) {
                event.preventDefault();
                document.getElementById('rePasswordError').innerText = 'The password and retype password must match.'; // Show error message
                addDangerClass('rePasswordError');
            } else {
                document.getElementById('rePasswordError').innerText = '';
                removeDangerClass('rePasswordError');
            }
        });
    </script>



</body>

</html>
