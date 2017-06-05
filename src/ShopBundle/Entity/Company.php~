<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_code", type="string", length=255, nullable=true, unique=true)
     */
    private $taxCode;

    /**
     * @var string
     *
     * @ORM\Column(name="web_page", type="string", length=255, nullable=true)
     */
    private $webPage;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\CompanyCategory", inversedBy="company")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $category;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Address", inversedBy="company")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $address;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Person", mappedBy="company",  cascade={"all"}, orphanRemoval=true)
     */
    private $person;

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

    public function __toString()
    {
        return $this->id ? $this->name : 'New Company';
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
     * Set name
     *
     * @param string $name
     *
     * @return Company
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
     * Set taxCode
     *
     * @param string $taxCode
     *
     * @return Company
     */
    public function setTaxCode($taxCode)
    {
        $this->taxCode = $taxCode;

        return $this;
    }

    /**
     * Get taxCode
     *
     * @return string
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }

    /**
     * Set webPage
     *
     * @param string $webPage
     *
     * @return Company
     */
    public function setWebPage($webPage)
    {
        $this->webPage = $webPage;

        return $this;
    }

    /**
     * Get webPage
     *
     * @return string
     */
    public function getWebPage()
    {
        return $this->webPage;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Company
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Company
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
     * @return Company
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
     * Set category
     *
     * @param \ShopBundle\Entity\CompanyCategory $category
     *
     * @return Company
     */
    public function setCategory(\ShopBundle\Entity\CompanyCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ShopBundle\Entity\CompanyCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set address
     *
     * @param \ShopBundle\Entity\Address $address
     *
     * @return Company
     */
    public function setAddress(\ShopBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \ShopBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add person
     *
     * @param \ShopBundle\Entity\Person $person
     *
     * @return Company
     */
    public function addPerson(\ShopBundle\Entity\Person $person)
    {
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \ShopBundle\Entity\Person $person
     */
    public function removePerson(\ShopBundle\Entity\Person $person)
    {
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }
}
