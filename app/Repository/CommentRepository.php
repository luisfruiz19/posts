<?php


namespace App\Repository;


use App\Models\Comment;
use App\Models\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CommentRepository
{

    public function create($data):Comment
    {
        $inputData = Arr::except($data, 'file');
          $comment = Comment::create($inputData);

        if(!empty($data['file'])){
            $namegenerated = Storage::disk('local')->put(File::FOLDER, $data['file']);

            $file = File::create([
                'path'           => str_replace(File::FOLDER . '/', '', $namegenerated),
                'mime_type'      => $data['file']->getMimeType(),
                'comment_id'     => $comment->id
            ]);
        }

        return $comment;


    }

}
