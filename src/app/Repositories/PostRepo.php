<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepo extends EloquentRepo
{
    /**
     * get Model
     * @return string
     */
    public function getModel()
    {
        return Post::class;
    }

    public function findAll($offset = 0, $limit = 9)
    {
        return $this->model->newQuery()->orderByDesc('post_id')->offset($offset)->limit($limit)->get();
    }
}
