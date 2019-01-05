<?php

namespace App\Http\Middleware;

use App\Model\Guest;
use App\Model\OptUser;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use EasyWeChat\Factory;

class WechatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Session::get('wechat.oauth_user.default');
        $openId = $user['id'];
        $member = Guest::find($openId);
        if(is_null($member)) {
            $options = Config::get('wechat');
            $app = Factory::officialAccount($options);
            $userService = $app->user;
            $user = $userService->get($openId);
            if($user['subscribe'] == 0){
                $self = New Guest();
                $self->openId = $openId;
                $self->nickname = '';
                $self->sex = '';
                $self->headimgurl = '';
                $self->subscribe = 0;
                $self->is_active = 1;
                $self->save();
                $bool = true;
            }else{
                $bool = Guest::add($user);
            }
        } else {
            $bool = true;
        }
        $user = OptUser::where('openid',$openId)->first();
        if(is_null($user)){
            return view('wechat.exit')->with(['content' => '请先绑定身份']);
        }else{
            if($user->status == 0)  return response()->view('wechat.exit',['content' => '您的账号还未激活']);
            if($user->in_job == 0)  return response()->view('wechat.exit',['content' => '您已离职，无权限进入']);
        }
        if ($bool) {
            return $next($request);
        } else {
            exit;
        }
    }
}
