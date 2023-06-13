<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

class DashboardClientController extends Controller {

    public function __construct(){
    }

    // Call Models and View for the main page : "/index.php" || "/"
    public function dashboardclient(Request $request, Route $route): void{
        $this->updateStyles(['dashboard_card.css']);

        // $content = $this->templateService->selectContent();
        
        $this->render("dashboardVotreEspace.php",  $this->styles ,[
            // "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}