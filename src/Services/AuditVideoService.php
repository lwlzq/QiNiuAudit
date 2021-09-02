<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: AuditVideoService.php
 * Description: 七牛云视频审核
 *
 * @author lwl
 * @Create Date    2021/8/20 17:06
 * @Update Date    2021/8/20 17:06 By lwl
 * @version v1.0
 */

namespace BusinessSchool\Services\Qiniu\Services;

use BusinessSchool\Services\Qiniu\AuditInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Qiniu\Auth;
use Qiniu\Config;
use Qiniu\Storage\ArgusManager;

class AuditVideoService implements AuditInterface
{
    const ROUTE = 'video';
    static private $instance;

    /**
     * @var Client
     */
    private $client;

    /**
     * 接口地址
     * @var string
     */
    private $api;

    /**
     * appSecret
     * @var string
     */
    private $appSecret;

    /**
     * appId
     * @var string
     */
    private $appId;

    /**
     * 路由
     * @var string
     */
    private $route;

    /**
     * 版本
     * @var string
     */
    private $version = 'v3';


    /**
     * 超时时间
     * @var float
     */
    private $timeout = 5.0;

    /**
     * 请求参数
     * @var array
     */
    private $query = [];

    /**
     * 请求方式
     * @var string
     */
    private $method = 'POST';

    /**
     * AuditImageService constructor.
     */
    private function __construct()
    {
        $this->appId = config('services.qiniu.ak');
        $this->appSecret = config('services.qiniu.sk');
    }

    /**
     * FunctionName：__clone
     * Description：
     * Author：lwl
     */
    private function __clone()
    {
    }

    /**
     * FunctionName：getInstance
     * Description：
     * Author：lwl
     * @return AuditImageService
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * FunctionName：setQuery
     * Description：设置请求参数
     * Author：lwl
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = [
            'data' => [
                'id' => $query,
                'uri' => $query,
            ],
            'params' => [
                'scenes' => config('services.qiniu.scenes.video'),
            ],
            'cut_param' => ['interval_msecs' => 5000]
        ];
        return $this;
    }

    /**
     * FunctionName：setApi
     * Description：
     * Author：lwl
     * @param $api
     * @return $this
     */
//    public function setApi($api)
//    {
//        $this->api = $api . $this->version;
//        return $this;
//    }

    /**
     * FunctionName：setTimeOut
     * Description：设置超时时间
     * Author：lwl
     * @param $time
     * @return $this
     */
    public function setTimeOut($time)
    {
        $this->timeout = $time;
        return $this;
    }

    /**
     * FunctionName：setVersion
     * Description：
     * Author：lwl
     * @param $version
     * @return $this
     */
//    public function setVersion($version)
//    {
//        $this->version = $version ?? config('services.qiniu.version','v3');
//        return $this;
//    }

    /**
     * FunctionName：setMethod
     * Description：设置请求方式
     * Author：lwl
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * FunctionName：getMethod
     * Description：获取请求方法
     * Author：lwl
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * FunctionName：getTimeout
     * Description：获取超时时间
     * Author：lwl
     * @return float
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * FunctionName：getQuery
     * Description：获取请求传参
     * Author：lwl
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * FunctionName：setRoute
     * Description：设置路由
     * Author：lwl
     * @param $route
     * @return $this
     */
    public function setRoute($route)
    {

        $this->route = $route;
        return $this;
    }

    /**
     * FunctionName：send
     * Description：发送请求
     * Author：lwl
     * @return array
     */
    public function send()
    {
        $argusManager = new ArgusManager((new Auth($this->appId, $this->appSecret)), (new Config()));
        $body = json_encode($this->query);
        list($ret, $err) = $argusManager->censorVideo($body);
        if ($err !== null) {
            Log::error('七牛云验证错误' . self::ROUTE, ['request_id' => time(), 'message' => $err->message(), 'code' => $err->code()]);
            return ['code' => 502, 'msg' => '状态码异常，请检查', 'data' => []];
        }
        $return['id'] = $ret;
        $return['code'] = 200;
        return $return;
    }


    /**
     * FunctionName：getVideoResult
     * Description：获取视频结果
     * Author：lwl
     */
    public function videoResult($jobId)
    {
        $argusManager = new ArgusManager((new Auth($this->appId, $this->appSecret)), (new Config()));
//        $result = $argusManager->censorStatus($jobId);
//        return $result;

        list($ret, $err) = $argusManager->censorStatus($jobId);
        if ($err !== null) {
            Log::error('七牛云验证错误' . self::ROUTE, ['request_id' => time(), 'message' => $err->message(), 'code' => $err->code()]);
            return ['code' => 502, 'msg' => '状态码异常，请检查', 'data' => []];
        }
        $ret['code'] = 200;
        return $ret;
    }
}
