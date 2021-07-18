<?php


namespace App\Repository;


use App\Models\Post;

class PostRepository
{
    protected $oderColumns = ['id'];
    protected $orderName = 'DESC';

    public function getAll(array $request): array
    {

        $posts = Post::query();
        if(count($request['with'])>0){
            for ($i=0;$i < count($request['with']);$i++){
                $posts->with($request['with'][$i]);
            }
        }
        if(count($this->oderColumns)>0){
           foreach ($this->oderColumns as $key => $value){
               $posts->orderBy($value,$this->orderName);
           }
        }

        return $posts->get()->toArray();
    }


    public function create($postData): Post
    {
        return Post::create($postData);

    }

}
