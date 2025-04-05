@extends('layouts.app')
@section('title','Post Edit')

@section('content')
    <div class="container mt-4">
        <h2>Edit Post</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required>{{ $post->content }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="current-image" class="form-label">Current Image</label>
                <img src="{{ asset('storage/' . $post->image) }}" width="100" alt="Current post image" class="img-fluid mb-2" id="current-image">
                <input type="file" class="form-control" id="new-image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection