<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['file', 'file_name'];

    public function getFileAttribute() {

        if (isset($this->attributes['profile']) && !empty($this->attributes['profile'])) {
            $image = asset('/public/assets/admin/images/profile/'. $this->attributes['profile']);
        } else {

            $image = "";
        }

        return $image;
    }

    public function getFileNameAttribute() {

        if (isset($this->attributes['profile']) && !empty($this->attributes['profile'])) {

            $image = $this->attributes['profile'];
        } else {

            $image = "";
        }

        return $image;
    }
    
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

}
