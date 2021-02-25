<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Repositories\PostRepo;

class PostController extends BaseController
{
    /**
     * @var PostRepo
     */
    private $postRepo;

    /**
     * MediaController constructor.
     * @param PostRepo $postRepo
     */
    public function __construct(PostRepo $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $data = $this->postRepo->findAll();
        return PostResource::collection($data);
    }
}
