<?php

namespace Intracto\SmartCodeBundle\Generator;

use Intracto\SmartCodeBundle\Entity\PayloadInterface;

/**
 * Smart code generator interface.
 */
interface SmartCodeGeneratorInterface
{
    /**
     * Generate smart codes for the payload based on the instruction.
     *
     * @param PayloadInterface $payload
     * @param SmartCodeOptions $options
     */
    public function generate(PayloadInterface $payload, SmartCodeOptions $options);

    /**
     * Generate unique code.
     *
     * @return string
     */
    public function generateUniqueCode();
}
