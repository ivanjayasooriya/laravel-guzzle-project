@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header">
        <h4>Post Details</h4>
    </div>

    <div class="card-body">

        <h5>Post ID: {{ $post['id'] }}</h5>

        <p>
            <strong>User ID:</strong>
            {{ $post['userId'] }}
        </p>

        <hr>

        <h3>{{ $post['title'] }}</h3>

        <p>{{ $post['body'] }}</p>

        <a href="{{ route('posts.edit', $post['id']) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('posts.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </div>

</div>

@endsection
