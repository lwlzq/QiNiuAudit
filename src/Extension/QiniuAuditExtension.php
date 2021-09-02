<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: QiniuAuditExtension.php
 * Description: 说明
 *
 * @author lwl
 * @Create Date    2021/8/23 13:49
 * @Update Date    2021/8/23 13:49 By lwl
 * @version v1.0
 */

/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: AuditText.php
 * Description: 七牛云sdk没有的这里扩展
 *
 * @author lwl
 * @Create Date    2021/8/23 13:41
 * @Update Date    2021/8/23 13:41 By lwl
 * @version v1.0
 */

namespace Liuweiliang\Liuweiliang\Extension;

use Qiniu\Auth;
use Qiniu\Config;
use Qiniu\Zone;
use Qiniu\Http\Client;
use Qiniu\Http\Error;

class QiniuAuditExtension
{
    private $auth;
    private $config;

    public function __construct(Auth $auth, Config $config = null)
    {
        $this->auth = $auth;
        if ($config == null) {
            $this->config = new Config();
        } else {
            $this->config = $config;
        }
    }

    /**
     * 查询音频审核结果
     *
     * @param string $jobid 任务ID
     * @return array
     * @link  https://developer.qiniu.com/censor/api/5620/video-censor
     */
    public function censorStatus($jobid)
    {
        $scheme = 'http://';

        if ($this->config->useHTTPS === true) {
            $scheme = 'https://';
        }
        $url = $scheme . Config::ARGUS_HOST . "/v3/jobs/audio/$jobid";
        $response = $this->get($url);
        if (!$response->ok()) {
            print('statusCode: ' . $response->statusCode);
            return array(null, new Error($url, $response));
        }
        return array($response->json(), null);
    }

    private function get($url)
    {
        $headers = $this->auth->authorizationV2($url, 'GET');
        return Client::get($url, $headers);
    }

    /**
     * 文字审核
     *
     * @param string $body
     *
     * @return array 成功返回NULL，失败返回对象Qiniu\Http\Error
     * @link  https://developer.qiniu.com/censor/api/5588/image-censor
     */
    public function censorText($body)
    {
        $path = '/v3/text/censor';
        return $this->arPost($path, $body);
    }


    /**
     * 音频审核
     *
     * @param string $body
     *
     * @return array 成功返回NULL，失败返回对象Qiniu\Http\Error
     * @link  https://developer.qiniu.com/censor/api/5588/image-censor
     */
    public function censorAudio($body)
    {
        $path = '/v3/audio/censor';
        return $this->arPost($path, $body);
    }

    private function getArHost()
    {
        $scheme = 'http://';
        if ($this->config->useHTTPS === true) {
            $scheme = 'https://';
        }
        return $scheme . Config::ARGUS_HOST;
    }

    private function arPost($path, $body = null)
    {
        $url = $this->getArHost() . $path;
        return $this->post($url, $body);
    }

    private function post($url, $body)
    {
        $headers = $this->auth->authorizationV2($url, 'POST', $body, 'application/json');
        $headers['Content-Type'] = 'application/json';
        $ret = Client::post($url, $body, $headers);
        if (!$ret->ok()) {
            print('statusCode: ' . $ret->statusCode);
            return array(null, new Error($url, $ret));
        }
        $r = ($ret->body === null) ? array() : $ret->json();
        if (strstr($url, 'video')) {
            $jobid = $r['job'];
            return array($jobid, null);
        }
        return array($r, null);
    }
}
