<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    const IS_ACCESS = 1;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'nick_name',
        'group_id',
        'email',
        'password',
        'full_name',
        'social_id',
        'social_provider',
        'profile_url',
        'status',
        'access',
        'is_new_avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_name',
        'provider_id',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_new_avatar' => 'boolean'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'email' => $this->email,
            'uuid' => $this->uuid,
            'social_id' => $this->social_id,
            'social_provider' => $this->social_provider
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne(Group::class, 'group_id', 'group_id');
    }

    /**
     * @return bool
     */
    public function isSupperAdmin()
    {
        return $this->user_id === 1 || $this->email === 'hongduyphp@gmail.com';
    }

    /**
     * Check current user is Admin
     *
     * @return boolean
     */
    public function isAdmin()
    {

        return !empty($this->group->group_code) && $this->group->group_code === \Constant::GROUP_ADMIN;
    }

    /**
     * Access some field on post
     *
     * @return boolean
     */
    public function isAccessFiled()
    {
        return $this->is_admin === 1;
    }

    /**
     * Check current user is Admin
     *
     * @return boolean
     */
    public function isAccess()
    {
        return $this->access === self::IS_ACCESS || $this->email === 'hongduyphp@gmail.com' || $this->user_id === 1;
    }
}
