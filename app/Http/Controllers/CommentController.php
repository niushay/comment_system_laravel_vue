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
            'reply_id' => 'filled',
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
        $comments = Comment::where('reply_id',$commentId)->get();
        $replies = [];

        foreach ($comments as $comment) {
                array_push($replies,[
                    "commentId" => $comment->id,
                    "name" => $comment -> name,
                    "comment" => $comment->comment,
                    "date" => $comment->created_at->toDateTimeString()
                ]);

            $commentsCollection = collect($replies);
            return $commentsCollection;
        }
    }

    public function fetchComments()
    {
        $comments = Comment::get();
        $commentsArray = [];

        foreach ($comments as $comment){
            $replies = $this->replies($comment->id);

            $reply = 0;

            if ($replies != null){
                if(sizeof($replies) > 0){
                    $reply = 1;
                }
            }

            array_push($commentsArray,[
                "commentId" => $comment->id,
                "name" => $comment -> name,
                "comment" => $comment->comment,
                "reply" => $reply,
                "replies" => $replies,
                "date" => $comment->created_at->toDateTimeString()
            ]);
        }

        $comments = collect($commentsArray);
        dd($comments);
        return response()->json($comments) ;
    }
}
