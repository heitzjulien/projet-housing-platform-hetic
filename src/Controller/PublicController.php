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
        $error = ['', '', '', ''];
        $filter = [
            "date_start" => time()+24*60*60,
            "date_end" => null,
            "district" => null,
            "number_pieces" => null,
            "area" => null
        ];

        $housing = $housingService->selectHousing();

        switch($request->getMethod()) {
            case 'POST':
                [$error[0], $filter['date_start'], $filter['date_end']] = $housingService->checkDate($request->getRawBody()['date_start'], $request->getRawBody()['date_end']);
                if(!$error[0]){
                    $housing = $housingService->getHousingFilter($housing, 'date', ['date_start' => $filter['date_start'], 'date_end' => $filter['date_end']]);
                }
                
                if($request->getRawBody()['district']) { [$error[1], $filter['district']] = $housingService->checkDistrict($request->getRawBody()['district']); }
                if(!$error[1] && $request->getRawBody()['district'] != false){
                    $housing = $housingService->getHousingFilter($housing, 'district', $filter['district']);
                }
                
                if($request->getRawBody()['number_pieces']) { [$error[2], $filter['number_pieces']] = $housingService->checkNbPiece($request->getRawBody()['number_pieces']); }
                if(!$error[2] && $request->getRawBody()['number_pieces'] != false){
                    $housing = $housingService->getHousingFilter($housing, 'number_pieces', $filter['number_pieces']);
                }
                
                if($request->getRawBody()['area']) { [$error[3], $filter['area']] = $housingService->checkArea($request->getRawBody()['area']); }
                if(!$error[3] && $request->getRawBody()['area'] != false){
                    $housing = $housingService->getHousingFilter($housing, 'area', $filter['area']);
                }
        }

        $housing = $this->prepareHousing($housing);

        $this->render("search.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "housing" => $housing,
            "filter" => $filter,
        ]);
    }

    public function apartment(Request $request, Route $route): void {
        $this->updateStyles(['productPage.css']);
        $error = [];

        $housingService = new HousingService();

        [$error[], $housing] = $housingService->getHousingById($request->getQueryParams()['housing_id']);

        $error = array_filter($error, function ($value) { return $value; });
        $this->render("apartment.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "housing" => $housing
        ]);
    }

    private function prepareHousing(array $housingArray): array{
        $housing = [];

        foreach($housingArray as $h) {
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
                "exterior" => $h->getExterior(),
                "car_park" => $h->getCarPark(),
                "area" => $h->getArea(), 
                "images" => $housing_images[0],
                "city" => $h->getCity(),
                "zip" => $h->getZip(),
                "district" => $h->getDistrict(),
            ];
        }

        return $housing;
    }
}