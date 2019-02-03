<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Header
 *
 * @ORM\Table(name="header", uniqueConstraints={@ORM\UniqueConstraint(name="header_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="header_booking_id_fk", columns={"booking_id"})})
 * @ORM\Entity
 */
class Header
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
     * @ORM\Column(name="ident_tax_code", type="string", length=255, nullable=true)
     */
    private $identTaxCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ident_type_declar", type="string", length=255, nullable=true)
     */
    private $identTypeDeclar = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ident_type_code", type="string", length=255, nullable=true)
     */
    private $identTypeCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="traderstax_export", type="string", length=255, nullable=true)
     */
    private $traderstaxExport = '';

    /**
     * @var string
     *
     * @ORM\Column(name="traderstype_cosig_code", type="string", length=255, nullable=true)
     */
    private $traderstypeCosigCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="gi_tax_country", type="string", length=255, nullable=true)
     */
    private $giTaxCountry = '';

    /**
     * @var string
     *
     * @ORM\Column(name="gi_type_export", type="string", length=255, nullable=true)
     */
    private $giTypeExport = '';

    /**
     * @var string
     *
     * @ORM\Column(name="gi_type_export_cname", type="string", length=255, nullable=true)
     */
    private $giTypeExportCname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="gi_type_destination_code", type="string", length=255, nullable=true)
     */
    private $giTypeDestinationCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_transport_identity", type="string", length=255, nullable=true)
     */
    private $transportTransportIdentity = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_transport_nation", type="string", length=255, nullable=true)
     */
    private $transportTransportNation = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_transport_mode", type="string", length=255, nullable=true)
     */
    private $transportTransportMode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_inland_transport_mode", type="string", length=255, nullable=true)
     */
    private $transportInlandTransportMode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_delivery_term_code", type="string", length=255, nullable=true)
     */
    private $transportDeliveryTermCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_delivery_term_place", type="string", length=255, nullable=true)
     */
    private $transportDeliveryTermPlace = '';

    /**
     * @var string
     *
     * @ORM\Column(name="transport_border_office_code", type="string", length=255, nullable=true)
     */
    private $transportBorderOfficeCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="valuation_gs_invoice_currency_code", type="string", length=255, nullable=true)
     */
    private $valuationGsInvoiceCurrencyCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="valuation_gs_invoice_currency_rate", type="string", length=255, nullable=true)
     */
    private $valuationGsInvoiceCurrencyRate = '';

    /**
     * @var string
     *
     * @ORM\Column(name="valuation_gs_invoice_total_invoice", type="string", length=255, nullable=true)
     */
    private $valuationGsInvoiceTotalInvoice = '';

    /**
     * @var string
     *
     * @ORM\Column(name="valuation_gs_invoice_total_weight", type="string", length=255, nullable=true)
     */
    private $valuationGsInvoiceTotalWeight = '';

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
     * @ORM\Column(name="serial_cdate", type="datetime")
     */
    private $serialCDate;

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
     * Set identTaxCode
     *
     * @param string $identTaxCode
     *
     * @return Header
     */
    public function setIdentTaxCode($identTaxCode)
    {
        $this->identTaxCode = $identTaxCode;

        return $this;
    }

    /**
     * Get identTaxCode
     *
     * @return string
     */
    public function getIdentTaxCode()
    {
        return $this->identTaxCode;
    }

    /**
     * Set identTypeDeclar
     *
     * @param string $identTypeDeclar
     *
     * @return Header
     */
    public function setIdentTypeDeclar($identTypeDeclar)
    {
        $this->identTypeDeclar = $identTypeDeclar;

        return $this;
    }

    /**
     * Get identTypeDeclar
     *
     * @return string
     */
    public function getIdentTypeDeclar()
    {
        return $this->identTypeDeclar;
    }

    /**
     * Set identTypeCode
     *
     * @param string $identTypeCode
     *
     * @return Header
     */
    public function setIdentTypeCode($identTypeCode)
    {
        $this->identTypeCode = $identTypeCode;

        return $this;
    }

    /**
     * Get identTypeCode
     *
     * @return string
     */
    public function getIdentTypeCode()
    {
        return $this->identTypeCode;
    }

    /**
     * Set traderstaxExport
     *
     * @param string $traderstaxExport
     *
     * @return Header
     */
    public function setTraderstaxExport($traderstaxExport)
    {
        $this->traderstaxExport = $traderstaxExport;

        return $this;
    }

    /**
     * Get traderstaxExport
     *
     * @return string
     */
    public function getTraderstaxExport()
    {
        return $this->traderstaxExport;
    }

    /**
     * Set traderstypeCosigCode
     *
     * @param string $traderstypeCosigCode
     *
     * @return Header
     */
    public function setTraderstypeCosigCode($traderstypeCosigCode)
    {
        $this->traderstypeCosigCode = $traderstypeCosigCode;

        return $this;
    }

    /**
     * Get traderstypeCosigCode
     *
     * @return string
     */
    public function getTraderstypeCosigCode()
    {
        return $this->traderstypeCosigCode;
    }

    /**
     * Set giTaxCountry
     *
     * @param string $giTaxCountry
     *
     * @return Header
     */
    public function setGiTaxCountry($giTaxCountry)
    {
        $this->giTaxCountry = $giTaxCountry;

        return $this;
    }

    /**
     * Get giTaxCountry
     *
     * @return string
     */
    public function getGiTaxCountry()
    {
        return $this->giTaxCountry;
    }

    /**
     * Set giTypeExport
     *
     * @param string $giTypeExport
     *
     * @return Header
     */
    public function setGiTypeExport($giTypeExport)
    {
        $this->giTypeExport = $giTypeExport;

        return $this;
    }

    /**
     * Get giTypeExport
     *
     * @return string
     */
    public function getGiTypeExport()
    {
        return $this->giTypeExport;
    }

    /**
     * Set giTypeExportCname
     *
     * @param string $giTypeExportCname
     *
     * @return Header
     */
    public function setGiTypeExportCname($giTypeExportCname)
    {
        $this->giTypeExportCname = $giTypeExportCname;

        return $this;
    }

    /**
     * Get giTypeExportCname
     *
     * @return string
     */
    public function getGiTypeExportCname()
    {
        return $this->giTypeExportCname;
    }

    /**
     * Set giTypeDestinationCode
     *
     * @param string $giTypeDestinationCode
     *
     * @return Header
     */
    public function setGiTypeDestinationCode($giTypeDestinationCode)
    {
        $this->giTypeDestinationCode = $giTypeDestinationCode;

        return $this;
    }

    /**
     * Get giTypeDestinationCode
     *
     * @return string
     */
    public function getGiTypeDestinationCode()
    {
        return $this->giTypeDestinationCode;
    }

    /**
     * Set transportTransportIdentity
     *
     * @param string $transportTransportIdentity
     *
     * @return Header
     */
    public function setTransportTransportIdentity($transportTransportIdentity)
    {
        $this->transportTransportIdentity = $transportTransportIdentity;

        return $this;
    }

    /**
     * Get transportTransportIdentity
     *
     * @return string
     */
    public function getTransportTransportIdentity()
    {
        return $this->transportTransportIdentity;
    }

    /**
     * Set transportTransportNation
     *
     * @param string $transportTransportNation
     *
     * @return Header
     */
    public function setTransportTransportNation($transportTransportNation)
    {
        $this->transportTransportNation = $transportTransportNation;

        return $this;
    }

    /**
     * Get transportTransportNation
     *
     * @return string
     */
    public function getTransportTransportNation()
    {
        return $this->transportTransportNation;
    }

    /**
     * Set transportTransportMode
     *
     * @param string $transportTransportMode
     *
     * @return Header
     */
    public function setTransportTransportMode($transportTransportMode)
    {
        $this->transportTransportMode = $transportTransportMode;

        return $this;
    }

    /**
     * Get transportTransportMode
     *
     * @return string
     */
    public function getTransportTransportMode()
    {
        return $this->transportTransportMode;
    }

    /**
     * Set transportInlandTransportMode
     *
     * @param string $transportInlandTransportMode
     *
     * @return Header
     */
    public function setTransportInlandTransportMode($transportInlandTransportMode)
    {
        $this->transportInlandTransportMode = $transportInlandTransportMode;

        return $this;
    }

    /**
     * Get transportInlandTransportMode
     *
     * @return string
     */
    public function getTransportInlandTransportMode()
    {
        return $this->transportInlandTransportMode;
    }

    /**
     * Set transportDeliveryTermCode
     *
     * @param string $transportDeliveryTermCode
     *
     * @return Header
     */
    public function setTransportDeliveryTermCode($transportDeliveryTermCode)
    {
        $this->transportDeliveryTermCode = $transportDeliveryTermCode;

        return $this;
    }

    /**
     * Get transportDeliveryTermCode
     *
     * @return string
     */
    public function getTransportDeliveryTermCode()
    {
        return $this->transportDeliveryTermCode;
    }

    /**
     * Set transportDeliveryTermPlace
     *
     * @param string $transportDeliveryTermPlace
     *
     * @return Header
     */
    public function setTransportDeliveryTermPlace($transportDeliveryTermPlace)
    {
        $this->transportDeliveryTermPlace = $transportDeliveryTermPlace;

        return $this;
    }

    /**
     * Get transportDeliveryTermPlace
     *
     * @return string
     */
    public function getTransportDeliveryTermPlace()
    {
        return $this->transportDeliveryTermPlace;
    }

    /**
     * Set transportBorderOfficeCode
     *
     * @param string $transportBorderOfficeCode
     *
     * @return Header
     */
    public function setTransportBorderOfficeCode($transportBorderOfficeCode)
    {
        $this->transportBorderOfficeCode = $transportBorderOfficeCode;

        return $this;
    }

    /**
     * Get transportBorderOfficeCode
     *
     * @return string
     */
    public function getTransportBorderOfficeCode()
    {
        return $this->transportBorderOfficeCode;
    }

    /**
     * Set valuationGsInvoiceCurrencyCode
     *
     * @param string $valuationGsInvoiceCurrencyCode
     *
     * @return Header
     */
    public function setValuationGsInvoiceCurrencyCode($valuationGsInvoiceCurrencyCode)
    {
        $this->valuationGsInvoiceCurrencyCode = $valuationGsInvoiceCurrencyCode;

        return $this;
    }

    /**
     * Get valuationGsInvoiceCurrencyCode
     *
     * @return string
     */
    public function getValuationGsInvoiceCurrencyCode()
    {
        return $this->valuationGsInvoiceCurrencyCode;
    }

    /**
     * Set valuationGsInvoiceCurrencyRate
     *
     * @param string $valuationGsInvoiceCurrencyRate
     *
     * @return Header
     */
    public function setValuationGsInvoiceCurrencyRate($valuationGsInvoiceCurrencyRate)
    {
        $this->valuationGsInvoiceCurrencyRate = $valuationGsInvoiceCurrencyRate;

        return $this;
    }

    /**
     * Get valuationGsInvoiceCurrencyRate
     *
     * @return string
     */
    public function getValuationGsInvoiceCurrencyRate()
    {
        return $this->valuationGsInvoiceCurrencyRate;
    }

    /**
     * Set valuationGsInvoiceTotalInvoice
     *
     * @param string $valuationGsInvoiceTotalInvoice
     *
     * @return Header
     */
    public function setValuationGsInvoiceTotalInvoice($valuationGsInvoiceTotalInvoice)
    {
        $this->valuationGsInvoiceTotalInvoice = $valuationGsInvoiceTotalInvoice;

        return $this;
    }

    /**
     * Get valuationGsInvoiceTotalInvoice
     *
     * @return string
     */
    public function getValuationGsInvoiceTotalInvoice()
    {
        return $this->valuationGsInvoiceTotalInvoice;
    }

    /**
     * Set valuationGsInvoiceTotalWeight
     *
     * @param string $valuationGsInvoiceTotalWeight
     *
     * @return Header
     */
    public function setValuationGsInvoiceTotalWeight($valuationGsInvoiceTotalWeight)
    {
        $this->valuationGsInvoiceTotalWeight = $valuationGsInvoiceTotalWeight;

        return $this;
    }

    /**
     * Get valuationGsInvoiceTotalWeight
     *
     * @return string
     */
    public function getValuationGsInvoiceTotalWeight()
    {
        return $this->valuationGsInvoiceTotalWeight;
    }

    /**
     * Set booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Header
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

    /**
     * Set serialCDate
     *
     * @param \DateTime $serialCDate
     *
     * @return Header
     */
    public function setSerialCDate($serialCDate)
    {
        $this->serialCDate = $serialCDate;

        return $this;
    }

    /**
     * Get serialCDate
     *
     * @return \DateTime
     */
    public function getSerialCDate()
    {
        return $this->serialCDate;
    }
}
