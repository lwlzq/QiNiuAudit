# 七牛云 文本、图片、音频、视频 审核
### 1.引入包
```angular2html
1.composer require liuweiliang/qiniuaudit dev-master
```
### 2.新增服务
```
2.config/app.php
        Liuweiliang\Liuweiliang\QiNiuAuditProvider::class
```
### 3.发布配置文件
```angular2html

php artisan vendor:publish
```
### 更新 env
```angular2html
QINIU_ACCOUNNT = 你的账号
QINIU_PASSWORD = 你的密码
```
### 文本审核
```angular2html
\Liuweiliang\Liuweiliang\Services\AuditTextService::getInstance()->setMethod('POST')->setQuery('文本内容')->send();// 200字以内
```

### 图片审核
```angular2html
$result = \Liuweiliang\Liuweiliang\Services\AuditTextService::getInstance()->setMethod('POST')->setQuery('图片地址')->send();
```

### 音频审核
```angular2html
$result = \Liuweiliang\Liuweiliang\Services\AuditAudioService::getInstance()->setMethod('POST')->setQuery('音频地址')->send();//推送数据到 七牛云
返回 音频id($audio_id) 用于查询 视频结果

\Liuweiliang\Liuweiliang\Services\AuditAudioService::getInstance()->auditResult($audio_id)//查询音频审核结果

```

### 视频审核
```angular2html
$result = \Liuweiliang\Liuweiliang\Services\AuditVideoService::getInstance()->setMethod('POST')->setQuery('视频地址')->send();//推送数据到 七牛云
返回 视频id(video_id) 用于查询 视频结果

\Liuweiliang\Liuweiliang\Services\AuditAudioService::getInstance()->videoResult($audio_id)//查询视频审核结果


```