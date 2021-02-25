<?php

namespace App\Repositories;

use App\Models\User;

class UserRepo extends EloquentRepo
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
}
