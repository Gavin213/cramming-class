<?php

namespace App\Http\Controllers\Administrator;

use App\Exports\TeachersExport;
use App\Handlers\TeacherHandler;
use App\Models\Wechatuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
    public function index(Request $request, Wechatuser $wechatuser,TeacherHandler $teacherHandler)
    {
//        $this->authorize('manage', $user);

        // 关键字过滤
        if($email = $request->email ?? ''){
            $wechatuser = $wechatuser->where('email', 'like', "%{$email}%");
        }
        $users = $wechatuser->type(2)->paginate(config('administrator.paginate.limit'));
        $users = $teacherHandler->handlerData($users);

        return backend_view('teacher.index', compact('users','email'));
    }


    /**
     * 更新
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Wechatuser $user,$is_active)
    {
//        $this->authorize('update', $user);
        $d = $user->update(['is_active'=>$is_active]);
//        $roles = $request->input('roles') ? $request->input('roles') : [];
//        $user->syncRoles($roles);
        return redirect()->back()->with('success', '操作成功.');
    }


    /**
     * 导出教师表
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export()
    {
        return Excel::download(new TeachersExport(), 'teachers.xlsx');
    }
}
