@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-4">

    <h2>All Posts</h2>

    <a href="{{ route('posts.create') }}"
       class="btn btn-primary">
        Create Post
    </a>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($posts as $post)

                    <tr>

                        <td>{{ $post['id'] }}</td>

                        <td>{{ $post['userId'] }}</td>

                        <td>{{ $post['title'] }}</td>

                        <td>

                            <a href="{{ route('posts.show', $post['id']) }}"
                               class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('posts.edit', $post['id']) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post['id']) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this post?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No posts found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
