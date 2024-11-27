<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment; // Assuming you have a Comment model
use App\Models\MYUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Get all comments for a specific post
    public function index($id)
    {
        $post = Post::find($id);

        // If the post is not found, return a 404 error
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
            ], 404); // 404 Not Found
        }

        // Return comments for the post with user details
        return response()->json([
            'comments' => $post->comments()->with('user:id,name,image')->get(),
        ], 200); // 200 OK
    }

    // Store a new comment on a post
    public function store(Request $request, $postId)
    {
        // Validate the request
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Find the post by ID
        $post = Post::find($postId);

        // If the post is not found, return a 404 error
        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
            ], 404);
        }

        // Create the comment for the post and associate it with the authenticated user
        $comment = $post->comments()->create([
            'user_id' => Auth::id(),  // Assuming you're using the MYUser model for authentication
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment,
        ], 201); // 201 Created
    }

    // Update an existing comment
    public function update(Request $request, $commentId)
    {
        

       
      

        // Find the comment by ID
        $comment =Comment::find($commentId);

        // If the comment is not found, return a 404 error
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        // Ensure the authenticated user is the owner of the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'You are not authorized to update this comment',
            ], 403); // Forbidden
        }

        //validation
        $attrs = $request->validate(
            [
'comment'=>' required|string'
            ]
            );
        $comment->update(
            [
            'comment'=> $attrs['comment']
            ]
        );

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => $comment,
        ], 200); // 200 OK
    }

    // Delete a comment
   


    public function destroy($commentId)
{
    // Find the comment by ID
    $comment = Comment::find($commentId);

    
    if (!$comment) {
        return response()->json([
            'message' => 'Comment not found',
        ], 404); // 404 Not Found
    }

    // Ensure the authenticated user is the owner of the comment
    if ($comment->user_id !== Auth::id()) {
        return response()->json([
            'message' => ' are not authorized to delete this comment',
        ], 403); 
    }

    // Delete the comment
    $comment->delete();

    return response()->json([
        'message' => 'Comment deleted successfully',
    ], 200); // 200 OK
}

}
