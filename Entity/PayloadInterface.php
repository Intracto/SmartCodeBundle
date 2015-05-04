<?php

namespace SmartCodeBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface PayloadInterface
{
    /**
     * @return Collection|SmartCodeInterface[]
     */
    public function getSmartCodes();

    /**
     * @param SmartCodeInterface $smartCode
     *
     * @return Boolean
     */
    public function hasSmartCode(SmartCodeInterface $smartCode);

    /**
     * @return Boolean
     */
    public function hasSmartCodes();

    /**
     * @param SmartCodeInterface $smartCode
     *
     * @return self
     */
    public function addSmartCode(SmartCodeInterface $smartCode);

    /**
     * @param SmartCodeInterface $smartCode
     *
     * @return self
     */
    public function removeSmartCode(SmartCodeInterface $smartCode);
}
