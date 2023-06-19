<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\HousingService;

use Model\UserModel;

class PublicController extends Controller {
    public function __construct(?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);
    }

    public function home(Request $request, Route $route): void {
        $this->updateStyles(['home.css']);
        $HousingService = new HousingService();

        $images = $HousingService->getRandomImg(1, 3);
        $housing = $HousingService->selectRandomHousing(3);

        $this->render("home.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "images" => $images,
            "housing" => $housing
        ]);
    }

    public function search(Request $request, Route $route): void {
        $this->updateStyles(['search.css']);
        $housingService = new HousingService();
        $housing = [];
        $error = [];
        $filter = [
            "date_start" => time()+24*60*60,
            "date_end" => time()+30*24*60*60,
            "district" => null,
            "number_pieces" => null,
            "area" => null
        ];

        foreach($housingService->selectHousing() as $h) {
            $housing_images = [];
            foreach($h->getImage() as $i){ 
                $housing_images[] = $i->getImage();
            }

            $housing[] = [
                "id" => $h->getId(),
                "name" => $h->getName(),
                "capacity" => $h->getCapacity(),
                "price" => $h->getPrice(),
                "description" => $h->getDescription(),
                "number_pieces" => $h->getNumberPieces(),
                "area" => $h->getArea(), 
                "images" => $housing_images[0]
            ];
        }

        switch($request->getMethod()) {
            case 'POST':
                [$error[], $filter['date_start'], $filter['date_end']] = $housingService->checkDate($request->getRawBody()['date_start'], $request->getRawBody()['date_end']);
                
                if($request->getRawBody()['district']) { [$error[], $filter['district']] = $housingService->checkDistrict($request->getRawBody()['district']); }
                
                if($request->getRawBody()['number_pieces']) { [$error[], $filter['number_pieces']] = $housingService->checkNbPiece($request->getRawBody()['number_pieces']); }
                
                if($request->getRawBody()['area']) { [$error[], $filter['area']] = $housingService->checkArea($request->getRawBody()['area']); }
                // $test1 = [serialize($housingService->selectHousing()[0]), serialize($housingService->selectHousing()[1]), serialize($housingService->selectHousing()[3])];
                // $test2 = [serialize($housingService->selectHousing()[1]), serialize($housingService->selectHousing()[0]), serialize($housingService->selectHousing()[2])];

                // $intersection = array_intersect($test1, $test2);
                // $finale = [];
                // foreach($intersection as $i){
                //     $finale[] = unserialize($i);
                // }

                // dump($finale);
                
                if(!$error){
                    $housing = [];
                    $post = $housingService->selectHousingForSearch($request->getRawBody()['date_start'], $request->getRawBody()['date_end'], ($request->getRawBody()['district'] !== '') ? (int)$request->getRawBody()['district'] : null, ($request->getRawBody()['number_pieces'] !== '') ? (int)$request->getRawBody()['number_pieces'] : null, ($request->getRawBody()['capacity'] !== '') ? (int)$request->getRawBody()['capacity'] : null);
                    foreach($post as $c) {
                        $housing[] = [
                            "id" => $c->getId(),
                            "name" => $c->getName(),
                            "capacity" => $c->getCapacity(),
                            "price" => $c->getPrice(),
                            "description" => $c->getDescription(),
                            "number_pieces" => $c->getNumberPieces(),
                            "area" => $c->getArea(), 
                            "images" => $c->getImage()[0]->getImage()
                        ];
                    }
                }
                break;
        }

        // dump($housing);
        // dump(json_encode($housing));

        $this->render("search.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "housing" => $housing,
            "filter" => $filter,
        ]);
    }

    public function productPage(Request $request, Route $route): void {
        $this->updateStyles(['productPage.css']);
        $HousingService = new HousingService();

        // /!\ SELECTHOUSING
        $content = $HousingService->selectHousingHome();
        
        $this->render("productPage.php", $this->styles, [
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}