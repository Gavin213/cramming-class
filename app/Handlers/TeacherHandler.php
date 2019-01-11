<?php

namespace App\Handlers;

use Image;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

/**
 * 辅导员管理
 *
 * Class UploadHandler
 * @package App\Handlers
 */
class TeacherHandler
{
    public function getBase($name,$key)
    {
        return config($name)[$key] ?? '';
    }


    public function handlerCourseData($data)
    {
        $data = is_json($data) ? \GuzzleHttp\json_decode($data) : [];
        $str = '';
        foreach($data as $key => $value)
        {
            $str .= '<span>'.$this->getBase('teacher.course',$key).' '.$value.'</span><br>';
        }

        return $str;
    }

    public function handlerTeachWayData(String $data)
    {
        return $data ? $this->getBase('teacher.teach_way',$data) : '';
    }


    public function handlerTimeData(String $data)
    {
        $data = explode(',',$data);
        $str = '';

        foreach($data as $value){
            $str .= '<span>'.$this->getBase('teacher.time',$value).'</span><br>';
        }

        return $str;
    }

    public function handlerData($userData)
    {
        foreach($userData as &$value) {
            $value->time = $this->handlerTimeData($value->time);
            $value->course = $this->handlerCourseData($value->course);
            $value->teach_way = $this->handlerTeachWayData($value->teach_way);
        }

        return $userData;
    }
}