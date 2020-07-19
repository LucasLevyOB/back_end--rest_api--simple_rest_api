<?php 
namespace Traits;

trait UrlParserTrait
{
    protected function parseUrl(){
        return explode('/', rtrim($_GET['url']), FILTER_SANITIZE_URL);
    }

    public function getIdUrl(array $url)
    {
        return end($url);
    }
}