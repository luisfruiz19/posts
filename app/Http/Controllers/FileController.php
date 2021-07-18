<?php

namespace App\Http\Controllers;

use App\Repository\FileRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $fileRepository;
    public function __construct(FileRepository $fileRepository){
        $this->fileRepository = $fileRepository;
    }
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $files = $this->fileRepository->getAll($request->all());
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


    public function getfile($id)
    {
        $file = $this->fileRepository->getFileById($id);
        return $file;
    }
}
