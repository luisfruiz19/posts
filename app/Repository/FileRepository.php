<?php


namespace App\Repository;


use App\Models\File;

class FileRepository
{


    public function getAll(array $params):array
    {
        $files = File::query();
        if(!empty($params['comment_id'])){
            $files->where('comment_id','=',$params['comment_id']);
        }
        return $files->get()->toArray();

    }

}
