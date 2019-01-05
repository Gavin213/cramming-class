<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Config;

class IndexController extends Controller
{
    public function index()
    {
        $options = Config::get('wechat');
        $app     = Factory::officialAccount($options);
        $app->server->push(function( $message ) {
            switch ( $message['MsgType'] ) {
                case 'event':
                    $event = new EventController($message);
                    return $event->index();
                case 'text':
                    return '收到文字消息';
            }
        });
        $response = $app->server->serve();
        $response->send();

        return $response;
    }
}