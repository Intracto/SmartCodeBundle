<?php

namespace Intracto\SmartCodeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Intracto\SmartCodeBundle\Entity\PayloadInterface;

class SmartCodeRepository extends EntityRepository
{
    public function findAllBatchesForPayload(PayloadInterface $payload)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sc.batch, sc.createdAt, sc.usageLimit, sc.startsAt, sc.expiresAt, count(sc.id) as total
                 FROM SmartCodeBundle:SmartCode sc
                 WHERE sc.payload = :payload
                 GROUP BY sc.batch
                 ORDER BY sc.id ASC'
            )
            ->setParameter('payload', $payload)
            ->getResult();
    }

    public function findAllByBatch($batch, PayloadInterface $payload)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT sc
                 FROM SmartCodeBundle:SmartCode sc
                 WHERE sc.batch = :batch
                 AND sc.payload = :payload
                 ORDER BY sc.id ASC'
            )
            ->setParameter('payload', $payload)
            ->setParameter('batch', $batch)
            ->getResult();
    }
}
