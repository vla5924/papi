<?php

namespace PAPI;

use PAPI\Method;

class UnknownMethod extends Method
{
    public static $specStatus = 404;
    public static $specErrorCode = -1;
    public static $specErrorMessage = '';

    protected function execute(array $parameters): void
    {
        $this->status = self::$specStatus;
        $this->errorCode = self::$specErrorCode;
        $this->errorMessage = self::$specErrorMessage;
    }
}
