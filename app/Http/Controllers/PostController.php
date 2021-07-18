<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Repository\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request,PostRepository $postRepository): \Illuminate\Http\JsonResponse
    {
        $posts = $postRepository->getAll($request->all());
        return response()->json(['posts' => $posts],200);
    }

    public function store(StorePostRequest $request,PostRepository $postRepository): \Illuminate\Http\JsonResponse
    {
        $post = $postRepository->create($request->validated());
        return response()->json(['post'=>$post],201);
    }
}
