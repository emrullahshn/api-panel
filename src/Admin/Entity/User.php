<?php

namespace App\Admin\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    protected $address;

    /**
     * @var int
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    protected $countryId;

    /**
     * @var int
     * @ORM\Column(name="city_id", type="integer", nullable=true)
     */
    protected $cityId;

    /**
     * @var int
     * @ORM\Column(name="town_id", type="integer", nullable=true)
     */
    protected $townId;

    /**
     * @var string
     * @ORM\Column(name="phone_number", type="string", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string
     * @ORM\Column(name="company_name", type="string", nullable=true)
     */
    protected $companyName;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     * @return User
     */
    public function setCityId(int $cityId): User
    {
        $this->cityId = $cityId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return User
     */
    public function setCompanyName(string $companyName): User
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     * @return User
     */
    public function setCountryId(int $countryId): User
    {
        $this->countryId = $countryId;
        return $this;
    }

    /**
     * User constructor.
     * @param $id
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber(string $phoneNumber): User
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getTownId(): int
    {
        return $this->townId;
    }

    /**
     * @param int $townId
     * @return User
     */
    public function setTownId(int $townId): User
    {
        $this->townId = $townId;
        return $this;
    }
}
