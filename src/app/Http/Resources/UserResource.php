<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'nick_name' => $this->nick_name,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'profile_url' => $this->profile_url,
            'is_new_avatar' => $this->is_new_avatar,
            'about_me' => $this->about_me,
            'social_id' => $this->social_id,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at
        ];
    }
}
