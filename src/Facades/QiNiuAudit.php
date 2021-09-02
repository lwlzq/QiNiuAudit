<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: QiNiuAudit.php
 * Description: 说明
 *
 * @author lwl
 * @Create Date    2021/7/2 11:50
 * @Update Date    2021/7/2 11:50 By lwl
 * @version v1.0
 */
namespace Liuweiliang\Qiniuaudit\Facades;
use Illuminate\Support\Facades\Facade;
class QiNiuAudit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'QiNiuAudit';
    }
}