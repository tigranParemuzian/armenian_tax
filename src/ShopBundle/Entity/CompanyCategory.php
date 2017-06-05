<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyCategory
 *
 * @ORM\Table(name="company_category")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CompanyCategoryRepository")
 */
class CompanyCategory
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
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_enabled", type="boolean")
     */
    private $isEnabled;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Company", mappedBy="category",  cascade={"all"}, orphanRemoval=true)
     */
    private $company;

    public function __toString()
    {

        return $this->id ? $this->category : 'New Category';
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
     * Set category
     *
     * @param string $category
     *
     * @return CompanyCategory
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return CompanyCategory
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return bool
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
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
     * @return CompanyCategory
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
