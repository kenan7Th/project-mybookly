<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LikeController extends Controller
{
    // Like or unlike a post
    public function likeOrUnlike($id)
    {
        // Find the post by ID
        $post = Post::find($id); // Fixed: Added semicolon

        if (!$post) {
            return response()->json(
                [
                    'message' => 'Post not found'
                ],
                404
            );
        }

        // Check if the user has already liked the post
        $like = $post->likes()->where('user_id', Auth::id())->first();


        if ($like) {
            // Unlike the post if already liked
            $like->delete();

            return response()->json(
                [
                    'message' => 'Post unliked successfully'
                ],
                200
            );
        } else {
            // Like the post if not already liked
            $post->likes()->create([
                'user_id' =>  Auth::id()
            ]);

            return response()->json(
                [
                    'message' => 'Post liked successfully'
                ],
                200
            );
        }
    }
}
