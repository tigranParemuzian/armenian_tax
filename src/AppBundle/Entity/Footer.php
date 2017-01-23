<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Footer
 *
 * @ORM\Table(name="footer", uniqueConstraints={@ORM\UniqueConstraint(name="footer_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="footer_booking_id_fk", columns={"booking_id"})})
 * @ORM\Entity
 */
class Footer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_1", type="string", length=255, nullable=true)
     */
    private $feeAmount1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_2", type="string", length=255, nullable=true)
     */
    private $feeAmount2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_3", type="string", length=255, nullable=true)
     */
    private $feeAmount3 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_4", type="string", length=255, nullable=true)
     */
    private $feeAmount4 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_5", type="string", length=255, nullable=true)
     */
    private $feeAmount5 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_6", type="string", length=255, nullable=true)
     */
    private $feeAmount6 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fee_amount_7", type="string", length=255, nullable=true)
     */
    private $feeAmount7 = '';

    /**
     * @var \Booking
     *
     * @ORM\OneToOne(targetEntity="Booking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     * })
     */
    private $booking;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set feeAmount1
     *
     * @param string $feeAmount1
     *
     * @return Footer
     */
    public function setFeeAmount1($feeAmount1)
    {
        $this->feeAmount1 = $feeAmount1;

        return $this;
    }

    /**
     * Get feeAmount1
     *
     * @return string
     */
    public function getFeeAmount1()
    {
        return $this->feeAmount1;
    }

    /**
     * Set feeAmount2
     *
     * @param string $feeAmount2
     *
     * @return Footer
     */
    public function setFeeAmount2($feeAmount2)
    {
        $this->feeAmount2 = $feeAmount2;

        return $this;
    }

    /**
     * Get feeAmount2
     *
     * @return string
     */
    public function getFeeAmount2()
    {
        return $this->feeAmount2;
    }

    /**
     * Set feeAmount3
     *
     * @param string $feeAmount3
     *
     * @return Footer
     */
    public function setFeeAmount3($feeAmount3)
    {
        $this->feeAmount3 = $feeAmount3;

        return $this;
    }

    /**
     * Get feeAmount3
     *
     * @return string
     */
    public function getFeeAmount3()
    {
        return $this->feeAmount3;
    }

    /**
     * Set feeAmount4
     *
     * @param string $feeAmount4
     *
     * @return Footer
     */
    public function setFeeAmount4($feeAmount4)
    {
        $this->feeAmount4 = $feeAmount4;

        return $this;
    }

    /**
     * Get feeAmount4
     *
     * @return string
     */
    public function getFeeAmount4()
    {
        return $this->feeAmount4;
    }

    /**
     * Set feeAmount5
     *
     * @param string $feeAmount5
     *
     * @return Footer
     */
    public function setFeeAmount5($feeAmount5)
    {
        $this->feeAmount5 = $feeAmount5;

        return $this;
    }

    /**
     * Get feeAmount5
     *
     * @return string
     */
    public function getFeeAmount5()
    {
        return $this->feeAmount5;
    }

    /**
     * Set feeAmount6
     *
     * @param string $feeAmount6
     *
     * @return Footer
     */
    public function setFeeAmount6($feeAmount6)
    {
        $this->feeAmount6 = $feeAmount6;

        return $this;
    }

    /**
     * Get feeAmount6
     *
     * @return string
     */
    public function getFeeAmount6()
    {
        return $this->feeAmount6;
    }

    /**
     * Set feeAmount7
     *
     * @param string $feeAmount7
     *
     * @return Footer
     */
    public function setFeeAmount7($feeAmount7)
    {
        $this->feeAmount7 = $feeAmount7;

        return $this;
    }

    /**
     * Get feeAmount7
     *
     * @return string
     */
    public function getFeeAmount7()
    {
        return $this->feeAmount7;
    }

    /**
     * Set booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Footer
     */
    public function setBooking(\AppBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \AppBundle\Entity\Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }
}
