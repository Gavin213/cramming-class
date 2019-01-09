<?php

use Illuminate\Support\Facades\Auth;

return [

    // 后台的 URI
    'uri' => 'administrator',

    // 后台专属域名，没有的话可以留空
    'domain' => '',

    'paginate' => [
        'limit' => 10,
    ],


    /**
     * 后台菜单数组
     */
    'menu' => [
        [
            "id" => "system.users",
            "text" => "用户",
            "permission" => function(){ return true; },
            "icon" => "",
            "link" => "",
            "route" => "users.index",
            "params" => [],
            "query" => [],
            "children" => [],
        ],
        [
            "id" => "system.teachers",
            "text" => "辅导员管理",
            "permission" => function(){ return true; },
            "icon" => "",
            "link" => "",
            "route" => "users.index",
            "params" => [],
            "query" => [],
            "children" => [],
        ],
        [
            "id" => "system.classes",
            "text" => "课程管理",
            "permission" => function(){ return true; },
            "icon" => "",
            "link" => "",
            "route" => "users.index",
            "params" => [],
            "query" => [],
            "children" => [],
        ],
        [
            "id" => "",
            "text" => "banner管理",
            "permission" => function(){ return true; },
            "icon" => "",
            "link" => "",
            "route" => "banners.index",
            "params" => [],
            "query" => [],
            "children" => [],
        ],
        [
            "id" => "system.users",
            "text" => "角色管理",
            "permission" => function(){ return true; },
            "icon" => "",
            "link" => "",
            "route" => "users.index",
            "params" => [],
            "query" => [],
            "children" => [],
        ],



    ],

    // 快捷方式
    'shortcut' => [
        [
            "id" => "dashboard",
            "text" => "控制台",
            "permission" => function(){ return true; },
            "icon" => "",
            "route" => "administrator.dashboard",
            "params" => [],
            "query" => [],
            "link" => "",
            "children" => [],
        ],
        [
            "id" => "develop",
            "text" => "开发调试",
            "permission" => function(){ return Auth::user()->can('manage_develop'); },
            "icon" => "",
            "link" => "",
            "route" => "",
            "params" => [],
            "query" => [],
            "children" => [
                [
                    "id" => "log",
                    "text" => "系统日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.laravel",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "task",
                    "text" => "任务日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.jobs",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "queue",
                    "text" => "队列状态",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.queue",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "behavior",
                    "text" => "行为日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.behavior",
                    "params" => [],
                    "query" => [],
                ],
                [
                    "id" => "business",
                    "text" => "业务日志",
                    "permission" => function(){ return Auth::user()->can('manage_develop'); },
                    "icon" => "",
                    "link" => "",
                    "route" => "log.business",
                    "params" => [],
                    "query" => [],
                ],
            ],
        ]
//        ,
//        [
//            "id" => "github",
//            "text" => "Github",
//            "permission" => function(){ return true; },
//            "icon" => "",
//            "route" => "",
//            "params" => [],
//            "query" => [],
//            "link" => "https://github.com/wanglelecc",
//            "children" => [],
//        ],
    ],

];