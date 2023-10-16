<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   /* public function store(Request $request)
    {
    	$request->validate([
            'message'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comment::create($input);
   
        return back();
    }*/



   


 // ...

    // Store a new comment
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'post_id' => 'required|exists:posts,id', // Validate the post_id to ensure it exists in the posts table
            'message' => 'required', // Assuming 'message' is the field for comments
        ]);

        // Create a new comment instance
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->user()->id; // Assuming user authentication is set up
        $comment->message = $request->message; // 'message' should match your database field

        // Save the comment to the database
        $comment->save();

        // Redirect back with a success message or to the post where the comment was added
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    // ...
}


