<?php

return [
    // 微信公众号
    'wechat_mp_appid' => env('WECHAT_MP_APPID', ''),
    'wechat_mp_secret' => env('WECHAT_MP_SECRET', ''),
    'wechat_mp_token' => env('WECHAT_MP_TOKEN', ''),
    'wechat_mp_aes_key' => env('WECHAT_MP_AES_KEY', ''),
    // 小程序
    'wechat_mini_appid' => env('WECHAT_MINI_APPID', ''),
    'wechat_mini_secret' => env('WECHAT_MINI_SECRET', ''),
    // 开放平台
    'wechat_open_app_id' => env('WECHAT_OPEN_APP_ID', ''),
    // 微信登录
    'wechat_redirect_callback_url' => env('WECHAT_REDIRECT_CALLBACK_URL', ''),
];