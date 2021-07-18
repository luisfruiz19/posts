<?php

namespace App\Http\Controllers;

use App\Repository\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request,PostRepository $postRepository): \Illuminate\Http\JsonResponse
    {
        $posts = $postRepository->getAll($request->get('with'));
        return response()->json(['posts' => $posts],200);
    }

    public function store(){

    }
}
