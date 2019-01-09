<?php

namespace App\Models;

use App\Models\Traits\WithOrderHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cmsuser extends Authenticatable
{
    use WithOrderHelper;
    //
    protected $table = 'cmsuser';

    protected $fillable = ['id','name','email','phone','status','password','updated_at','created_at'];


    /**
     * 返回完整的头像地址
     *
     * @return mixed|string
     */
    public function getAvatar(){

        if ( ! starts_with($this->avatar, 'http')) {
            // 拼接完整的 URL
            $this->avatar = $this->avatar ? Storage::url($this->avatar) : config('app.url') . '/images/avatar.jpg';
        }

        return $this->avatar;
    }
}
