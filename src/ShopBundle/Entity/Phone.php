<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Phone
 *
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\PhoneRepository")
 */
class Phone
{
    const IS_PHONE = 0;
    const IS_MOBILE = 1;

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
     * @ORM\Column(name="number", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Person", mappedBy="phone",  cascade={"all"}, orphanRemoval=true)
     */
    private $person;


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
     * @return Phone
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
     * Set type
     *
     * @param integer $type
     *
     * @return Phone
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
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add person
     *
     * @param \ShopBundle\Entity\Person $person
     *
     * @return Phone
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
