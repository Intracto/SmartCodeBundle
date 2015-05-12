<?php

namespace Intracto\SmartCodeBundle\Tests;

/**
 * Test case class helpful with Entity tests requiring the database interaction.
 * For regular entity tests it's better to extend standard \PHPUnit_Framework_TestCase instead.
 */
abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected $entityManager;

    /**
     * @return null
     */
    public function setUp()
    {
        $this->entityManager = $this->createLoadedMockedDoctrineRepository('AppBundle', 'SmartCodeBundle:SmartCode', 'findOneBy', null);
        parent::setUp();
    }

    protected function createLoadedMockedDoctrineRepository($repository, $repositoryName,$repositoryMethod,$repositoryMethodReturnVal) {
        $mockEM=$this->getMock('\Doctrine\ORM\EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush'), array(), '', false);
        $mockSVRepo=$this->getMock($repository,array($repositoryMethod),array(),'',false);

        $mockEM->expects($this->any())
            ->method('getClassMetadata')
            ->will($this->returnValue((object)array('name' => 'aClass')));
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
