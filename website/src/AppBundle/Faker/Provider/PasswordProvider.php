<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Faker\Provider;

use Faker\Provider\Base;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class PasswordProvider
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Faker\Provider
 */
class PasswordProvider extends Base
{
    /**
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * @param \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface $encoder
     *
     * @return $this
     */
    public function setEncoderFactory(EncoderFactoryInterface $encoder)
    {
        $this->encoderFactory = $encoder;

        return $this;
    }

    /**
     * Generate a password for a user object.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $user
     * @param string                                                     $raw
     * @param string                                                     $salt
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function fileGenerator(Users $user, string $raw, string $salt): string
    {
        $encoder = $this->encoderFactory->getEncoder($user);

        return $encoder->encodePassword($raw, $salt);
    }
}
