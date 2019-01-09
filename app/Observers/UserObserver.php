<?php

namespace App\Observers;

use App\Models\Cmsuser;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 用户观察者
 *
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{

    public function creating(Cmsuser $user)
    {
        //
        $user->status = 2;
        $user->created_at = date('Y-m-d H:i:s');

    }

    public function updating(Cmsuser $user)
    {
        //
        $user->updated_at = date('Y-m-d H:i:s');
    }
}