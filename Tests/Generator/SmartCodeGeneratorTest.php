<?php

namespace Intracto\SmartCodeBundle\Tests\Generator;

use Intracto\SmartCodeBundle\Entity\PayloadInterface;
use Intracto\SmartCodeBundle\Entity\SmartCodeInterface;
use Intracto\SmartCodeBundle\Generator\SmartCodeGenerator;
use Intracto\SmartCodeBundle\Generator\SmartCodeGeneratorInterface;
use Intracto\SmartCodeBundle\Generator\SmartCodeOptions;
use Intracto\SmartCodeBundle\Tests\BaseTest;

class SmartCodeGeneratorTest extends BaseTest
{
    private $generator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->generator = new SmartCodeGenerator($this->entityManager);
    }

    public function testGenerator()
    {
        $this->assertInstanceOf(SmartCodeGeneratorInterface::class, $this->generator);
    }

    public function testGenerateUniqueCode()
    {
        $code = $this->generator->generateUniqueCode();

        $this->assertRegExp('/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}/', $code);
    }

    public function testGenerate()
    {
        $payload = $this->createMock(PayloadInterface::class);

        $options = new SmartCodeOptions();
        $options->setAmount(500);

        $codes = $this->generator->generate($payload, $options);

        $this->assertCount(500, $codes);
        $this->assertInstanceOf(SmartCodeInterface::class, $codes[0]);
    }
}
