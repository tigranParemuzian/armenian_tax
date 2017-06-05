<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Reference
 *
 * @ORM\Table(name="reference")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReferenceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reference
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
     * @ORM\Column(name="code", type="string", length=255)
     * @Assert\NotNull(message="code can`t be null")
     */
    private $code;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ReferenceItem", mappedBy="reference",  cascade={"all"}, orphanRemoval=true)
     */
    private $referenceItem;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    public function __toString()
    {
        return $this->id ? $this->code : 'New Reference';
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
     * Set code
     *
     * @param string $code
     *
     * @return Reference
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
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
        $this->referenceItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Reference
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
     * @return Reference
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
     * Add referenceItem
     *
     * @param \AppBundle\Entity\ReferenceItem $referenceItem
     *
     * @return Reference
     */
    public function addReferenceItem(\AppBundle\Entity\ReferenceItem $referenceItem)
    {
        $this->referenceItem[] = $referenceItem;

        return $this;
    }

    /**
     * Remove referenceItem
     *
     * @param \AppBundle\Entity\ReferenceItem $referenceItem
     */
    public function removeReferenceItem(\AppBundle\Entity\ReferenceItem $referenceItem)
    {
        $this->referenceItem->removeElement($referenceItem);
    }

    /**
     * Get referenceItem
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferenceItem()
    {
        return $this->referenceItem;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Reference
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
