<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=50, nullable=true)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=50, nullable=true)
     */
    private $lng;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_main", type="boolean")
     */
    private $isMain;

    /**
     * @var string
     *
     * @ORM\Column(name="building", type="string", length=50, nullable=true)
     */
    private $building;

    /**
     * @var string
     *
     * @ORM\Column(name="house", type="string", length=50, nullable=true)
     */
    private $house;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Company", mappedBy="address",  cascade={"all"}, orphanRemoval=true)
     */
    private $company;

    public function __toString()
    {
     return $this->id ? $this->address . ' ' . $this->building . $this->house : 'new Address';
        // TODO: Implement __toString() method.
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Address
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Address
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return Address
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return bool
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Set building
     *
     * @param string $building
     *
     * @return Address
     */
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set house
     *
     * @param string $house
     *
     * @return Address
     */
    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return string
     */
    public function getHouse()
    {
        return $this->house;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->company = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add company
     *
     * @param \ShopBundle\Entity\Company $company
     *
     * @return Address
     */
    public function addCompany(\ShopBundle\Entity\Company $company)
    {
        $this->company[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \ShopBundle\Entity\Company $company
     */
    public function removeCompany(\ShopBundle\Entity\Company $company)
    {
        $this->company->removeElement($company);
    }

    /**
     * Get company
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompany()
    {
        return $this->company;
    }
}
