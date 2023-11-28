<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        ['Title' => 'Walking Dead', 'Synopsis' => 'Des zombies envahissent la terre', 'Category' => 'category_Action'],
        ['Title' => 'Okja', 'Synopsis' => 'fille qui s\'occupe d\'un animal', 'Category' => 'category_Aventure'],
        ['Title' => 'Chat Potté 2', 'Synopsis' => 'Des jolies chats avec des bottes et un loup trop stylé', 'Category' => 'category_Animation'],
        ['Title' => 'Le monde de Narnia: chapitre 1 - le lion, la sorcière blanche et l\'armoire magique', 'Synopsis' => 'The best film ever', 'Category' => 'category_Fantastique'],
        ['Title' => 'Midsommar', 'Synopsis' => 'Une secte et des gens en blanc', 'Category' => 'category_Horreur']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $programList) {
            $program = new Program();
            $program->setTitle($programList['Title']);
            $program->setSynopsis($programList['Synopsis'])
                    ->setCategory($this->getReference($programList['Category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }

}
