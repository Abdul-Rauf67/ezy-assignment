<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Add Manager Employee </title>
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
                                <h4 class="page-title mb-0">Add Employee</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item active">Add Manager Employee</li>
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
                                    <h4 class="header-title mb-3">Add New Employee</h4>
                                    <!-- Add error message containers under each input field -->
                                    <form method="post" action="{{ url('admin-employees') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="re_password">Re-type Password</label>
                                            <input type="password" name="re_password" id="re_password" class="form-control">
                                            @error('re_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @if(auth()->check())
                                            @if(auth()->user()->roles->contains('id', 1))
                                                <div class="mb-3">
                                                    <label for="admin">Managers</label>
                                                    <select name="admin" id="admin" class="form-control">
                                                        <option value="">Select Manager</option>
                                                        @foreach ($admins as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('admin')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @elseif(auth()->user()->roles->contains('id', 2))
                                                <div class="mb-3">
                                                    <label for="admin">Managers</label>
                                                    <select name="admin" id="admin" class="form-control">
                                                        @if(Auth::check())
                                                            <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                                        @endif
                                                    </select>
                                                    @error('admin')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        @endauth
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
                document.getElementById('rePasswordError').innerText =
                    'The password and retype password must match.'; // Show error message
                addDangerClass('rePasswordError');
            } else {
                document.getElementById('rePasswordError').innerText = '';
                removeDangerClass('rePasswordError');
            }
        });
    </script>



</body>

</html>
