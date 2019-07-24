SmartCodeBundle [![Build Status](https://travis-ci.org/Intracto/SmartCodeBundle.svg)](https://travis-ci.org/Intracto/SmartCodeBundle) [![Scrutinizer](https://scrutinizer-ci.com/g/Intracto/SmartCodeBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Intracto/SmartCodeBundle/) 
===============

This bundle provides a way to generate software licenses for a given payload. 

It has been inspired by the [Promotion Bundle](https://github.com/Sylius/SyliusPromotionBundle) of Sylius.

How to install?
---------------
Install the bundle via composer
```
composer require intracto/smartcode-bundle
```
Enable the bundle
```
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    // ...

    public function registerBundles()
    {
        $bundles = array(
            // ...,
            new Intracto\SmartCodeBundle\SmartCodeBundle(),
        );

        // ...
    }
}
```

How to run tests?
-----------------

```

    php bin/phpunit

```


How to get started?
-------------------

Smart codes have to be bound to a payload this can be done by implementing the PayloadInterface.

```
    use Intracto\SmartCodeBundle\Entity\PayloadInterface;
    use Intracto\SmartCodeBundle\Entity\SmartCodeInterface;

    class Payload implements PayloadInterface
    {

        ...

        /**
         * @ORM\OneToMany(targetEntity="Intracto\SmartCodeBundle\Entity\SmartCodeInterface", mappedBy="payload")
         *
         * @var SmartCodes[]|ArrayCollection
         */
        protected $smartCodes;

        ...
    }
```

Now you can get started with the generation. To generate Smart codes you can use the SmartCodeGenerator
or create your own by implementing the SmartCodeGeneratorInterface.

This service will allow you to call the function:

```
    public function generate(PayloadInterface $payload, SmartCodeOptions $options)
```

As you can see this has 2 parameters, the first is your payload that you created in step 1 and the 2nd is a model
containing all your options.

```
    class SmartCodeOptions
    {
        protected $amount;
        protected $usageLimit;
        protected $expiresAt;
        protected $startsAt;
        protected $batch;

        ...
    }
```

- **Amount**: The amount of smart codes you wish to generate for the given payload.
- **UsageLimit**: The amount of times a smart code can be used.
- **ExpiresAt**: The expiry date for a smart code.
- **StartsAt**: The date a smart code can start being used.
- **Batch**: A name or description you want to give the current generation.

The last thing you would probably want to do is to be able to use these smart codes you just generated.
This is possible via the SmartCodeAction service, which you can also overwrite by implementing the SmartCodeActionInterface.

This class has 2 required functions:

```
   public function register(SubjectInterface $subject, SmartCodeInterface $smartCode);

   public function unregister(SubjectInterface $subject, SmartCodeInterface $smartCode);
```

To register or unregister a certain smart code you would need a subject that is going to be using this code.
To make such a subject you can implement the SubjectInterface.

```
    use Intracto\SmartCodeBundle\Entity\SmartCodeInterface;
    use Intracto\SmartCodeBundle\Entity\SubjectInterface;

    class User implements SubjectInterface
    {

        ...

        /**
         * @ORM\ManyToMany(targetEntity="Intracto\SmartCodeBundle\Entity\SmartCodeInterface", inversedBy="subjects")
         * @ORM\JoinTable(name="user_smartcode",
         *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
         *      inverseJoinColumns={@ORM\JoinColumn(name="smartcode_id", referencedColumnName="id")}
         *      )
         *
         * @var SmartCode[]|ArrayCollection
         */
        protected $smartCodes;

        ...

    }

```

