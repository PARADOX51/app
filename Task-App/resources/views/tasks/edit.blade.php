<!-- resources/views/tasks/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $task->description }}</textarea>
        </div>
        <div>
            <label for="priority">Priority</label>
            <select name="priority" id="priority" required>
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <div>
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ $task->due_date }}">
        </div>
        <div>
            <label for="user_id">Assign to</label>
            <select name="user_id" id="user_id" required>
                @foreach($users as $user)
                    <option value

