<?php

namespace Model;

class UserModel{
    private string $firstname;
    private string $lastname;
    private string $mail;
    private string $birthdate;
    private string $password;

    public function __construct($firstname, $lastname, $mail, $birthdate, $password){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mail = $mail;
        $this->birthdate = $birthdate;
        $this->password = $password;
    }

    public function getFirstname(): string{
        return $this->firstname;
    }

    public function getLastname(): string{
        return $this->lastname;
    }

    public function getMail(): string{
        return $this->mail;
    }

    public function getBirthdate(): string{
        return $this->birthdate;
    }

    public function getPassword(): string{
        return $this->password;
    }

}
