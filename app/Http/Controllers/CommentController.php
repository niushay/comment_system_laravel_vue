<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required',
        ]);

        $comment = Comment::create($request->all());

        if($comment){
            return response() -> json([
                'status' => true,
                'comment_id' => $comment->id
            ]);
        }
    }

    protected function replies($commentId)
    {
        $comments = Comment::where('reply_id',$commentId)->orderBy('created_at', 'desc')->get();
        $replies = [];
        $commentsCollection =[];

        foreach ($comments as $comment) {
                array_push($replies,[
                    "commentId" => $comment->id,
                    "name" => $comment -> name,
                    "comment" => $comment->comment,
                    "replyId" => $comment->reply_id,
                    "date" => $comment->created_at->toDateTimeString(),
                    "replies" => $this->replies($comment->id)
                ]);

            $commentsCollection = collect($replies);
        }
        return $commentsCollection;
    }

    public function fetchComments()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $commentsArray = [];

        foreach ($comments as $comment){
            $replies = $this->replies($comment->id);

            $reply = 0;

            array_push($commentsArray,[
                "commentId" => $comment->id,
                "name" => $comment -> name,
                "comment" => $comment->comment,
                "replyNumber" => $comment->replies,
                "replies" => $replies,
                "reply_id" => $comment->reply_id,
                "date" => $comment->created_at->toDateTimeString()
            ]);
        }

        $comments = collect($commentsArray);
        return response()->json([
            'status' => true,
            'message' => 'Comments fetch successfully',
            'comments' => $comments
        ]) ;
    }

    public function addReply(Request $request)
    {
        $formInputs = $request->all();

        $comment = Comment::create([
            'name' => $formInputs[0]["replyName"],
            'comment' => $formInputs[0]["replyComment"],
            'reply_id' => $formInputs[1],
        ]);

        $parentComment = Comment::findOrFail($formInputs[1]);
        $parentComment -> update([
           'replies' =>  ($parentComment -> replies) + 1
        ]);

        if($comment){
            return response() -> json([
                'status' => true,
                'message' => 'Reply added',
                'comment_id' => $comment->id
            ]);
        }
    }
}
