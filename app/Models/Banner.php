<?php

namespace App\Models;

use App\Models\Traits\WithCommonHelper;
use App\Models\Traits\WithOrderHelper;
use Illuminate\Database\Eloquent\Model;
//use App\Events\BehaviorLogEvent;

class Banner extends Model
{
    use WithCommonHelper;
    use WithOrderHelper;

    protected $table = "cmsbanner";
    protected $fillable = ['id','name','link','img','status','updated_at','created_at'];

    public $dispatchesEvents  = [
//        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName()
    {
        return 'description';
    }
}
