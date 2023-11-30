<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        ['Title' => 'Days Gone Bye', 'Number' => '1', 'Synopsis'  => 'Deputy Sheriff Rick Grimes awakens from a coma, and searches for his family in a world ravaged by the undead.', 'Season' => 'season_1'],
        ['Title' => 'Guts', 'Number' => '2', 'Synopsis' => 'In Atlanta, Rick is rescued by a group of survivors, but they soon find themselves trapped inside a department store surrounded by walkers.', 'Season' => 'season_1'],
        ['Title' => 'Tell it to the frogs', 'Number' => '3', 'Synopsis' => 'Rick is reunited with Lori and Carl but soon decides - along with some of the other survivors - to return to the rooftop and rescue Merle. Meanwhile, tensions run high between the other survivors at the camp.', 'Season' => 'season_1']
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeList) {
            $episode = new Episode();
            $episode->setTitle($episodeList['Title']);
            $episode->setNumber($episodeList['Number']);
            $episode->setSynopsis($episodeList['Synopsis']);
            $episode->setSeason($this->getReference($episodeList['Season']));
            $manager->persist($episode);
         }
         $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
