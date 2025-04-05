@extends('layouts.app')
@section('title','Post')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <h1 class="mb-4">{{ $post->title }}</h1>
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                <div class="mb-4">
                    <span class="text-muted">
                        Posted on {{ $post->created_at->format('F j, Y') }} 
                        @if ($post->user)
                            by {{ $post->user->name }}
                        @else
                            by Unknown Author
                        @endif
                    </span>
                </div>
                <div class="content">
                    <p>{{ $post->content }}</p>
                </div>

                <div class="mt-4">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
                </div>
            </article>
        </div>
    </div>
    
</div>
@endsection