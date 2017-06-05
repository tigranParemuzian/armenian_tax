<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ReferenceItem
 *
 * @ORM\Table(name="reference_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReferenceItemRepository")
 */
class ReferenceItem
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
     * @var
     * @ORM\Column(name="name", type="string")
     * @Assert\NotNull(message="name can`t be null")
     */
    private $name;

    /**
     * @var
     * @ORM\Column(name="name_ru", type="string")
     * @Assert\NotNull(message="name other can`t be null")
     */
    private $nameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=15)
     * @Assert\NotNull(message="code can`t be null")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_code", type="string", length=6, nullable=true)
     */
    private $parentCode;

    /**
     * @var float
     *
     * @ORM\Column(name="count", type="float")
     * @Assert\NotNull(message="country can`t be null")
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(name="pakage_quantity", type="float")
     * @Assert\NotNull(message="country can`t be null")
     */
    private $pakageQuantity;

    /**
     * @var float
     *
     * @ORM\Column(name="brutto", type="float")
     * @Assert\NotNull(message="Product brutto can`t be null")
     */
    private $brutto;

    /**
     * @var string
     *
     * @ORM\Column(name="netto", type="string", length=255)
     * @Assert\NotNull(message="Product netto can`t be null")
     */
    private $netto;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\NotNull(message="Price can`t be null")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="tax_price", type="float")
     */
    private $taxPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=5)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=255)
     */
    private $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name", type="string", length=5)
     */
    private $currencyName;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_rate", type="float")
     */
    private $currencyRate;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_name", type="string", length=100)
     */
    private $unitName;

    /**
     * @var int
     *
     * @ORM\Column(name="unit_code", type="integer")
     */
    private $unitCode;

    /**
     * @var
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Reference", inversedBy="referenceItem")
     * @ORM\JoinColumn(name="reference_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $reference;

    /**
     * @var
     * @ORM\Column(name="calc_by_weight", type="float")
     */
    private $calcByWeight;

    /**
     * @var
     * @ORM\Column(name="calc_by_count", type="float")
     */
    private $calcByCount;

    /**
     * @var
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var
     * @ORM\Column(name="company_from", type="string", length=255)
     */
    private $companyFrom;


    public function __toString()
    {
        return $this->id ? $this->name : 'New Reference Item';
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
     * Set code
     *
     * @param string $code
     *
     * @return ReferenceItem
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
     * @return ReferenceItem
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
     * Set count
     *
     * @param float $count
     *
     * @return ReferenceItem
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return float
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set brutto
     *
     * @param float $brutto
     *
     * @return ReferenceItem
     */
    public function setBrutto($brutto)
    {
        $this->brutto = $brutto;

        return $this;
    }

    /**
     * Get brutto
     *
     * @return float
     */
    public function getBrutto()
    {
        return $this->brutto;
    }

    /**
     * Set netto
     *
     * @param string $netto
     *
     * @return ReferenceItem
     */
    public function setNetto($netto)
    {
        $this->netto = $netto;

        return $this;
    }

    /**
     * Get netto
     *
     * @return string
     */
    public function getNetto()
    {
        return $this->netto;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ReferenceItem
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

    /**
     * Set taxPrice
     *
     * @param float $taxPrice
     *
     * @return ReferenceItem
     */
    public function setTaxPrice($taxPrice)
    {
        $this->taxPrice = $taxPrice;

        return $this;
    }

    /**
     * Get taxPrice
     *
     * @return float
     */
    public function getTaxPrice()
    {
        return $this->taxPrice;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return ReferenceItem
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return ReferenceItem
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set currencyName
     *
     * @param string $currencyName
     *
     * @return ReferenceItem
     */
    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * Get currencyName
     *
     * @return string
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    /**
     * Set currencyRate
     *
     * @param string $currencyRate
     *
     * @return ReferenceItem
     */
    public function setCurrencyRate($currencyRate)
    {
        $this->currencyRate = $currencyRate;

        return $this;
    }

    /**
     * Get currencyRate
     *
     * @return string
     */
    public function getCurrencyRate()
    {
        return $this->currencyRate;
    }

    /**
     * Set unitName
     *
     * @param string $unitName
     *
     * @return ReferenceItem
     */
    public function setUnitName($unitName)
    {
        $this->unitName = $unitName;

        return $this;
    }

    /**
     * Get unitName
     *
     * @return string
     */
    public function getUnitName()
    {
        return $this->unitName;
    }

    /**
     * Set unitCode
     *
     * @param integer $unitCode
     *
     * @return ReferenceItem
     */
    public function setUnitCode($unitCode)
    {
        $this->unitCode = $unitCode;

        return $this;
    }

    /**
     * Get unitCode
     *
     * @return int
     */
    public function getUnitCode()
    {
        return $this->unitCode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameRu()
    {
        return $this->nameRu;
    }

    /**
     * @param mixed $nameRu
     */
    public function setNameRu($nameRu)
    {
        $this->nameRu = $nameRu;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Set reference
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return ReferenceItem
     */
    public function setReference(\AppBundle\Entity\Reference $reference = null)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return \AppBundle\Entity\Reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getCalcByWeight()
    {
        return round($this->calcByWeight, 2);
    }

    /**
     * @param mixed $calcByWeight
     */
    public function setCalcByWeight($calcByWeight)
    {
        $this->calcByWeight = $calcByWeight;
    }

    /**
     * @return mixed
     */
    public function getCalcByCount()
    {
        return round($this->calcByCount, 2);
    }

    /**
     * @param mixed $calcByCount
     */
    public function setCalcByCount($calcByCount)
    {
        $this->calcByCount = $calcByCount;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyFrom()
    {
        return $this->companyFrom;
    }

    /**
     * @param mixed $companyFrom
     */
    public function setCompanyFrom($companyFrom)
    {
        $this->companyFrom = $companyFrom;
    }

    /**
     * @return float
     */
    public function getPakageQuantity()
    {
        return $this->pakageQuantity;
    }

    /**
     * @param float $pakageQuantity
     */
    public function setPakageQuantity($pakageQuantity)
    {
        $this->pakageQuantity = $pakageQuantity;
    }
}
