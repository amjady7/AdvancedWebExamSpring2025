@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Courses</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Add Course</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Name</th>   
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
            
                <td>{{ $course->course_name }}</td>
             
                <td>{{ $course->description }}</td>
             
                <td>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection