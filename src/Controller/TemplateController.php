<?php 

namespace Controller;
use Controller\Controller;
use App\Request;
use Router\Route;

// Services
use Service\TemplateService;

use Model\UserModel;

class TemplateController extends Controller{
    private TemplateService $templateService;

    public function __construct(?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);
    }
    
    // Call Models and View for the main page : "/index.php" || "/"
    public function template(Request $request, Route $route): void{
        $templateService = new TemplateService();
        $this->updateStyles(['template.css']);

        $content = $templateService->selectContent();
        
        $this->render("TemplateView.php",  $this->styles ,[
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}
