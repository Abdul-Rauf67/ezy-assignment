<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Tasks </title>
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

                <div class="container">
                    <h2 class="mb-4">Task List</h2>

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                @endif

                <!-- Task Table -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
                            </div>

                            @if($tasks->isEmpty())
                                <p class="text-center">No tasks available.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Task Name</th>
                                            <th>Assigned To</th>
                                            <th>Created By</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $task->task_name }}</td>
                                                <td>{{ $task->assigned_to }}</td>
                                                <td>{{ $task->created_by }}</td>
                                                <td>{{ date('d-m-Y', strtotime($task->task_start_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($task->task_end_date)) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $tasks->links() }}
                                </div>
                            @endif
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

