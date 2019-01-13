<?php

namespace App\Models;

use App\Models\Traits\WithCommonHelper;
use App\Models\Traits\WithOrderHelper;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    use WithCommonHelper;
    use WithOrderHelper;

    protected $table = 'course';
}
