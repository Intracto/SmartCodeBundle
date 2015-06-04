<?php

namespace Intracto\SmartCodeBundle\Tests\Generator;

use Intracto\SmartCodeBundle\Generator\SmartCodeOptions;
use Intracto\SmartCodeBundle\Tests\BaseTest;
use Symfony\Component\Validator\Validation;

class SmartCodeOptionsTest extends BaseTest
{
    private $validator;
    
    public function setUp()
    {

        $this->validator = Validation::createValidatorBuilder()
                                    ->enableAnnotationMapping()
                                    ->getValidator();
    }

    public function testSmartCodeOptionsCorrect()
    {
        $options = new SmartCodeOptions();
        $options->setAmount(500);
        $options->setBatch("Test batch");

        $violations = $this->validator->validate($options);

        $this->assertCount(0, $violations);
    }

    public function testSmartCodeOptionsFailed()
    {
        $options = new SmartCodeOptions();
        $options->setAmount(-1);
        $options->setBatch("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $options->setUsageLimit(0);
        $options->setExpiresAt("Test failure");

        $violations = $this->validator->validate($options);

        $this->assertCount(4, $violations);
    }
}
