<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CacheCodes
 *
 * @ORM\Table(name="cache_codes")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CacheCodesRepository")
 */
class CacheCodes
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_code", type="string", length=255)
     */
    private $parentCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=50)
     */
    private $unit;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * Set code
     *
     * @param string $code
     *
     * @return CacheCodes
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set parentCode
     *
     * @param string $parentCode
     *
     * @return CacheCodes
     */
    public function setParentCode($parentCode)
    {
        $this->parentCode = $parentCode;

        return $this;
    }

    /**
     * Get parentCode
     *
     * @return string
     */
    public function getParentCode()
    {
        return $this->parentCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CacheCodes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return CacheCodes
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return CacheCodes
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
