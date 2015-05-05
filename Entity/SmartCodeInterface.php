<?php

namespace Intracto\SmartCodeBundle\Entity;

/**
 * Smart code interface.
 */
interface SmartCodeInterface
{
    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code);

    /**
     * Get usage limit
     *
     * @return integer
     */
    public function getUsageLimit();

    /**
     * Set usage limit
     *
     * @param integer $usageLimit
     */
    public function setUsageLimit($usageLimit);

    /**
     * Get number of times this coupon has been used
     *
     * @return integer
     */
    public function getUsed();

    /**
     * Set number of times this coupon has been used
     *
     * @param integer $used
     */
    public function setUsed($used);

    /**
     * Increment usage
     */
    public function incrementUsed();

    /**
     * Get associated payload
     *
     * @return PayloadInterface
     */
    public function getPayload();

    /**
     * Set the associated payload
     *
     * @param PayloadInterface $payload
     */
    public function setPayload(PayloadInterface $payload = null);

    /**
     * Get the expiration date
     *
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * Set the expiration date
     *
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt = null);

    /**
     * Get the start date
     *
     * @return \DateTime
     */
    public function getStartsAt();

    /**
     * Set the start date
     *
     * @param \DateTime $startsAt
     */
    public function setStartsAt(\DateTime $startsAt = null);

    /**
     * Is this coupon valid?
     *
     * @return Boolean
     */
    public function isValid();
}
