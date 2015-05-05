<?php

namespace Intracto\SmartCodeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Intracto\SmartCodeBundle\Repository\SmartCodeRepository")
 * @ORM\Table(name="smartcode")
 */
class SmartCode implements SmartCodeInterface
{
    /**
     * Id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    protected $id;

    /**
     * Smart code
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @var string
     */
    protected $code;

    /**
     * Usage limit
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    protected $usageLimit;

    /**
     * Number of times used
     *
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $used = 0;

    /**
     * Associated payload
     *
     * @ORM\ManyToOne(targetEntity="PayloadInterface", inversedBy="smartCodes")
     * @ORM\JoinColumn(name="payload_id", referencedColumnName="id")
     *
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * Expiration date
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * Start date
     *
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $startsAt;

    /**
     * Creation time.
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Intracto\SmartCodeBundle\Entity\SubjectInterface", mappedBy="smartCodes", fetch="EXTRA_LAZY")
     **/
    private $subjects;

    public function __construct(PayloadInterface $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsageLimit()
    {
        return $this->usageLimit;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsageLimit($usageLimit)
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * {@inheritdoc}
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function incrementUsed()
    {
        $this->used++;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function setPayload(PayloadInterface $payload = null)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartsAt(\DateTime $startsAt = null)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param mixed $subjects
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        if (null !== $this->usageLimit && $this->used >= $this->usageLimit) {
            return false;
        }
        if (null !== $this->expiresAt && $this->expiresAt < new \DateTime()) {
            return false;
        }
        if (null !== $this->startsAt && $this->startsAt > new \DateTime()) {
            return false;
        }

        return true;
    }
}
