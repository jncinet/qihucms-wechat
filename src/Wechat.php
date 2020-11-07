<?php

namespace Qihucms\Wechat;

use EasyWeChat\Factory;

class Wechat
{
    /**
     * 授权
     *
     * @param string $callback
     * @param string $scopes
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public static function oauth(string $callback, $scopes = 'snsapi_userinfo')
    {
        $app = Factory::officialAccount([
            'app_id' => config('qh_wechat.wechat_mp_appid'),
            'secret' => config('qh_wechat.wechat_mp_secret'),
            'oauth' => [
                'scopes' => [$scopes],
                'callback' => $callback,
            ],
        ]);

        return $app->oauth->redirect();
    }

    /**
     * 授权回调
     *
     * @param string $scopes
     * @return \Overtrue\Socialite\User
     */
    public static function oauth_callback($scopes = 'snsapi_userinfo')
    {
        $app = Factory::officialAccount([
            'app_id' => config('qh_wechat.wechat_mp_appid'),
            'secret' => config('qh_wechat.wechat_mp_secret'),
        ]);

        if ($scopes === 'snsapi_base') {
            return $app->oauth->user();
        }

        return $app->oauth->userFromCode();
    }

    /**
     * JS SDK
     *
     * @param null $url
     * @return array|bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function js($url = null)
    {
        $app = Factory::officialAccount([
            'app_id' => config('qh_wechat.wechat_mp_appid'),
            'secret' => config('qh_wechat.wechat_mp_secret'),
            'token' => config('qh_wechat.wechat_mp_token'),
            'aes_key' => config('qh_wechat.wechat_mp_aes_key'),
        ]);

        if ($url) {
            $app->jssdk->setUrl($url);
        }

        try {
            $result = $app->jssdk->buildConfig(
                [
                    'checkJsApi',
                    'updateAppMessageShareData',
                    'updateTimelineShareData',
                    'chooseWXPay',
                    'openLocation',
                    'getLocation',
                    'getNetworkType',
                    'closeWindow',
                    'scanQRCode',
                    'openAddress',
                ],
                false,
                false,
                true
            );
        } catch (\Exception $exception) {
            $result = false;
        }

        return $result;
    }
}