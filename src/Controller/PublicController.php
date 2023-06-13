<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

class PublicController extends Controller {
    public function __construct() {
    }

    public function home(Request $request, Route $route):void {
        $this->updateStyles(['home.css']);

        // $content = $this->templateService->selectContent();

        $this->render("home.php", $this->styles, [
            // "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}