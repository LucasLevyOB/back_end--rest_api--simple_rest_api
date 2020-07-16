<?php 
namespace Classes;

use Classes\RoutesClass;

use Traits\UrlParserTrait;
use Traits\ValidationTrait;
use Traits\MessageHTTPTrait;

class RouteDispatherClass extends RoutesClass
{
    use UrlParserTrait;
    use ValidationTrait;
    use MessageHTTPTrait;

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

    private function checkRoute()
    {
        if ($this->checkKeyExistsInArray($this->initialIndex, $this->routes)) {
            $fileController = $this->routes[$this->initialIndex]. '.php';
            $pathToFile = DIRREC. 'app/Controllers/';
            if ($this->checkFileExists($fileController, $pathToFile)) {
                return $this->routes[$this->initialIndex];
            } else {
                return 'Error500Controller';
            }
        } else {
            return 'Error400Controller';
        }
    }

    public function getRoute()
    {
        $this->initializeValues();
        return $this->checkRoute();
    }
}