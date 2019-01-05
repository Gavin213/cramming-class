<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\IM\DoActionController;
use App\Model\Guest;
use App\Model\OptUser;
use App\User;
use Ayzy\IM\Facades\IM;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Config;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use Illuminate\Support\Facades\Log;

class EventController
{
    private $openId;
    private $event;
    private $EventKey;
    private $guest;
    private $user;
    private $tag;
    private $dns;
    private $arg;
    private $image;

    public function __construct( $message )
    {
        $this->openId   = $message['FromUserName'];
        $this->event    = $message['Event'];
        $this->EventKey = isset($message['EventKey']) ? $message['EventKey'] : '';
        $this->dns      = Config::get('app.url');
    }

    public function index()
    {
        $result = $this->GuestInit();
        if ( $result !== false ) {
            $this->guest = $result;
            switch ( $this->event ) {
                case 'subscribe':
                    # 关注事件
                    return $this->subscribeMessage();
                case 'CLICK':
                    # 菜单点击事件
                    return $this->clickMessage();
                case 'unsubscribe':
                    #取消关注事件
                    return $this->unSubscribeMessage();
                case 'SCAN':
                    #已关注时扫码事件
                    return $this->SCANMessage();
                #其他事件
                default:
                    return '';
            }
        } else {
            return '网络连接失败，请重新操作！';
        }
    }

    /**
     *  获取微信用户的信息
     */
    private function getWeChatInfo()
    {
        $options    = Config::get('wechat');
        $app        = Factory::officialAccount($options);
        $this->user = $app->user->get($this->openId);
        $this->tag  = $app->user_tag;
    }

    /**
     * 初始化Guest
     */
    private function GuestInit()
    {
        $guest = Guest::where('openId', $this->openId)->first();
        if ( is_null($guest) ) {
            $this->getWeChatInfo();
            try {
                $this->user['is_active'] = 1;
                $bool = Guest::add($this->user);
                $guest = Guest::where('openId', $this->openId)->first();
            } catch ( \Exception $e ) {
                $bool = false;
            }
        } else {
            $bool = true;
        }
        if ( $bool ) {
            return $guest;
        } else {
            return $bool;
        }
    }

    /**
     * 关注事件
     */
    private function subscribeMessage()
    {
        $bool = $this->refreshWeChatInfo();
        if ( $this->guest->subscribe == 0 ) {
            $this->guest->subscribe = 1;
            $this->guest->subscribe_time = time();
            $this->guest->save();
            switch ( $this->guest->tagid_list ) {
                case 0:    //自主关注
                    break;
                case 101:
                    $this->makeTag(101); // 打上业务员标签
                    break;
                case 102:
                    $this->makeTag(102); // 打上助理标签
                    break;
                case 103:
                    $this->makeTag(103); // 打上促销员标签
                    break;
                default:
                    break;
            }

        }

        if ( !empty($this->EventKey) ) {
            $key = $this->parseEventKey(8);
        } else {
            $this->arg = '欢迎' . $this->guest->nickname . "！";
        }

        $news = empty($this->image) ? ( empty($this->arg) ? '' : new Text($this->arg) ) : new News($this->image);

        return $news;
    }

    /**
     * 扫码事件
     */
    private function SCANMessage()
    {
        if ( !empty($this->EventKey) ) {
            $key = $this->parseEventKey(0);
        } else {
            $this->arg = '欢迎' . $this->guest->nickname . "！";
        }
        $news = empty($this->image) ? ( empty($this->arg) ? '' : new Text($this->arg) ) : new News($this->image);

        return $news;
    }

    /**
     * 刷新微信用户信息
     */
    private function refreshWeChatInfo()
    {
        $this->getWeChatInfo();
        $this->user['sex'] = intval($this->user['sex']);
        $this->guest->nickname = $this->user['nickname'];
        $this->guest->sex = $this->user['sex'];
        $this->guest->subscribe_time = $this->user['subscribe_time'];
        $this->guest->save();
        return true;
    }

    /**
     * 解析key
     *
     * @param $int
     * @return int
     */
    private function parseEventKey( $int )
    {
        $key = substr($this->EventKey, $int);
        $this->arg = $key;
        $belong = substr($key , 0 , 1);
        $value = intval(substr($key, 1));
        switch ( $belong ) {
            case 'b':
                $user = OptUser::where('is_active', 1)->where('openid', $this->openId)->first();
                if ( is_null($user) ) {
                    $this->image = [
                        new NewsItem([
                            'title'       => '您好，您扫描了绑定微信端的专属码',
                            'description' => '请点击此处进行个人信息匹配',
                            'url'         => $this->dns . '/weixin/person/binding',
                            'image'       => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1541064297088&di=8d52f5441a70cc0337f31006992adc98&imgtype=0&src=http%3A%2F%2Fpic167.nipic.com%2Ffile%2F20180603%2F24969966_205155377033_2.jpg'
                        ])
                    ];
                } else {
                    $this->arg = '您好，您的微信已经有绑定关系了,请勿重复扫码。';
                }
                break;
            default:
                break;
        }
    }

    /**
     * 点击事件
     */
    private function clickMessage()
    {
        return '';
    }

    /**
     * 取关事件 将subscribe置空
     */
    private function unSubscribeMessage()
    {
        $this->guest->subscribe = 0;
        $this->guest->save();
        return true;
    }

    /**
     * 打标签
     *
     * @param $tag
     * @param $removeTag
     */
    private function makeTag( $tag, $removeTag = null )
    {

        try {
            empty($removeTag) || $this->tag->untagUsers([$this->openId], $removeTag);  //移除标签
            empty($tag) || $this->tag->tagUsers([$this->openId], $tag);                //打上标签
        } catch ( \Exception $e ) {

        }

    }
}
