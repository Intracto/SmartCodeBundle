<?php

namespace Intracto\SmartCodeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Intracto\SmartCodeBundle\Entity\PayloadInterface;

class SmartCodeRepository extends EntityRepository
{
    public function findAllCreationDatesForPayload(PayloadInterface $payload)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sc.createdAt, sc.usageLimit, sc.startsAt, sc.expiresAt, count(sc.id) as total
                 FROM SmartCodeBundle:SmartCode sc
                 WHERE sc.payload = :payload
                 GROUP BY sc.createdAt
                 ORDER BY sc.id ASC'
            )
            ->setParameter('payload', $payload)
            ->getResult();
    }

    public function findAllByCreationDate(\DateTime $creationDate, PayloadInterface $payload)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sc
                 FROM SmartCodeBundle:SmartCode sc
                 WHERE sc.createdAt = :creationDate
                 AND sc.payload = :payload
                 ORDER BY sc.id ASC'
            )
            ->setParameter('payload', $payload)
            ->setParameter('creationDate', $creationDate)
            ->getResult();
    }
}
