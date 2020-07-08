<?php 
namespace Classes;

use Classes\RoutesClass;
use Traits\UrlParserTrait;

class RouteDispatherClass extends RoutesClass
{
    use UrlParserTrait;
    private array $routes;
    private array $url;
    private string $initialIndex;
    private string $archive;

    private function initializeValues()
    {
        $this->routes = $this->getRoutes();
        $this->url = $this->parseUrl();
        $this->initialIndex = $this->url[0];
    }

    private function verifyRoute()
    {
        if (array_key_exists($this->initialIndex, $this->routes)) {
            $this->archive = DIRREC. "app/Controllers/{$this->routes[$this->initialIndex]}.php";
            if (file_exists($this->archive)) {
                return $this->routes[$this->initialIndex];
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                json_encode(array('response' => 'Desculpe sua requisicao nao pode ser atendida.'));
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            json_encode(array('response' => 'Requisicao incorreta.'));
        }
    }

    public function getRoute()
    {
        $this->initializeValues();
        return $this->verifyRoute();
    }
}