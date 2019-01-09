<?php

namespace App\Models;

use App\Models\Traits\WithOrderHelper;
use Illuminate\Database\Eloquent\Model;

class Wechatuser extends Model
{
    use WithOrderHelper;
    //
    protected $table = 'wechat_user';

    protected $fillable = ['id','name','openId','nickname','avatar','email','grade','type','headimg','course','time','introduce','que_one','que_tew','updated_at','created_at'];


    /**
     * 追加排序条件
     *
     * @param $query
     * @param string $sortOrder
     * @return mixed
     */
    public function scopeType($query,$type = 1)
    {
        return $query->where('type', $type);
    }

}
