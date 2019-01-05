<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Input;
use App\Facades\Upload;

class InterfaceController extends Controller
{
    /**
     * 初始化
     */
    public static function init()
    {
        $options = Config::get('wechat');
        $app     = Factory::officialAccount($options);

        return $app;
    }

    /**
     * 发送模版消息
     *
     * @param $userId
     * @param $data
     * @param $url
     * @param $type
     * @return mixed
     */
    public static function notice( $userId, $data, $url, $template )
    {
        $notice       = self::init()->template_message;
        $configNotice = Config::get('notice');
        $templateId   = $configNotice[$template];

        $noticeId = $notice->send([
                'touser'      => $userId,
                'template_id' => $templateId,
                'url'         => $url,
                'data'        => $data,
        ]);

        return $noticeId;
    }

    /**
     * jssdk 数据确认
     *
     * @return \EasyWeChat\Js\Js
     */
    public static function js()
    {
        $js       = self::init()->jssdk;
        $returnJs = $js->buildConfig(['chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'getLocation', 'chooseWXPay', 'scanQRCode'], false, false, true);

        return $returnJs;
    }

    /**
     * 菜单
     */
    public function menu()
    {
        $dns     = Config::get('dns');
        $menu    = self::init()->menu;
        $buttons = [
                [
                        "name"       => "活动",
                        'sub_button' => [
                                [
                                        'type'     => 'view_limited',
                                        'name'     => '经营品牌',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf8C9XUpLPE6RwhjYGSG1Z4c',
                                ],
                                [
                                        'type'     => 'view_limited',
                                        'name'     => '岁末狂欢购',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf_F3_NyG6qlzbPcnapzRw08',
                                ],
                        ]
                ],
                [
                        "name"       => "购物",
                        'sub_button' => [
                                [
                                        'type'     => 'view_limited',
                                        'name'     => '茅台系列',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf_5BjfAFbwc7LGQ14Hb1epI',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '汾酒系列',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSfydtqfv1VlOe0vRA5JKxFQY',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '茅台生肖酒',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf4VPLNfbeSfKP-aD9_9uLPk',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '小酒系列',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf20_TYepd59aLz7z-KBBnL4',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '新年抢年货',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf4n2VzQy3poQ9x_tqwKD3Bo',
                                ],
                        ]
                ],
                [
                        "name"       => "关于我们",
                        'sub_button' => [
                                [
                                        'type'     => 'view_limited',
                                        'name'     => '联系我们',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf0o3D23YBaiI4FzEmF5knQk',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '企业简介',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf4thKyijk605UGCVTQHGbLs',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '企业发展历程',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSf7KC5QFWe4qw9CQt615eM6w',
                                ], [
                                        'type'     => 'view_limited',
                                        'name'     => '大爱无疆',
                                        'media_id' => 'J9f4MwsfDJnO0F9Nf4PSfxW3Tw0rD7EtAZjbcXBz0Fg',
                                ]
                        ]
                ],
        ];
        $button1 = [
                [
                        "type" => "view",
                        "name" => "销售登记",
                        "url"  => $dns . "/weixin/sales/registration"
                ],
                [
                        "type" => "view",
                        "name" => "考勤签到",
                        "url"  => $dns . "/weixin/sign"
                ],
                [
                        "type" => "view",
                        "name" => "个人中心",
                        "url"  => $dns . "/weixin/person"
                ],

        ];
        $button2 = [
                [
                        "type" => "view",
                        "name" => "门店管理",
                        "url"  => $dns . "/weixin/store/index"
                ],
                [
                        "type" => "view",
                        "name" => "促销员管理",
                        "url"  => $dns . "/weixin/promoter"
                ],
                [
                        "type" => "view",
                        "name" => "个人中心",
                        "url"  => $dns . "/weixin/person"
                ],
        ];
        $button3 = [
                [
                        "type" => "view",
                        "name" => "门店管理",
                        "url"  => $dns . "/weixin/store/index"
                ],
                [
                        "type" => "view",
                        "name" => "销售审核",
                        "url"  => $dns . "/weixin/sales/check"
                ],
                [
                        "type" => "view",
                        "name" => "个人中心",
                        "url"  => $dns . "/weixin/person"
                ],
        ];

        $mathButton1 = [
                "tag_id" => "103", // 促销员
        ];
        $mathButton2 = [
                "tag_id" => "102", // 助理
        ];
        $mathButton3 = [
                "tag_id" => "101", //业务员
        ];
        $menu->create($buttons);
        $menu->create($button1, $mathButton1);
        $menu->create($button2, $mathButton2);
        $menu->create($button3, $mathButton3);
        echo 'ok';
    }

    /**
     * 把资源写入服务器
     *
     * @param $mediaid
     * @return string
     */
    public static function temporary( $mediaid, $directory = 'avatar' )
    {
        $app     = self::init();
        $content = $app->media->get($mediaid);
        $path    = Upload::disk('s3Public')->path($directory)->putWeChat($content);

        return $path;
    }

    public static function uploadMedia( $content, $directory )
    {
        $timer     = date('Ymd', time());
        $extension = 'jpg';
        $str       = str_random(32);
        $newName   = $str . '.' . $extension;
        Storage::disk('local')->put($directory . '/' . $timer . '/' . $newName, $content);

        return $directory . '/' . $timer . '/' . $newName;
    }


    /**
     * 二维码
     */
    public function foreverQrCode( $str )
    {
        // 永久二维码
        $qrcode = self::init()->qrcode;
        $result = $qrcode->forever($str);
        $url    = $result['url'];

        return $url;
    }

    public function temporaryQrCode( $int, $time )
    {
        // 临时二维码
        $qrcode = self::init()->qrcode;
        $result = $qrcode->temporary($int, $time);
        $url    = $result['url'];

        return $url;
    }

}
