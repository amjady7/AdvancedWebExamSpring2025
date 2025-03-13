<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@extends('layouts.app')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4">Task Manager</h1>

                <!-- Add Task Form -->
                <form id="StudentForm">
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                        <input type='int' name="age" class=" form-controll">
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                    <div id="error" class="text-danger mb-3"></div>
                </form>

               
                <ul id="studentList" class="list-group">
                    @foreach($students as $student)
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $student->name }}">
                            {{ $student->age }}
                            <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Add new task
            $('#studentForm').submit(function(e) {
                e.preventDefault();
                const $form = $(this);

                $.ajax({
                    url: '/student',
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        // Append new task to list
                        $('#studentList').prepend(`
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${response.name}">
                                ${response.age}
                                <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                            </li>
                        `);
                        $('#error').html('');
                        $form.trigger('reset');
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred.';
                        if (xhr.status === 422) {
                            errorMessage = xhr.responseJSON.errors.title[0];
                        }
                        $('#error').html(errorMessage);
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                const $listItem = $(this).closest('li');
                const taskId = $listItem.data('id');

                $.ajax({
                    url: `/students/${studentId}`,
                    method: 'DELETE',
                    success: function() {
                        $listItem.remove(); 
                    },
                    error: function(xhr) {
                        alert('Failed to delete student');
                    }
                });
            });
        });
    </script>
</body>
</html>
