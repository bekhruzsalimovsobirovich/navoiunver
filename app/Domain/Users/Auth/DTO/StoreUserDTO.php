<?php

namespace App\Domain\Users\Auth\DTO;

class StoreUserDTO
{
    /**
     * @var string
     */
    private string $firstname;

    /**
     * @var string
     */
    private string $lastname;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $region;

    /**
     * @var string
     */
    private string $city;

    /**
     * @var string
     */
    private string $address;

    /**
     * @var string|null
     */
    private ?string $postal_code = null;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param array $data
     * @return StoreUserDTO
     */
    public static function fromArray(array $data): StoreUserDTO
    {
        $dto = new self();
        $dto->setFirstname($data['firstname']);
        $dto->setLastname($data['lastname']);
        $dto->setPhone($data['phone']);
        $dto->setRegion($data['region']);
        $dto->setCity($data['city']);
        $dto->setAddress($data['address']);
        $dto->setPostalCode($data['postal_code']);
        $dto->setEmail($data['email']);
        $dto->setPassword($data['password']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    /**
     * @param string|null $postal_code
     */
    public function setPostalCode(?string $postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
