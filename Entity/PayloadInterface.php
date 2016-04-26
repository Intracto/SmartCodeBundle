<?php

namespace Intracto\SmartCodeBundle\Entity;

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
     * @return bool
     */
    public function hasSmartCode(SmartCodeInterface $smartCode);

    /**
     * @return bool
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
