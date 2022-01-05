<?php

namespace Intracto\SmartCodeBundle\Generator;

use Symfony\Component\Validator\Constraints as Assert;

class SmartCodeOptions
{
    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    protected $amount;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "The title cannot be longer than {{ limit }} characters"
     * )
     */
    protected $batch;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(value = 0)
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    protected $usageLimit;

    /**
     * @Assert\Type("DateTime")
     */
    protected $expiresAt;

    /**
     * @Assert\Type("DateTime")
     */
    protected $startsAt;

    public function __construct()
    {
        $now = new \DateTime();
        $this->amount = 1;
        $this->usageLimit = 1;
        $this->startsAt = $now;
        $this->batch = $now->format('d-m-Y H:i:s');
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUsageLimit()
    {
        return $this->usageLimit;
    }

    public function setUsageLimit($usageLimit)
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getStartsAt()
    {
        return $this->startsAt;
    }

    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getBatch()
    {
        return $this->batch;
    }

    public function setBatch($batch)
    {
        $this->batch = $batch;
    }
}
