<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Wechatuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        $users = $wechatuser->type()->paginate(config('administrator.paginate.limit'));

        return backend_view('user.index', compact('users','email'));
    }


    /**
     * 更新
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Wechatuser $user)
    {
//        $this->authorize('update', $user);
        $user->update($request->all());
//        $roles = $request->input('roles') ? $request->input('roles') : [];
//        $user->syncRoles($roles);
        return response()->json(['status'=>0,'msg'=>'success']);
    }
}
