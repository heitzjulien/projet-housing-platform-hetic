<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

class PrivateController extends Controller{
    public function __construct() {
    }

    public function dashboardClient(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

        // $content = $this->templateService->selectContent();

        $this->render("dashboardVotreEspace.php", $this->styles, [
            // "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function dashboardAdmin(Request $request, Route $route): void{
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

        // $content = $this->templateService->selectContent();

        $this->render("dashboardAdmin.php", $this->styles, [
                        // "start" => $content,
                        "route" => $route,
                        "request" => $request
        ]);
    }

    public function dashboardUserParametre(Request $request, Route $route): void{
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

            // $content = $this->templateService->selectContent();

            $this->render("dashboardParametre.php", $this->styles, [
                // "start" => $content,
                "route" => $route,
                "request" => $request
    ]);
    }
    
}