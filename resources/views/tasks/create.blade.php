<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Add Task </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured Manager theme which can be used to build CRM, CMS, etc." name="description" />
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
                <br>
                <h2 class="mb-4">Add New Task</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- Task Name -->
                            <div class="mb-3">
                                <label for="task_name" class="form-label">Task Name</label>
                                <input type="text" class="form-control @error('task_name') is-invalid @enderror" id="task_name" name="task_name" value="{{ old('task_name') }}" placeholder="Enter task name">
                                @error('task_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Task Description -->
                            <div class="mb-3">
                                <label for="task_description" class="form-label">Task Description</label>
                                <textarea class="form-control @error('task_description') is-invalid @enderror" id="task_description" name="task_description" rows="4" placeholder="Enter task description">{{ old('task_description') }}</textarea>
                                @error('task_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Task Start Date -->
                            <div class="mb-3">
                                <label for="task_start_date" class="form-label">Task Start Date</label>
                                <input type="date" class="form-control @error('task_start_date') is-invalid @enderror" id="task_start_date" name="task_start_date" value="{{ old('task_start_date') }}">
                                @error('task_start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Task End Date -->
                            <div class="mb-3">
                                <label for="task_end_date" class="form-label">Task End Date</label>
                                <input type="date" class="form-control @error('task_end_date') is-invalid @enderror" id="task_end_date" name="task_end_date" value="{{ old('task_end_date') }}">
                                @error('task_end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="assigned_to" class="form-label">Assign To</label>
                                <select name="assigned_to" id="assigned_to" class="form-select">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

