<?php

namespace Intracto\SmartCodeBundle\Generator;

class SmartCodeOptions
{
    protected $amount;
    protected $usageLimit;
    protected $expiresAt;
    protected $startsAt;

    public function __construct()
    {
        $this->amount = 1;
        $this->usageLimit = 1;
        $this->startsAt = new \DateTime();
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
}
