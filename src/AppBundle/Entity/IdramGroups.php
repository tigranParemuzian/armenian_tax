<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IdramGroups
 *
 * @ORM\Table(name="idram_groups")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IdramGroupsRepository")
 */
class IdramGroups
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
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IdramInfo", mappedBy="groups", orphanRemoval=true)
     */
    private $info;

    public function __toString()
    {
        return $this->id ? $this->getName() : 'New Group';
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
     * @return IdramGroups
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
     * Set code
     *
     * @param integer $code
     *
     * @return IdramGroups
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->info = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add info
     *
     * @param \AppBundle\Entity\IdramInfo $info
     *
     * @return IdramGroups
     */
    public function addInfo(\AppBundle\Entity\IdramInfo $info)
    {
        $this->info[] = $info;

        return $this;
    }

    /**
     * Remove info
     *
     * @param \AppBundle\Entity\IdramInfo $info
     */
    public function removeInfo(\AppBundle\Entity\IdramInfo $info)
    {
        $this->info->removeElement($info);
    }

    /**
     * Get info
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfo()
    {
        return $this->info;
    }
}
