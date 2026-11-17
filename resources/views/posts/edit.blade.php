@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header">
        <h4>Edit Post #{{ $post['id'] }}</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('posts.update', $post['id']) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">User ID</label>

                <input type="number"
                       name="userId"
                       class="form-control"
                       value="{{ old('userId', $post['userId']) }}">

                @error('userId')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Title</label>

                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title', $post['title']) }}">

                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Body</label>

                <textarea name="body"
                          class="form-control"
                          rows="5">{{ old('body', $post['body']) }}</textarea>

                @error('body')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <button type="submit" class="btn btn-success">
                Update Post
            </button>

            <a href="{{ route('posts.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
