<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_id'     => 'required',
            'pesan'       => 'required',
            'email'     => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = Comment::create($request->all());

        return response()->json([
            "response" => [
                "status"    => 201,
                "message"   => "Commment berita dengan id " . $comment->news_id . " berhasil coment dengan pesan " . $comment->pesan
            ],
            "data" => $comment
        ], 201);
    }
}
