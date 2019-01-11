<?php

namespace App\Exports;

use App\Models\Wechatuser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{

    public function headings(): array
    {
        return [
            '#',
            '微信昵称',
            '姓名',
            '邮箱',
            '年级'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Wechatuser::type()->get(['id','nickname','name','email','grade']);
    }
}
