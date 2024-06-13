<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">Create Task</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                    <td>
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @if(!$task->is_completed)
                            <form action="{{ route('admin.tasks.complete', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Complete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


