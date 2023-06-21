<?php

namespace Model;

use Model\Model;

class UserModel extends Model{
    /**
     * UserModel constructor.
     *
     * @param ?int $id User id
     * @param ?string $firstname User firstname
     * @param ?string $lastname User lastname
     * @param ?string $mail User mail
     * @param ?string $password User password
     * @param ?string $birthdate User birthdate
     * @param ?array $roles User roles
     * @param ?string $account_date User account_date
     * @param ?string $account_status User account_status
     * @param ?string $last_seen User last_seen
     */
    public function __construct(
        private ?int $id = null,
        private ?string $firstname = null,
        private ?string $lastname = null,
        private ?string $mail = null,
        private ?string $password = null,
        private ?string $birthdate = null,
        private ?array $roles = null,
        private ?string $account_date = null,
        private ?string $account_status = null,
        private ?string $last_seen = null,
    ){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mail = $mail;
        $this->password = $password;
        $this->birthdate = $birthdate;
        $this->roles = $roles;
        $this->account_date = $account_date;
        $this->account_status = $account_status;
        $this->last_seen = $last_seen;
    }

    public function isAdmin(): bool {
        if ($this->roles[0] === "admin" ||$this->roles[1] === "admin") {
            return true;
        } else {
            return false;
        }
    }
    public function getId(): int{
        return $this->id;
    }

    public function getFirstname(): ?string{
        return $this->firstname;
    }

    public function getLastname(): ?string{
        return $this->lastname;
    }

    public function getMail(): ?string{
        return $this->mail;
    }

    public function getPassword(): ?string{
        return $this->password;
    }
    
    public function getBirthdate(): ?string{
        return $this->birthdate;
    }

    public function getAccountStatus(): ?string{
        return $this->account_status;
    }

    public function setFirstname($firstname): self{
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname): self{
        $this->lastname = $lastname;
        return $this;
    }

    public function setMail($mail): self{
        $this->mail = $mail;
        return $this;
    }

    public function setPassword($password): self{
        $this->password = $password;
        return $this;
    }
    
    public function setBirthdate($birthdate): self{
        $this->birthdate = $birthdate;
        return $this;
    }

}
