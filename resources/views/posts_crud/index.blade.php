@extends('layouts.app')
@section('title','Posts')

@section('content')
    <div class="container mt-4">
        <h2>Recent Posts</h2>
        <div class="row">
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            
                            @if (Auth::id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary ms-2">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        </div>
                        
                        <div class="card-footer text-muted">
                            {{ $post->user->username ?? 'Unknown Author' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection