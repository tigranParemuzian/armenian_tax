<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IdramInfo
 *
 * @ORM\Table(name="idram_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IdramInfoRepository")
 */
class IdramInfo
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
     * @var int
     *
     * @ORM\Column(name="const", type="integer")
     */
    private $const;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_cost", type="integer")
     */
    private $parentCost;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="datetime")
     */
    private $dueDate;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\IdramGroups", inversedBy="info", cascade={"persist"})
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $groups;


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
     * Set const
     *
     * @param integer $const
     *
     * @return IdramInfo
     */
    public function setConst($const)
    {
        $this->const = $const;

        return $this;
    }

    /**
     * Get const
     *
     * @return int
     */
    public function getConst()
    {
        return $this->const;
    }

    /**
     * Set parentCost
     *
     * @param integer $parentCost
     *
     * @return IdramInfo
     */
    public function setParentCost($parentCost)
    {
        $this->parentCost = $parentCost;

        return $this;
    }

    /**
     * Get parentCost
     *
     * @return int
     */
    public function getParentCost()
    {
        return $this->parentCost;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return IdramInfo
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return IdramInfo
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set groups
     *
     * @param \AppBundle\Entity\IdramGroups $groups
     *
     * @return IdramInfo
     */
    public function setGroups(\AppBundle\Entity\IdramGroups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \AppBundle\Entity\IdramGroups
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
