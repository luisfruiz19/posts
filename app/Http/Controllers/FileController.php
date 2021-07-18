<?php

namespace App\Http\Controllers;

use App\Repository\FileRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request,FileRepository $fileRepository): \Illuminate\Http\JsonResponse
    {
        $files = $fileRepository->getAll($request->all());
        return response()->json(['files'=>$files,'success'=>true],200);
    }

    public function show(){

    }
    public function store(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
