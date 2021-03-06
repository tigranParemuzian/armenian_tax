<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item", uniqueConstraints={@ORM\UniqueConstraint(name="item_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="item_booking_id_fk", columns={"booking_id"})})
 * @ORM\Entity
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_packages", type="integer", nullable=true)
     */
    private $numberOfPackages = null;

    /**
     * @var string
     *
     * @ORM\Column(name="kind_of_packages_code", type="string", length=255, nullable=true)
     */
    private $kindOfPackagesCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="kind_of_packages_name", type="string", length=255, nullable=true)
     */
    private $kindOfPackagesName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="country_of_origin_code", type="string", length=20, nullable=true)
     */
    private $countryOfOriginCode = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="specification_code_description", type="string", length=200, nullable=true)
     */
    private $specificationCodeDescription = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="summary_declaration", type="string", length=100, nullable=true)
     */
    private $summaryDeclaration = ' ';

    /**
     * @var float
     *
     * @ORM\Column(name="gross_weight_itm", type="float", precision=10, scale=0, nullable=true)
     */
    private $grossWeightItm;

    /**
     * @var float
     *
     * @ORM\Column(name="net_weight_itm", type="float", precision=10, scale=0, nullable=true)
     */
    private $netWeightItm;

    /**
     * @var string
     *
     * @ORM\Column(name="total_cost_itm", type="string", length=100, nullable=true)
     */
    private $totalCostItm = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="total_cif_itm", type="string", length=20, nullable=true)
     */
    private $totalCifItm = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="rate_of_adjustement", type="string", length=20, nullable=true)
     */
    private $rateOfAdjustement = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="statistical_value", type="string", length=20, nullable=true)
     */
    private $statisticalValue = ' ';

    /**
     * @var \Booking
     *
     * @ORM\ManyToOne(targetEntity="Booking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     * })
     */
    private $booking;


    /**
     * @var
     * @ORM\Column(name="description_of_goods", type="string")
     */
    private $descriptionOfGoods = ' ';

    /**
     * @var
     * @ORM\OneToOne(targetEntity="Tarification", mappedBy="item")
     */
    private $tarification;

    /**
     * @var
     * @ORM\Column(name="item_number", type="integer")
     */
    private $itemNumber;

    /**
     * @var
     * @ORM\Column(name="amount_national_currency", type="string", nullable=true)
     */
    private $amountNationalCurrency;

    /**
     * @return mixed
     */
    public function getAmountNationalCurrency()
    {
        return $this->amountNationalCurrency;
    }

    /**
     * @param mixed $amountNationalCurrency
     */
    public function setAmountNationalCurrency($amountNationalCurrency)
    {
        $this->amountNationalCurrency = $amountNationalCurrency;
    }


    /**
     * @return mixed
     */
    public function getDescriptionOfGoods()
    {
        return $this->descriptionOfGoods;
    }

    /**
     * @param mixed $descriptionOfGoods
     */
    public function setDescriptionOfGoods($descriptionOfGoods)
    {
        $this->descriptionOfGoods = $descriptionOfGoods;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numberOfPackages
     *
     * @param integer $numberOfPackages
     *
     * @return Item
     */
    public function setNumberOfPackages($numberOfPackages)
    {
        $this->numberOfPackages = $numberOfPackages;

        return $this;
    }

    /**
     * Get numberOfPackages
     *
     * @return integer
     */
    public function getNumberOfPackages()
    {
        return $this->numberOfPackages;
    }

    /**
     * Set kindOfPackagesCode
     *
     * @param string $kindOfPackagesCode
     *
     * @return Item
     */
    public function setKindOfPackagesCode($kindOfPackagesCode)
    {
        $this->kindOfPackagesCode = $kindOfPackagesCode;

        return $this;
    }

    /**
     * Get kindOfPackagesCode
     *
     * @return string
     */
    public function getKindOfPackagesCode()
    {
        return $this->kindOfPackagesCode;
    }

    /**
     * Set kindOfPackagesName
     *
     * @param string $kindOfPackagesName
     *
     * @return Item
     */
    public function setKindOfPackagesName($kindOfPackagesName)
    {
        $this->kindOfPackagesName = $kindOfPackagesName;

        return $this;
    }

    /**
     * Get kindOfPackagesName
     *
     * @return string
     */
    public function getKindOfPackagesName()
    {
        return $this->kindOfPackagesName;
    }

    /**
     * Set countryOfOriginCode
     *
     * @param string $countryOfOriginCode
     *
     * @return Item
     */
    public function setCountryOfOriginCode($countryOfOriginCode)
    {
        $this->countryOfOriginCode = $countryOfOriginCode;

        return $this;
    }

    /**
     * Get countryOfOriginCode
     *
     * @return string
     */
    public function getCountryOfOriginCode()
    {
        return $this->countryOfOriginCode;
    }

    /**
     * Set specificationCodeDescription
     *
     * @param string $specificationCodeDescription
     *
     * @return Item
     */
    public function setSpecificationCodeDescription($specificationCodeDescription)
    {
        $this->specificationCodeDescription = $specificationCodeDescription;

        return $this;
    }

    /**
     * Get specificationCodeDescription
     *
     * @return string
     */
    public function getSpecificationCodeDescription()
    {
        return $this->specificationCodeDescription;
    }

    /**
     * Set summaryDeclaration
     *
     * @param string $summaryDeclaration
     *
     * @return Item
     */
    public function setSummaryDeclaration($summaryDeclaration)
    {
        $this->summaryDeclaration = $summaryDeclaration;

        return $this;
    }

    /**
     * Get summaryDeclaration
     *
     * @return string
     */
    public function getSummaryDeclaration()
    {
        return $this->summaryDeclaration;
    }

    /**
     * Set grossWeightItm
     *
     * @param float $grossWeightItm
     *
     * @return Item
     */
    public function setGrossWeightItm($grossWeightItm)
    {
        $this->grossWeightItm = $grossWeightItm;

        return $this;
    }

    /**
     * Get grossWeightItm
     *
     * @return float
     */
    public function getGrossWeightItm()
    {
        return $this->grossWeightItm;
    }

    /**
     * Set netWeightItm
     *
     * @param float $netWeightItm
     *
     * @return Item
     */
    public function setNetWeightItm($netWeightItm)
    {
        $this->netWeightItm = $netWeightItm;

        return $this;
    }

    /**
     * Get netWeightItm
     *
     * @return float
     */
    public function getNetWeightItm()
    {
        return $this->netWeightItm;
    }

    /**
     * Set totalCostItm
     *
     * @param string $totalCostItm
     *
     * @return Item
     */
    public function setTotalCostItm($totalCostItm)
    {
        $this->totalCostItm = $totalCostItm;

        return $this;
    }

    /**
     * Get totalCostItm
     *
     * @return string
     */
    public function getTotalCostItm()
    {
        return $this->totalCostItm;
    }

    /**
     * Set totalCifItm
     *
     * @param string $totalCifItm
     *
     * @return Item
     */
    public function setTotalCifItm($totalCifItm)
    {
        $this->totalCifItm = $totalCifItm;

        return $this;
    }

    /**
     * Get totalCifItm
     *
     * @return string
     */
    public function getTotalCifItm()
    {
        return $this->totalCifItm;
    }

    /**
     * Set rateOfAdjustement
     *
     * @param string $rateOfAdjustement
     *
     * @return Item
     */
    public function setRateOfAdjustement($rateOfAdjustement)
    {
        $this->rateOfAdjustement = $rateOfAdjustement;

        return $this;
    }

    /**
     * Get rateOfAdjustement
     *
     * @return string
     */
    public function getRateOfAdjustement()
    {
        return $this->rateOfAdjustement;
    }

    /**
     * Set statisticalValue
     *
     * @param string $statisticalValue
     *
     * @return Item
     */
    public function setStatisticalValue($statisticalValue)
    {
        $this->statisticalValue = $statisticalValue;

        return $this;
    }

    /**
     * Get statisticalValue
     *
     * @return string
     */
    public function getStatisticalValue()
    {
        return $this->statisticalValue;
    }

    /**
     * Set booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Item
     */
    public function setBooking(\AppBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \AppBundle\Entity\Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    public function __toString()
    {
        return $this->id ? $this->descriptionOfGoods : 'new item';
        // TODO: Implement __toString() method.
    }

    /**
     * Set tarification
     *
     * @param \AppBundle\Entity\Tarification $tarification
     *
     * @return Item
     */
    public function setTarification(\AppBundle\Entity\Tarification $tarification = null)
    {
        $this->tarification = $tarification;

        return $this;
    }

    /**
     * Get tarification
     *
     * @return \AppBundle\Entity\Tarification
     */
    public function getTarification()
    {
        return $this->tarification;
    }

    /**
     * Set itemNumber
     *
     * @param integer $itemNumber
     *
     * @return Item
     */
    public function setItemNumber($itemNumber)
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    /**
     * Get itemNumber
     *
     * @return integer
     */
    public function getItemNumber()
    {
        return $this->itemNumber;
    }
}
