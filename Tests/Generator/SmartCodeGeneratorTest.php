<?php

namespace Intracto\SmartCodeBundle\Tests\Generator;

use Intracto\SmartCodeBundle\Tests\KernelAwareTest;

class SmartCodeGeneratorTest extends KernelAwareTest
{
    public function testGenerateUniqueCode()
    {
        $generator = $this->container->get('smartcode.generator.payload_smartcode');
        $code = $generator->generateUniqueCode();

        $this->assertRegExp('/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}/', $code);
    }
}
