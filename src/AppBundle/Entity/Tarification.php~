<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarification
 *
 * @ORM\Table(name="tarification", uniqueConstraints={@ORM\UniqueConstraint(name="Tarification_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="Tarification_item_id_fk", columns={"item_id"})})
 * @ORM\Entity
 */
class Tarification
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
     * @var string
     *
     * @ORM\Column(name="h_scode_commodity_code", type="string", length=20, nullable=true)
     */
    private $hScodeCommodityCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="h_scode_precision_1", type="string", length=20, nullable=true)
     */
    private $hScodePrecision1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="h_scode_precision_2", type="string", length=20, nullable=true)
     */
    private $hScodePrecision2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="h_scode_precision_3", type="string", length=20, nullable=true)
     */
    private $hScodePrecision3 = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="h_scode_precision_4", type="string", length=20, nullable=true)
     */
    private $hScodePrecision4 = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="preference_code", type="string", length=20, nullable=true)
     */
    private $preferenceCode = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="extended_customs_procedure", type="string", length=20, nullable=true)
     */
    private $extendedCustomsProcedure = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="national_customs_procedure", type="string", length=20, nullable=true)
     */
    private $nationalCustomsProcedure = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="quota_code", type="text", length=65535, nullable=true)
     */
    private $quotaCode;

    /**
     * @var string
     *
     * @ORM\Column(name="item_price", type="string", length=20, nullable=true)
     */
    private $itemPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="valuation_method_code", type="string", length=50, nullable=true)
     */
    private $valuationMethodCode = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="value_item", type="string", length=100, nullable=true)
     */
    private $valueItem = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="attached_doc_item", type="string", length=100, nullable=true)
     */
    private $attachedDocItem = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="a_i__code", type="text", length=65535, nullable=true)
     */
    private $aICode;

    /**
     * @var string
     *
     * @ORM\Column(name="supplementary_unit_code", type="string", length=50, nullable=true)
     */
    private $supplementaryUnitCode = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="supplementary_unit_name", type="string", length=50, nullable=true)
     */
    private $supplementaryUnitName = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="supplementary_unit_quantity", type="string", length=50, nullable=true)
     */
    private $supplementaryUnitQuantity = ' ';

    /**
     * @var \Item
     *
     * @ORM\OneToOne(targetEntity="Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;



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
     * Set hScodeCommodityCode
     *
     * @param string $hScodeCommodityCode
     *
     * @return Tarification
     */
    public function setHScodeCommodityCode($hScodeCommodityCode)
    {
        $this->hScodeCommodityCode = $hScodeCommodityCode;

        return $this;
    }

    /**
     * Get hScodeCommodityCode
     *
     * @return string
     */
    public function getHScodeCommodityCode()
    {
        return $this->hScodeCommodityCode;
    }

    /**
     * Set hScodePrecision1
     *
     * @param string $hScodePrecision1
     *
     * @return Tarification
     */
    public function setHScodePrecision1($hScodePrecision1)
    {
        $this->hScodePrecision1 = $hScodePrecision1;

        return $this;
    }

    /**
     * Get hScodePrecision1
     *
     * @return string
     */
    public function getHScodePrecision1()
    {
        return $this->hScodePrecision1;
    }

    /**
     * Set hScodePrecision2
     *
     * @param string $hScodePrecision2
     *
     * @return Tarification
     */
    public function setHScodePrecision2($hScodePrecision2)
    {
        $this->hScodePrecision2 = $hScodePrecision2;

        return $this;
    }

    /**
     * Get hScodePrecision2
     *
     * @return string
     */
    public function getHScodePrecision2()
    {
        return $this->hScodePrecision2;
    }

    /**
     * Set hScodePrecision3
     *
     * @param string $hScodePrecision3
     *
     * @return Tarification
     */
    public function setHScodePrecision3($hScodePrecision3)
    {
        $this->hScodePrecision3 = $hScodePrecision3;

        return $this;
    }

    /**
     * Get hScodePrecision3
     *
     * @return string
     */
    public function getHScodePrecision3()
    {
        return $this->hScodePrecision3;
    }

    /**
     * Set hScodePrecision4
     *
     * @param string $hScodePrecision4
     *
     * @return Tarification
     */
    public function setHScodePrecision4($hScodePrecision4)
    {
        $this->hScodePrecision4 = $hScodePrecision4;

        return $this;
    }

    /**
     * Get hScodePrecision4
     *
     * @return string
     */
    public function getHScodePrecision4()
    {
        return $this->hScodePrecision4;
    }

    /**
     * Set preferenceCode
     *
     * @param string $preferenceCode
     *
     * @return Tarification
     */
    public function setPreferenceCode($preferenceCode)
    {
        $this->preferenceCode = $preferenceCode;

        return $this;
    }

    /**
     * Get preferenceCode
     *
     * @return string
     */
    public function getPreferenceCode()
    {
        return $this->preferenceCode;
    }

    /**
     * Set extendedCustomsProcedure
     *
     * @param string $extendedCustomsProcedure
     *
     * @return Tarification
     */
    public function setExtendedCustomsProcedure($extendedCustomsProcedure)
    {
        $this->extendedCustomsProcedure = $extendedCustomsProcedure;

        return $this;
    }

    /**
     * Get extendedCustomsProcedure
     *
     * @return string
     */
    public function getExtendedCustomsProcedure()
    {
        return $this->extendedCustomsProcedure;
    }

    /**
     * Set nationalCustomsProcedure
     *
     * @param string $nationalCustomsProcedure
     *
     * @return Tarification
     */
    public function setNationalCustomsProcedure($nationalCustomsProcedure)
    {
        $this->nationalCustomsProcedure = $nationalCustomsProcedure;

        return $this;
    }

    /**
     * Get nationalCustomsProcedure
     *
     * @return string
     */
    public function getNationalCustomsProcedure()
    {
        return $this->nationalCustomsProcedure;
    }

    /**
     * Set quotaCode
     *
     * @param string $quotaCode
     *
     * @return Tarification
     */
    public function setQuotaCode($quotaCode)
    {
        $this->quotaCode = $quotaCode;

        return $this;
    }

    /**
     * Get quotaCode
     *
     * @return string
     */
    public function getQuotaCode()
    {
        return $this->quotaCode;
    }

    /**
     * Set itemPrice
     *
     * @param string $itemPrice
     *
     * @return Tarification
     */
    public function setItemPrice($itemPrice)
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    /**
     * Get itemPrice
     *
     * @return string
     */
    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    /**
     * Set valuationMethodCode
     *
     * @param string $valuationMethodCode
     *
     * @return Tarification
     */
    public function setValuationMethodCode($valuationMethodCode)
    {
        $this->valuationMethodCode = $valuationMethodCode;

        return $this;
    }

    /**
     * Get valuationMethodCode
     *
     * @return string
     */
    public function getValuationMethodCode()
    {
        return $this->valuationMethodCode;
    }

    /**
     * Set valueItem
     *
     * @param string $valueItem
     *
     * @return Tarification
     */
    public function setValueItem($valueItem)
    {
        $this->valueItem = $valueItem;

        return $this;
    }

    /**
     * Get valueItem
     *
     * @return string
     */
    public function getValueItem()
    {
        return $this->valueItem;
    }

    /**
     * Set attachedDocItem
     *
     * @param string $attachedDocItem
     *
     * @return Tarification
     */
    public function setAttachedDocItem($attachedDocItem)
    {
        $this->attachedDocItem = $attachedDocItem;

        return $this;
    }

    /**
     * Get attachedDocItem
     *
     * @return string
     */
    public function getAttachedDocItem()
    {
        return $this->attachedDocItem;
    }

    /**
     * Set aICode
     *
     * @param string $aICode
     *
     * @return Tarification
     */
    public function setAICode($aICode)
    {
        $this->aICode = $aICode;

        return $this;
    }

    /**
     * Get aICode
     *
     * @return string
     */
    public function getAICode()
    {
        return $this->aICode;
    }

    /**
     * Set supplementaryUnitCode
     *
     * @param string $supplementaryUnitCode
     *
     * @return Tarification
     */
    public function setSupplementaryUnitCode($supplementaryUnitCode)
    {
        $this->supplementaryUnitCode = $supplementaryUnitCode;

        return $this;
    }

    /**
     * Get supplementaryUnitCode
     *
     * @return string
     */
    public function getSupplementaryUnitCode()
    {
        return $this->supplementaryUnitCode;
    }

    /**
     * Set supplementaryUnitName
     *
     * @param string $supplementaryUnitName
     *
     * @return Tarification
     */
    public function setSupplementaryUnitName($supplementaryUnitName)
    {
        $this->supplementaryUnitName = $supplementaryUnitName;

        return $this;
    }

    /**
     * Get supplementaryUnitName
     *
     * @return string
     */
    public function getSupplementaryUnitName()
    {
        return $this->supplementaryUnitName;
    }

    /**
     * Set supplementaryUnitQuantity
     *
     * @param string $supplementaryUnitQuantity
     *
     * @return Tarification
     */
    public function setSupplementaryUnitQuantity($supplementaryUnitQuantity)
    {
        $this->supplementaryUnitQuantity = $supplementaryUnitQuantity;

        return $this;
    }

    /**
     * Get supplementaryUnitQuantity
     *
     * @return string
     */
    public function getSupplementaryUnitQuantity()
    {
        return $this->supplementaryUnitQuantity;
    }

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return Tarification
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }
}
