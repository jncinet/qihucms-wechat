<?php

namespace Qihucms\Wechat\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Http\StreamResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Qihucms\Wechat\Requests\MiniApp\AppCodeRequest;

class MiniAppController extends ApiController
{
    protected $app;

    /**
     * MiniAppController constructor.
     */
    public function __construct()
    {
        $this->app = Factory::miniProgram([
            'app_id' => config('qh_wechat.wechat_mini_appid'),
            'secret' => config('qh_wechat.wechat_mini_secret'),
        ]);
    }

    /**
     * 获取小程序码
     * @param AppCodeRequest $request
     * @return JsonResponse
     */
    public function get(AppCodeRequest $request)
    {
        $path = $request->input('path');

        $optional = [];

        if ($width = $request->input('width')) {
            $optional['width'] = $width;
        }

        if (is_array($request->input('line_color'))) {
            $optional['width'] = $request->input('line_color');
        }

        $response = $this->app->app_code->get($path, $optional);

        if ($response instanceof StreamResponse) {
            // 保存目录
            $savePath = storage_path('app/public/app_code');

            if ($filename = $request->input('filename')) {
                $filePath = $response->saveAs($savePath, $filename);
            } else {
                $filePath = $response->save($savePath);
            }

            return $this->jsonResponse(['file_path' => $filePath]);
        }

        return $this->jsonResponse(['操作失败'], '', 422);
    }

    public function getUnlimit(AppCodeRequest $request)
    {
        $response = $this->app->app_code->getUnlimit('scene-value', [
            'page'  => $request->input('path'),
            'width' => $request->input('width', 430),
        ]);
    }
}