<?php

namespace SimpleAPI\SimpleModule;

class SimpleMethod extends \PAPI\Method
{
    protected function execute(array $parameters): void
    {
        $this->status = 200;
        $this->response = $parameters;
    }
}
