<?php 

namespace Service;

// Repository
use Repository\UserRepository;

// Model
use Model\UserModel;

class RegisterService{

    public function checkFirstname(string $firstname): array{
        $firstname = preg_match("`^((?:(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+)(?:-(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+))+)|(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+))$`", $firstname) ? $firstname : null ;
        if(!$firstname) { return ["Invalid firstname", null]; }
        return [null, $firstname];
    }

    public function checkLastname(string $lastname): array{
        $lastname = preg_match("`^((?:(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+)(?:-(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+))+)|(?:[a-zA-ZáâàãçéêèëïíóôõúüÁÂÀÃÇÉÈÊËÏÍÓÔÕÚÜ]+))$`", $lastname) ? $lastname : null ;
        if(!$lastname) { return ["Invalid lastname", null]; }
        return [null, $lastname];
    }

    public function checkMail(string $mail): array{
        $mail = filter_var($mail, FILTER_VALIDATE_EMAIL) ? $mail : null ;
        if(!$mail) { return ["Invalid mail", null]; }
        if($this->isUse($mail)) { return ["Mail already used", null]; }
        return [null, $mail];
    }

    public function checkBirthdate(string $birthdate): array{
        $birthdate = preg_match("`^([0-9]{4})(-)(0[1-9]|1[0-2])(-)(0[1-9]|1[0-9]|2[0-9]|3[0-1])$`", $birthdate) ? $birthdate : null ;
        if(!$birthdate) { return ["Invalid birthdate", null]; }
        $birthdate = $this->checkYears($birthdate);
        if(!$birthdate) { return ["You do not have the required age", null]; }
        return [null, $birthdate];
    }

    public function checkPassword(string $password, string $confpsd): array{
        $password = preg_match("`^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,100}$`" , $password) ? $password : false;
        $confpsd = preg_match("`^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,100}$`" , $confpsd) ? $confpsd : false;
        if(!$password || !$confpsd) { return ["The password is invalid. Please choose a password between 8 and 100 characters long, containing at least one uppercase letter, one lowercase letter, one digit, and one special character", null]; }
        $password = $this->areSimilar($password, $confpsd);
        if(!$password) { return ["The passwords do not match", null]; }
        return [null, password_hash($password, PASSWORD_DEFAULT)];
    }

    private function isUse(string $mail): bool{
        return (new UserRepository())->mailIsUse($mail);
    }

    private function checkYears(string $birthdate): ?string{
        $limit = 18;
        $age = (date('md') < date('md', strtotime($birthdate))) ? (date('Y') - date('Y', strtotime($birthdate)) - 1) : (date('Y') - date('Y', strtotime($birthdate)));
        return ($age >= $limit && $age <= 120) ? $birthdate : null;
    }

    private function areSimilar(string $password, string $confpsd): ?string{
        return ($password === $confpsd) ? $password : null;
    }

    public function registerUser(UserModel $user): void{
        (new UserRepository())->addUser($user);
    }
}
