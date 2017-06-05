<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\InvoiceRepository")
 * @ORM\HasLifecycleCallbacks()
 * @GRID\Column(id="number", type="text")
 * @GRID\Source(columns="id, number, created")
 */
class Invoice
{
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
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     * @GRID\Column(name="crated", type="date")
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
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\InvoiceItem", mappedBy="invoice", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $invoiceItem;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="invoice")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $author;

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
     * Set number
     *
     * @param string $number
     *
     * @return Invoice
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoiceItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Invoice
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Invoice
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add invoiceItem
     *
     * @param \ShopBundle\Entity\InvoiceItem $invoiceItem
     *
     * @return Invoice
     */
    public function addInvoiceItem(\ShopBundle\Entity\InvoiceItem $invoiceItem)
    {
        $this->invoiceItem[] = $invoiceItem;

        return $this;
    }

    /**
     * Remove invoiceItem
     *
     * @param \ShopBundle\Entity\InvoiceItem $invoiceItem
     */
    public function removeInvoiceItem(\ShopBundle\Entity\InvoiceItem $invoiceItem)
    {
        $this->invoiceItem->removeElement($invoiceItem);
    }

    /**
     * Get invoiceItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoiceItem()
    {
        return $this->invoiceItem;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $author
     *
     * @return Invoice
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
