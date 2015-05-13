<?php

namespace Intracto\SmartCodeBundle\Tests\Generator;

use Intracto\SmartCodeBundle\Generator\SmartCodeGenerator;
use Intracto\SmartCodeBundle\Generator\SmartCodeOptions;
use Intracto\SmartCodeBundle\Tests\BaseTest;

class SmartCodeGeneratorTest extends BaseTest
{
    private $generator;

    /**
     */
    public function setUp()
    {
        parent::setUp();
        $this->generator = new SmartCodeGenerator($this->entityManager);
    }

    public function testGenerator()
    {
        $this->assertInstanceOf('Intracto\SmartCodeBundle\Generator\SmartCodeGeneratorInterface', $this->generator);
    }

    public function testGenerateUniqueCode()
    {
        $code = $this->generator->generateUniqueCode();

        $this->assertRegExp('/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}/', $code);
    }

    public function testGenerate()
    {
        $payload = $this->getMock('Intracto\SmartCodeBundle\Entity\PayloadInterface');

        $options = new SmartCodeOptions();
        $options->setAmount(500);

        $codes = $this->generator->generate($payload, $options);

        $this->assertCount(500, $codes);
        $this->assertInstanceOf('Intracto\SmartCodeBundle\Entity\SmartCodeInterface', $codes[0]);
    }
}
