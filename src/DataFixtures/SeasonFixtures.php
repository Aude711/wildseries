<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASON = [
        ['Number' => '1', 'Year' => '2010', 'Description' => 'zooombies', 'Program' => 'program_WalkingDead'],
        ['Number' => '2', 'Year' => '2011', 'Description' => 'ooooh', 'Program' => 'program_WalkingDead'],
        ['Number' => '3', 'Year' => '2012', 'Description' => 'gzombie oooh', 'Program' => 'program_WalkingDead']
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASON as $seasonList) {
            $season = new Season();
            $season->setNumber($seasonList['Number']);
            $season->setYear($seasonList['Year']);
            $season->setDescription($seasonList['Description'])
                    ->setProgram($this->getReference($seasonList['Program']));
            $manager->persist($season);
            $this->addReference('season_' . $seasonList['Number'], $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}