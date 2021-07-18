<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request,CommentRepository $commentRepository): \Illuminate\Http\JsonResponse
    {

        $comment = $commentRepository->create($request->all());
        return response()->json(['comment'=>$comment,'success'=>true],201);
    }
}
