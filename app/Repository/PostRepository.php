<?php


namespace App\Repository;


use App\Models\Post;

class PostRepository
{
    public function getAll(array $with): array
    {
        $posts = Post::query();
        if(count($with)>0){
            for ($i=0;$i < count($with);$i++){
                $posts->with($with[$i]);
            }
        }

        return $posts->get()->toArray();
    }

}
