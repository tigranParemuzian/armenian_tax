<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Position
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\PersonRepository")
 */
class Person
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
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotNull()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;
    
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Emails", inversedBy="person")
     * @ORM\JoinColumn(name="email_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $email;
    
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Phone", inversedBy="person")
     * @ORM\JoinColumn(name="phone_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $phone;
    
    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Position", inversedBy="person")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $position;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="ShopBundle\Entity\Company", inversedBy="person")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $company;

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
        return $this->id ? $this->firstName : 'New Person';
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Person
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
     * @return Person
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
     * Set email
     *
     * @param \ShopBundle\Entity\Emails $email
     *
     * @return Person
     */
    public function setEmail(\ShopBundle\Entity\Emails $email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return \ShopBundle\Entity\Emails
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param \ShopBundle\Entity\Phone $phone
     *
     * @return Person
     */
    public function setPhone(\ShopBundle\Entity\Phone $phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return \ShopBundle\Entity\Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set position
     *
     * @param \ShopBundle\Entity\Position $position
     *
     * @return Person
     */
    public function setPosition(\ShopBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \ShopBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set company
     *
     * @param \ShopBundle\Entity\Company $company
     *
     * @return Person
     */
    public function setCompany(\ShopBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \ShopBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
