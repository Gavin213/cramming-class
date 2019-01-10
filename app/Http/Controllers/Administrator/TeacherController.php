<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Wechatuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    //
    /**
     * 列表
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, Wechatuser $wechatuser)
    {
//        $this->authorize('manage', $user);

        // 关键字过滤
        if($email = $request->email ?? ''){
            $wechatuser = $wechatuser->where('email', 'like', "%{$email}%");
        }
        $users = $wechatuser->type(2)->paginate(config('administrator.paginate.limit'));

        return backend_view('teacher.index', compact('users','email'));
    }
}
