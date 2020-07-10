<?php 
namespace Classes;

class RoutesClass
{
    private array $routes;

    private function setRoutes()
    {
        $this->routes = array(
            '' => 'Error400Controller',
            'produto' => 'ProductController',
            'produtoa' => 'ProductController1'
        );
    }

    protected function getRoutes()
    {
        $this->setRoutes();
        return $this->routes;
    }

}