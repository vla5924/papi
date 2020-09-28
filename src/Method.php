<?php

namespace PAPI;

use PAPI\Output;

abstract class Method
{
    protected $status = 200;
    protected $response = [];
    protected $errorCode = 0;
    protected $errorMessage = '';

    protected abstract function execute(array $parameters): void;

    public final function fire(array $parameters = []): void
    {
        $this->execute($parameters);
        if ($this->status == 200)
            Output::success($this->status, $this->response);
        else
            Output::failure($this->status, $this->errorCode, $this->errorMessage);
    }
}
