<?php

use Illuminate\Routing\Router;

// 手机端
Route::group([
    'namespace' => 'Qihucms\Wechat\Controllers\Wap',
    'middleware' => ['web']
], function (Router $router) {
});

// 接口
Route::group([
    'namespace' => 'Qihucms\Wechat\Controllers\Api',
    'prefix' => 'wechat',
    'middleware' => ['api'],
    'as' => 'api.'
], function (Router $router) {
    $router->post('js', 'MpController@js');
    $router->get('oauth', 'MpController@oauth')->name('oauth');
    $router->any('oauth_callback', 'MpController@oauth')->name('oauth.callback');
});

// 后台
Route::group([
    'prefix' => config('admin.route.prefix') . '/wechat',
    'namespace' => 'Qihucms\Wechat\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
//    $router->resource('user-follows', 'FollowsController');
    // 配置
//    $router->get('config', 'ConfigController@index')
//        ->name('article.config');
});