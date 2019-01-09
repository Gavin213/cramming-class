<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Handlers\UploadHandler;

/**
 * 文件上传控制器
 *
 * Class UploadController
 * @package App\Http\Controllers
 */
class UploadController extends Controller
{
    // 允许类型
    protected $folder = ['contact','avatar', 'article', 'banner','blog', 'page', 'website', 'slide', 'link', 'video', 'annex', 'voice', 'navigation'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function init($ename)
    {
        if ($ename == 'wang') {
            $data = [
                "errno"=> 1,
                'data' => []
            ];
        } elseif ($ename = 'ckeditor') {
            $data = [
                "uploaded" => 0,
                "url" => ''
            ];
        } else {
            $data = [
                'success'   => false,
                'msg'       => '上传失败!',
                'file_path' => '',
                'file_uri' => '',
            ];
        }

        return $data;
    }
    /**
     * 图片上传
     *
     * @param Request $request
     * @param UploadHandler $uploader
     * @return array
     */
    public function image(Request $request, UploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = $this->init($request->ename);

        // 如果上传的不是图片将终止操作
        if ( ! in_array($request->folder, $this->folder)) {
            return $data;
        }
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->saveImage(intval($request->object_id ?? 0), $request->upload_file, $request->folder, intval($request->editor ?? 0), strtolower(substr($request->folder,0,1)), 1024);

            // 图片保存成功的话
            if ($result) {

                switch ($request->ename) {
                    case 'wang':
                        $data['errno'] = 0;
                        $data['data'][] = $result['path'];
                        break;
                    case 'ckeditor':
                        $data['uploaded'] = 1;
                        $data['url'] = $result['path'];
                        break;
                    default:
                        $data['file_path'] = $result['path'];
                        $data['file_uri'] = $result['uri'];
                        $data['msg']       = "上传成功!";
                        $data['success']   = true;
                        break;
                }
            }
        }

        return $data;
    }
}
