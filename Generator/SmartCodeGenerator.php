<?php

namespace Intracto\SmartCodeBundle\Generator;

use Doctrine\ORM\EntityManagerInterface;
use Intracto\SmartCodeBundle\Entity\SmartCode;
use Intracto\SmartCodeBundle\Entity\PayloadInterface;

/**
 * Default smart code generator.
 */
class SmartCodeGenerator implements SmartCodeGeneratorInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(PayloadInterface $payload, SmartCodeOptions $options)
    {
        $codes = array();
        $now = new \DateTime();

        for ($i = 0, $amount = $options->getAmount(); $i < $amount; $i++) {
            $smartCode = new SmartCode($payload);
            $smartCode->setCreatedAt($now);
            $smartCode->setCode($this->generateUniqueCode());
            $smartCode->setUsageLimit($options->getUsageLimit());
            $smartCode->setExpiresAt($options->getExpiresAt());
            $smartCode->setStartsAt($options->getStartsAt());

            $codes[] = $smartCode;
            $this->manager->persist($smartCode);
        }

        $this->manager->flush();

        return $codes;
    }

    /**
     * {@inheritdoc}
     */
    public function generateUniqueCode()
    {
        $code = null;

        do {
            $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ1234567890';
            $charactersLength = strlen($characters);
            $string = '';
            for ($i = 0; $i < 20; $i++) {
                $string .= $characters[rand(0, $charactersLength - 1)];
            }
            $chunks = str_split($string, 5);
            $code = implode("-", $chunks);
        } while ($this->isUsedCode($code));

        return $code;
    }

    /**
     * @param string $code
     *
     * @return Boolean
     */
    protected function isUsedCode($code)
    {
        return null !== $this->manager->getRepository('SmartCodeBundle:SmartCode')->findOneBy(array('code' => $code));
    }
}
