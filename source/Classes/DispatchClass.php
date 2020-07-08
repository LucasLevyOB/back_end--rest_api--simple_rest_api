<?php
namespace Classes;

use Classes\RouteDispatherClass;

class DispatchClass extends RouteDispatherClass
{
    private string $controllerCalled;
    private string $namespace;
    private object $objectControllerCalled;

    public function __construct()
    {
        // $this->addController();
    }

    public function addController()
    {
        $this->controllerCalled = $this->getRoute();
        $this->namespace = "Controllers\\{$this->controllerCalled}";
        return $this->objectControllerCalled = new $this->namespace;
    }
}