<?php

namespace SmartCodeBundle\Action;

use SmartCodeBundle\Entity\SmartCodeInterface;
use SmartCodeBundle\Entity\SubjectInterface;

interface SmartCodeActionInterface
{
    /**
     * Registers the smartCode to its subject.
     *
     * @param SubjectInterface   $subject
     * @param SmartCodeInterface $smartCode
     *
     * @return mixed
     */
    public function register(SubjectInterface $subject, SmartCodeInterface $smartCode);

    /**
     * Unregisters the smartCode from its subject
     *
     * @param SubjectInterface   $subject
     * @param SmartCodeInterface $smartCode
     *
     * @return mixed
     */
    public function unregister(SubjectInterface $subject, SmartCodeInterface $smartCode);
}
