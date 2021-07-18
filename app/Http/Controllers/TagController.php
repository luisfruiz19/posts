<?php

namespace App\Http\Controllers;

use App\Repository\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(TagRepository $tagRepository): \Illuminate\Http\JsonResponse
    {
        $tags = $tagRepository->getAll();
        return response()->json(['tags'=>$tags,'success'=>true],200);
    }
}
