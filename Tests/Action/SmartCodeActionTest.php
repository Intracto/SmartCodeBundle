<?php

namespace Intracto\SmartCodeBundle\Tests\Generator;

use Intracto\SmartCodeBundle\Action\SmartCodeAction;
use Intracto\SmartCodeBundle\Action\SmartCodeActionInterface;
use Intracto\SmartCodeBundle\Entity\PayloadInterface;
use Intracto\SmartCodeBundle\Entity\SubjectInterface;
use Intracto\SmartCodeBundle\Generator\SmartCodeGenerator;
use Intracto\SmartCodeBundle\Generator\SmartCodeOptions;
use Intracto\SmartCodeBundle\Tests\BaseTest;

class SmartCodeActionTest extends BaseTest
{
    private $action;
    private $generator;
    private $subject;
    private $code;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new SmartCodeAction($this->entityManager);
        $this->generator = new SmartCodeGenerator($this->entityManager);
        $this->subject = $this->createMock(SubjectInterface::class);

        $payload = $this->createMock(PayloadInterface::class);
        $options = new SmartCodeOptions();
        $options->setAmount(1);
        $codes = $this->generator->generate($payload, $options);
        $this->code = $codes[0];
    }

    public function testGenerator()
    {
        $this->assertInstanceOf(SmartCodeActionInterface::class, $this->action);
    }

    public function testRegister()
    {
        $this->assertTrue($this->code->isValid());

        $this->action->register($this->subject, $this->code);

        $this->assertFalse($this->code->isValid());
    }

    public function testUnregister()
    {
        $this->action->register($this->subject, $this->code);

        $this->assertFalse($this->code->isValid());

        $this->action->unregister($this->subject, $this->code);

        $this->assertTrue($this->code->isValid());
    }
}
