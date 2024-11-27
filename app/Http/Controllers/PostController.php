<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MYUser;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; // For handling authenticated user

class PostController extends Controller
{
    // Display all posts with user details, comment count, and like count
    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')
                    ->withCount('comments', 'likes') // Counting comments and likes
                    ->with(['user' => function($query) {
                        $query->select('id', 'name', 'image'); // Fetch user details
                    }])
                    ->get();

        return response()->json([
            'posts' => $posts,
        ], 200);
    }

    // Get a single post with comments and likes count
    public function show($id)
    {
        $post = Post::where('id', $id)
                    ->withCount('comments', 'likes') // Count comments and likes
                    ->with(['user' => function($query) {
                        $query->select('id', 'name', 'image'); // Fetch user details
                    }])
                    ->first();

        if ($post) {
            return response()->json([
                'post' => $post,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }
    }

    // Store a new post
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'body' => 'required|string|max:255',
            
        ]);

        // Create a new post for the authenticated user
        $post = Post::create([
            'body' => $validated['body'],
         
            'user_id' => Auth::id(), // Store the authenticated user's ID
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201); // 201 for resource created
    }


    // Update an existing post
    public function update(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::find($id);

        // If post doesn't exist, return an error message
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }

        // Ensure the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'You are not authorized to update this post',
            ], 403); // Forbidden
        }

        // Validate the request data
        $validated = $request->validate([
            'body' => 'required|string ',
            ]);

        // Update the post with validated data
        $post->body = $validated['body'];
      
        $post->save();

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post,
        ], 200); // 200 for success
    }
// Delete a post by ID
public function destroy($id)
{
    // Find the post by ID
    $post = Post::find($id);

    // If the post doesn't exist, return a 404 error
    if (!$post) {
        return response()->json([
            'message' => 'Post not found',
        ], 404);
    }

    // Ensure the authenticated user is the owner of the post
    if ($post->user_id !== Auth::id()) {
        return response()->json([
            'message' => 'You are not authorized to delete this post',
        ], 403); // Forbidden
    }

    // Delete the post
    $post->delete();

    return response()->json([
        'message' => 'Post deleted successfully',
    ], 200); // 200 for success
}

}
