<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: AuditInterface.php
 * Description: 说明
 *
 * @author lwl
 * @Create Date    2021/8/23 12:22
 * @Update Date    2021/8/23 12:22 By lwl
 * @version v1.0
 */

namespace Liuweiliang\Liuweiliang;


interface AuditInterface
{
    public function setQuery($query);

    public function setRoute($route);

    public function send():array;

    public function getQuery();

    public function getTimeout();

    public function getMethod();

    public function setTimeOut($time);
}
