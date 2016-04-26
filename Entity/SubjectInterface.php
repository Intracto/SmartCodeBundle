<?php

namespace Intracto\SmartCodeBundle\Entity;

interface SubjectInterface
{
    /**
     * Has SmartCode.
     *
     * @param SmartCodeInterface $smartCode
     *
     * @return bool
     */
    public function hasSmartCode(SmartCodeInterface $smartCode);

    /**
     * Has SmartCode for given payload.
     *
     * @param PayloadInterface $payload
     *
     * @return bool
     */
    public function hasSmartCodeForPayload(PayloadInterface $payload);

    /**
     * Add SmartCode.
     *
     * @param SmartCodeInterface $smartCode
     *
     * @return self
     */
    public function addSmartCode(SmartCodeInterface $smartCode);

    /**
     * Remove SmartCode.
     *
     * @param SmartCodeInterface $smartCode
     *
     * @return self
     */
    public function removeSmartCode(SmartCodeInterface $smartCode);

    /**
     * Get SmartCodes.
     *
     * @return Collection|SmartCodeInterface[]
     */
    public function getSmartCodes();
}
