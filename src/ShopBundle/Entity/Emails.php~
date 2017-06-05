<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Emails
 *
 * @ORM\Table(name="emails")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\EmailsRepository")
 */
class Emails
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
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var
     * @ORM\Column(name="is_main", type="boolean")
     */
    private $isMain;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Person", mappedBy="email",  cascade={"all"}, orphanRemoval=true)
     */
    private $person;

    public function __toString()
    {
        return $this->id ? $this->email : 'New Email';
        // TODO: Implement __toString() method.
    }

    public function __construct()
    {
        $this->isMain = true;
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
     * Set email
     *
     * @param string $email
     *
     * @return Emails
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     *
     * @return Emails
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return boolean
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Add person
     *
     * @param \ShopBundle\Entity\Person $person
     *
     * @return Emails
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
