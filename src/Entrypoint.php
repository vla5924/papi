<?php

namespace PAPI;

use PAPI\UnknownMethod;

class Entrypoint
{
    protected $namespace;
    protected $whitelist = null;

    public function __construct(string $namespace, array $whitelist = null)
    {
        $this->namespace = $namespace;
        $this->whitelist = $whitelist;
    }

    protected function checkWhitelist(string $module, string $method): bool
    {
        if (!$this->whitelist)
            return true;
        if (isset($this->whitelist[$module]) and (isset($this->whitelist[$module][$method]) or empty($this->whitelist[$module]))) 
            return true;
        return false;
    }

    public function run(array $parameters = []): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $uri);
        if (count($parts) < 2)
            throw new \Error('Invalid request URI.');
        $parts = array_slice($parts, -2);
        $module = ucfirst($parts[0]);
        $method = ucfirst($parts[1]);
        if (!$this->checkWhitelist($module, $method)) {
            (new UnknownMethod)->fire();
            return;
        }
        $classname = '\\' . $this->namespace . '\\' . $module . '\\' . $method;
        if (!class_exists($classname)) {
            (new UnknownMethod)->fire();
            return;
        }
        $methodObject = new $classname;
        if (!is_subclass_of($methodObject, '\\PAPI\\Method'))
            throw new \Error('Module is not PAPI-based.');
        $methodObject->fire($parameters);
    }
}
