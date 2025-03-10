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
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Task Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Task Name:</strong>
                            <p>{{ $task->task_name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Task Description:</strong>
                            <p>{{ $task->task_description ?? 'No description provided' }}</p>
                        </div>

                        <hr>
                        <h5>Comments</h5>

                        <!-- Loader -->
                        <div id="loader" class="text-center" style="display:none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        <div id="comments-container">
                            @foreach($task->comments as $comment)
                                <div class="comment-item border p-3 mb-2" id="comment-{{ $comment->id }}">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <span class="text-muted" style="font-size: 0.85em;">{{ $comment->created_at->format('d-m-Y H:i') }}</span>
                                    <p class="comment-text">{{ $comment->comment }}</p>

                                    @if($comment->user_id == Auth::id())
                                        <button class="btn btn-sm btn-warning" onclick="toggleEditForm({{ $comment->id }})">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteComment({{ $task->id }}, {{ $comment->id }})">Delete</button>

                                        <!-- Edit Form -->
                                        <form id="edit-form-{{ $comment->id }}" class="edit-form" style="display:none;" onsubmit="event.preventDefault(); updateComment({{ $task->id }}, {{ $comment->id }});">
                                            <textarea class="form-control mb-2" id="edit-comment-{{ $comment->id }}">{{ $comment->comment }}</textarea>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm({{ $comment->id }})">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Add Comment Form -->
                        <form id="add-comment-form" onsubmit="event.preventDefault(); addComment({{ $task->id }});">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Add a Comment</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- AJAX Scripts -->
            <script>
                function toggleLoader(show) {
                    document.getElementById('loader').style.display = show ? 'block' : 'none';
                }

                function addComment(taskId) {
                    toggleLoader(true);
                    $.post('{{ route('tasks.addComment', $task->id) }}', {
                        _token: '{{ csrf_token() }}',
                        comment: $('#comment').val()
                    }).done(function(data) {
                        $('#comments-container').append(`
                            <div class="comment-item border p-3 mb-2" id="comment-${data.comment.id}">
                                <strong>${data.comment.user_name}</strong>
                                <span class="text-muted">${data.comment.created_at}</span>
                                <p class="comment-text">${data.comment.comment}</p>

                        <button class="btn btn-sm btn-warning" onclick="toggleEditForm(${data.comment.id})">Edit</button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteComment({{ $task->id }}, ${data.comment.id})">Delete</button>

                                        <!-- Edit Form -->
                                        <form id="edit-form-${data.comment.id}" class="edit-form" style="display:none;" onsubmit="event.preventDefault(); updateComment({{ $task->id }}, ${data.comment.id});">
                                            <textarea class="form-control mb-2" id="edit-comment-${data.comment.id}">${data.comment.comment}</textarea>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditForm(${data.comment.id})">Cancel</button>
                                        </form>

                        </div>

`);
                        $('#comment').val('');
                    }).always(() => toggleLoader(false));
                }

                function updateComment(taskId, commentId) {
                    toggleLoader(true);
                    $.ajax({
                        url: `{{ url('tasks/${taskId}/comments/${commentId}') }}`,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            comment: $(`#edit-comment-${commentId}`).val()
                        },
                        success: function(data) {
                            if (data.success) {
                                $(`#comment-${commentId} .comment-text`).text(data.comment.comment);
                                toggleEditForm(commentId);
                            }
                        },
                        complete: () => toggleLoader(false)
                    });
                }

                function deleteComment(taskId, commentId) {
                    toggleLoader(true);
                    $.ajax({
                        url: `{{ url('tasks/${taskId}/comments/${commentId}') }}`,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(data) {
                            if (data.success) {
                                $(`#comment-${commentId}`).remove();
                            }
                        },
                        complete: () => toggleLoader(false)
                    });
                }

                function toggleEditForm(commentId) {
                    const form = document.getElementById(`edit-form-${commentId}`);
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }
            </script>

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


</body>

</html>

