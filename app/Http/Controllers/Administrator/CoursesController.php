<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Course;
use App\Models\Wechatuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class CoursesController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, Course $course)
    {
//        $this->authorize('manage', $user);

        // 关键字过滤
        if($time = $request->time ?? ''){
//            $wechatuser = $wechatuser->where('email', 'like', "%{$email}%");
        }
        $courses = $course->recent()->paginate(config('administrator.paginate.limit'));

        return backend_view('courses.index', compact('courses','time'));
    }

    /**
     * 创建
     *
     * @param Course $course
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Course $course)
    {
        return backend_view('courses.create_and_edit', compact('course'));
    }


    /**
     * 搜索符合日期的老师
     *
     * @param Course $course
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function teachers(Request $request,Wechatuser $wechatuser)
    {
        $data = Carbon::parse($request->date)->dayOfWeek;

        $teachers = $wechatuser->type(2)->where('time','like','%'.$data.'%')->where('is_active','2')->get(['name','headimg','id'])->toArray();

        return response()->json(['week'=>$data,'teacher'=>$teachers]);
    }
}
