<?php 
namespace Classes;

class RoutesClass
{
    private array $routes;

    private function setRoutes()
    {
        $this->routes = array(
            '' => 'Error400Controller',
            'produtos' => 'ProductController'
        );
    }

    protected function getRoutes()
    {
        $this->setRoutes();
        return $this->routes;
    }

}