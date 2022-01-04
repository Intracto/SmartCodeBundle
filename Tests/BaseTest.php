<?php

namespace Intracto\SmartCodeBundle\Tests;

use Intracto\SmartCodeBundle\Entity\SmartCode;
use Intracto\SmartCodeBundle\Repository\SmartCodeRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

/**
 * Test case class helpful with Entity tests requiring the database interaction.
 * For regular entity tests it's better to extend standard PHPUnit\Framework\TestCase instead.
 */
abstract class BaseTest extends TestCase
{
    protected $entityManager;

    protected function setUp(): void
    {
        $this->entityManager = $this->createLoadedMockedDoctrineRepository(
            SmartCodeRepository::class,
            SmartCode::class,
            'findOneBy',
            null
        );
        parent::setUp();
    }

    protected function createLoadedMockedDoctrineRepository($repository, $repositoryName, $repositoryMethod, $repositoryMethodReturnVal)
    {
        $mockEM = $this->createMock(EntityManager::class);
        $mockSVRepo = $this->createMock($repository);

        $mockEM->expects($this->any())
            ->method('getClassMetadata')
            ->will($this->returnValue((object) array('name' => 'aClass')));
        $mockEM->expects($this->any())
            ->method('persist')
            ->will($this->returnValue(null));
        $mockEM->expects($this->any())
            ->method('flush')
            ->will($this->returnValue(null));

        $mockSVRepo
            ->expects($this->any())
            ->method($repositoryMethod)
            ->will($this->returnValue($repositoryMethodReturnVal));

        $mockEM->expects($this->any())
            ->method('getRepository')
            ->with($repositoryName)
            ->will($this->returnValue($mockSVRepo));

        return $mockEM;
    }
}
