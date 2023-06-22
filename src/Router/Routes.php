<?php

namespace Router;

use App\Request;
use Router\Route;

// Controllers
use Controller\TemplateController;
use Controller\AuthController;
use Controller\PrivateController;
use Controller\PublicController;


class Routes {
    private array $routes = [];

    public function __construct(){
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

        $this->addRoute(
            (new Route("logout", AuthController::class, "logout"))
        );

        $this->addRoute(
            (new Route("delete", AuthController::class, "delete"))
        );
        
        $this->addRoute(
            (new Route("home", PublicController::class, "home"))
            ->setTitle("Home")
        );

        $this->addRoute(
            (new Route("dashboard", PrivateController::class, "dashboard"))
            ->setTitle("Dashboard")
        );

        $this->addRoute(
            (new Route("dashboard/parametre", PrivateController::class, "dashboardParametre"))
            ->setTitle("Parametre")
        );

        $this->addRoute(
            (new Route("dashboard/parametre", PrivateController::class, "dashboardParametre"))
            ->setMethod("POST")->setTitle("Parametre")
        );

        $this->addRoute(
            (new Route("dashboard/reservation", PrivateController::class, "dashboardReservation"))
            ->setMethod("POST")->setTitle("Reservation")
        );

        $this->addRoute(
            (new Route("dashboard/reservation", PrivateController::class, "dashboardReservation"))
            ->setTitle("Reservation")
        );

        $this->addRoute(
            (new Route("dashboard/reservation/delete", PrivateController::class, "dashboardReservationDelete"))
            ->setTitle("Reservation")
        );

        $this->addRoute(
            (new Route("search", PublicController::class, "search"))
            ->setTitle("Search")
        );

        $this->addRoute(
            (new Route("search", PublicController::class, "search"))
            ->setMethod("POST")->setTitle("Search")
        );

        $this->addRoute(
            (new Route("apartment", PublicController::class, "apartment"))
            ->setTitle("Apartment")
        );

        $this->addRoute(
            (new Route("apartment", PublicController::class, "apartment"))
            ->setMethod("POST")->setTitle("Apartment")
        );

        $this->addRoute(
            (new Route("gestion", PrivateController::class, "gestion"))
            ->setTitle("Gestion")
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
