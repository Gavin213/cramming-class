<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Cache;
use DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

/**
 * 模型公共功能方法
 *
 * Trait WithCommonHelper
 * @package App\Models\Traits
 */
trait WithCommonHelper
{

    /**
     * 获取模板
     *
     * @param int $category
     * @return string
     */
    public function getTemplate($category = 0, $template = 'show'){

        if($this->template){
            $template = $template . '-' . strtolower($this->template);
        }

//        else if( $category && ($category = Category::find($category)) && $category->template ){
//            $template = $template . '-' . strtolower($category->template);
//        }

        return $template;
    }


    /**
     * 获取作者
     *
     * @return string
     */
    public function getAuthor(){
        return $this->author ?? '管理员';
    }

    /**
     * 获取时间
     *
     * @return mixed
     */
    public function getDate(){
        return $this->created_at->diffForHumans();
    }

    /**
     * 获取图片
     *
     * @return string
     */
    public function getThumb(){
        return $this->thumb ? Storage::url($this->thumb) : config('app.url') . '/images/pic-none.png';
    }

    /**
     * 获取图片
     *
     * @return string
     */
    public function getImage($url){
        return $this->$url ? Storage::url($this->$url) : config('app.url') . '/images/pic-none.png';
    }

    /**
     * 追加过滤条件
     *
     * @return mixed
     */
    public function scopeValid(){
        return $this->where('status','1');
    }

    /**
     * 追加过滤条件
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
}
