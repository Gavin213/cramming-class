<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

/**
 * 文件模型
 *
 * Class File
 * @package App\Models
 */
class File extends Model
{
    protected $fillable = ['id','type', 'path', 'mime_type', 'md5', 'title', 'folder', 'object_id', 'size', 'width', 'height', 'downloads', 'public', 'editor', 'status', 'created_op'];

    public function getImageUrl(){
        return $this->path ? Storage::url($this->path) : config('app.url') . '/images/pic-none.png';
    }
}
