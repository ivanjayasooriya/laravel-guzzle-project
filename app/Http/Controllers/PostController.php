<?php

namespace App\Http\Controllers;

use App\Services\JsonPlaceholderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class PostController extends Controller
{
    private JsonPlaceholderService $postService;

    public function __construct(JsonPlaceholderService $postService)
    {
        $this->postService = $postService;
    }

    // Display all posts
    public function index()
    {
        try {
            $posts = $this->postService->getAllPosts();

            return view('posts.index', compact('posts'));

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return back()->with(
                'error',
                'Unable to fetch posts from external API.'
            );
        }
    }

    // Show create form
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'userId' => 'required|integer|min:1',
        ]);

        try {
            $this->postService->createPost($validated);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post created successfully!');

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to create post.');
        }
    }

    // Display one post
    public function show(string $id)
    {
        try {
            $post = $this->postService->getPost((int) $id);

            return view('posts.show', compact('post'));

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', 'Unable to retrieve post.');
        }
    }

    // Show edit form
    public function edit(string $id)
    {
        try {
            $post = $this->postService->getPost((int) $id);

            return view('posts.edit', compact('post'));

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return redirect()
                ->route('posts.index')
                ->with('error', 'Unable to retrieve post.');
        }
    }

    // Update post
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'userId' => 'required|integer|min:1',
        ]);

        try {
            $this->postService->updatePost(
                (int) $id,
                $validated
            );

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post updated successfully!');

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Failed to update post.');
        }
    }

    // Delete post
    public function destroy(string $id)
    {
        try {
            $this->postService->deletePost((int) $id);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Post deleted successfully!');

        } catch (RuntimeException $e) {

            Log::error($e->getMessage());

            return back()->with('error', 'Failed to delete post.');
        }
    }
}
