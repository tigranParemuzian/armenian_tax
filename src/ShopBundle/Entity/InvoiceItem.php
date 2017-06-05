<?php

namespace ShopBundle\Entity;

use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * InvoiceItem
 *
 * @ORM\Table(name="invoice_item")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\InvoiceItemRepository")
 * @ORM\HasLifecycleCallbacks()
 * @GRID\Column(id="name", type="text")
 * @GRID\Source(columns="id, name, count, unit, price, curency, netto, brutto, country, package, description, invoice.number")
 *
 */
class InvoiceItem
{
    const IS_INACTIVE = 0;
    const IS_ACTIVE = 1;
    const IS_GROUPED = 2;
    const IS_NOT_GROUPED = 3;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false)
     */
    private $id;

    /**
     * @var
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotNull(message="product name can`t be null")
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="count", type="float")
     * @GRID\Column(name="Count", attr={"contenteditable":"true"})
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\NotNull(message="product name can`t be null")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="curency", type="string", length=20)
     */
    private $curency;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=50)
     */
    private $unit;

    /**
     * @var float
     *
     * @ORM\Column(name="netto", type="float")
     *
     */
    private $netto;

    /**
     * @var float
     *
     * @ORM\Column(name="brutto", type="float")
     */
    private $brutto;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="single_price", type="string", length=255)
     */
    private $singlePrice;

    /**
     * @var
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

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
     * @ORM\Column(name="package", type="float", nullable=true)
     */
    private $package;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Invoice", inversedBy="invoiceItem")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $invoice;

    /**
     * @var
     * @ORM\Column(name="parents", type="text", nullable=true)
     */
    private $parents;

    public function __toString()
    {
        return $this->id ? $this->name : 'New Item';
        // TODO: Implement __toString() method.
    }

    public function __construct()
    {
        $this->state = self::IS_ACTIVE;
        $this->type = self::IS_NOT_GROUPED;
        $this->unit = 'Հատ';
        $this->country = 'CN';
        $this->curency = 'USD';
        $this->netto = 0;
        $this->brutto = 0;
        $this->price = 0;
        $this->singlePrice = 0;
        $this->name = 'Product Name';
        $this->package = 0;
        $this->description = 'Product description';

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
     * Set name
     *
     * @param string $name
     *
     * @return InvoiceItem
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
     * Set count
     *
     * @param float $count
     *
     * @return InvoiceItem
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
     * Set price
     *
     * @param float $price
     *
     * @return InvoiceItem
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
     * Set curency
     *
     * @param string $curency
     *
     * @return InvoiceItem
     */
    public function setCurency($curency)
    {
        $this->curency = $curency;

        return $this;
    }

    /**
     * Get curency
     *
     * @return string
     */
    public function getCurency()
    {
        return $this->curency;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return InvoiceItem
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
     * Set netto
     *
     * @param float $netto
     *
     * @return InvoiceItem
     */
    public function setNetto($netto)
    {
        $this->netto = $netto;

        return $this;
    }

    /**
     * Get netto
     *
     * @return float
     */
    public function getNetto()
    {
        return $this->netto;
    }

    /**
     * Set brutto
     *
     * @param float $brutto
     *
     * @return InvoiceItem
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
     * Set country
     *
     * @param string $country
     *
     * @return InvoiceItem
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set singlePrice
     *
     * @param string $singlePrice
     *
     * @return InvoiceItem
     */
    public function setSinglePrice($singlePrice)
    {
        $this->singlePrice = $singlePrice;

        return $this;
    }

    /**
     * Get singlePrice
     *
     * @return string
     */
    public function getSinglePrice()
    {
        return $this->singlePrice;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return InvoiceItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
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
     * Set invoice
     *
     * @param \ShopBundle\Entity\Invoice $invoice
     *
     * @return InvoiceItem
     */
    public function setInvoice(\ShopBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \ShopBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    /**
     * @return mixed
     */
    public function getParents()
    {
        return json_decode($this->parents, true);
    }

    /**
     * @param mixed $parents
     */
    public function setParents($parents)
    {
        $this->parents = json_encode($parents);
    }
}
