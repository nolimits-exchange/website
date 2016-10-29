<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\CoasterStyles;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle;

class LoadNolimitsCoasterStyleData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $styles = new CoasterStyles();

        $allStyles = [
            '1' => $styles->version1(),
            '2' => $styles->version2(),
        ];

        $i = 1;

        foreach ($allStyles as $version => $styles) {

            foreach ($styles as $style) {

                $entity = new NolimitsCoasterStyle();
                $entity->setName($style['name']);
                $entity->setShort($style['name']);
                $entity->setNolimitsId($style['nolimits_id']);
                $entity->setVersion($version);

                $manager->persist($entity);

                $this->setReference('style-' . $i, $entity);

                $i++;
            }
        }

        $manager->flush();
        $manager->clear();
    }
    
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder(): int
    {
        return 0;
    }
}
