<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Rate
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="rate")
 * @UniqueEntity("currency")
 */
class Rate
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=3)
     * @Assert\NotBlank
     * @Assert\Length(3)
     * @Assert\Regex(pattern="/[A-Z]+/", message="Value must be in uppercase")
     */
    private $currency;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=7, scale=2)
     * @Assert\Type(type="numeric")
     * @Assert\NotBlank
     * @Assert\GreaterThanOrEqual(0)
     */
    private $rate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"rate"})
     */
    private $changedAt;

    /**
     * Rate constructor.
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->changedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getRate(): ?float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getChangedAt(): ?\DateTime
    {
        return $this->changedAt;
    }
}
