<?php

namespace Router;

use App\Request;
use Router\Route;

// Controllers
use Controller\TemplateController;
use Controller\AuthController;

class Routes {
    private array $routes = [];

    public function __construct(){
        $this->addRoute(
            (new Route("template", TemplateController::class, "template"))
            ->setTitle("Template")
        );
        
        $this->addRoute(
            (new Route("login", AuthController::class, "login"))
            ->setTitle("Login")
        );
        
        $this->addRoute(
            (new Route("login", AuthController::class, "login"))
            ->setMethod("POST")->setTitle("Login")
        );

        $this->addRoute(
            (new Route("register", AuthController::class, "register"))
            ->setTitle("Register")
        );
        
        $this->addRoute(
            (new Route("register", AuthController::class, "register"))
            ->setMethod("POST")->setTitle("Register")
        );
    }

    public function addRoute(Route $route): void{
        array_push($this->routes, $route);
    }

    public function getRoute(string $method, string $url): ?Route{
        foreach ($this->routes as $route){
            if($method == $route->getMethod() && $url == $route->getUrl()){
                return $route;
            }
        }
        return null;
    }
}
