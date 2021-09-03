<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: qiniu.php
 * Description: 说明
 *
 * @author lwl
 * @Create Date    2021/7/2 11:48
 * @Update Date    2021/7/2 11:48 By lwl
 * @version v1.0
 */
return [

    'account' => env('QINIU_ACCOUNNT', ''),
    'password' => env('QINIU_PASSWORD', ''),
    'version' => 'v3',

    'scenes' => [
        'image' => ['pulp', 'terror', 'politician', 'ads'],
        'text' => ['antispam'],
        'video' => ['pulp', 'terror', 'politician'],
        'audio' => ['antispam'],
        'audio_hook_url' => 'http://xxx.com',
        'disturbList' => ['*', '.', '/', '\/', '，', '.', '>', '<', '<>'],
        //'switch' => json_decode(file_get_contents(storage_path('AuditConfig.json')), 1),
    ]

];