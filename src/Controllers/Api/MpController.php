<?php

namespace Qihucms\Wechat\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Qihucms\Wechat\Wechat;

class MpController extends ApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function js(Request $request)
    {
        $url = $request->input('url');

        if ($response = Wechat::js($url)) {
            return \response()->json($response);
        }

        return $this->jsonResponse(['参数错误'], '', 422);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function oauth(Request $request)
    {
        $callback = urldecode($request->input('callback'));
        $scopes = $request->input('scopes', 'snsapi_base');
        return Wechat::oauth($callback, $scopes);
    }

    /**
     * @param Request $request
     */
    public function oauth_callback(Request $request)
    {
        $user = Wechat::oauth_callback('snsapi_base');
        dd($user);
    }
}