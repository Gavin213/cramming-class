<?php

namespace App\Exports;

use App\Models\Wechatuser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Handlers\TeacherHandler;

class TeachersExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'name',
            '邮箱',
            '年级',
            '课程时间',
            '辅导课程',
            '辅导方式',
            '个人介绍',
            'Q1',
            'Q2',
            '审核',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $teacherHandler =new TeacherHandler();
        $teachers = Wechatuser::type(2)->get(['id','name','email','grade','time','course','teach_way','introduce','que_one','que_tew','is_active']);
        $teachers = $teacherHandler->handlerData($teachers);

        foreach($teachers as &$value){
            $value->is_active = $teacherHandler->getBase('teacher.is_active', $value->is_active);
            $value->time = strip_tags($value->time);
            $value->course = strip_tags($value->course);
        }

        return $teachers;
    }
}
