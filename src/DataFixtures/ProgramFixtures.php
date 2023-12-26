<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        ['Title' => 'WalkingDead', 'Synopsis' => 'Des zombies envahissent la terre', 'Country' => 'Américain', 'Year' => '2010', 'Category' => 'category_Action', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'Okja', 'Synopsis' => 'fille qui s\'occupe d\'un animal', 'Country' => 'Coréen-Américain', 'Year' => '2017', 'Category' => 'category_Aventure', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'Chat Potté 2', 'Synopsis' => 'Des jolies chats avec des bottes et un loup trop stylé', 'Country' => 'Américain', 'Year' => '2022', 'Category' => 'category_Animation', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'Le monde de Narnia: chapitre 1 - le lion, la sorcière blanche et l\'armoire magique', 'Synopsis' => 'The best film ever', 'Country' => 'Américain', 'Year' => '2005', 'Category' => 'category_Fantastique', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'Midsommar', 'Synopsis' => 'Une secte et des gens en blanc', 'Country' => 'Américain', 'Year' => '2019', 'Category' => 'category_Horreur', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'Arcane', 'Synopsis' => 'Raconte l\'intensification des tensions entre deux villes suite à l\'apparition de nouvelles inventions qui menacent de provoquer une véritable révolution.', 'Country' => 'Américain', 'Year' => '2021', 'Category' => 'category_Animation', 'Owner' => 'user_tatamo@gmail.com'],
        ['Title' => 'SquidGame', 'Synopsis' => 'Tentés par un prix alléchant en cas de victoire, des centaines de joueurs désargentés acceptent de s\'affronter lors de jeux pour enfants aux enjeux mortels.', 'Country' => 'Coréen', 'Year' => '2021', 'Category' => 'category_Action', 'Owner' => 'user_tatamo@gmail.com']
    ];

    public function __construct( private SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $programList) {
            $program = new Program();

            $title = $programList['Title'];
            $program->setTitle($title);
            $slug = $this->slugger->slug($title);
            $program->setSlug($slug);
            
            $program->setSynopsis($programList['Synopsis']);
            $program->setCountry($programList['Country']);
            $program->setYear($programList['Year'])
                    ->setCategory($this->getReference($programList['Category']))
                    ->setOwner($this->getReference($programList['Owner']));
            $manager->persist($program);
            $this->addReference('program_' . $programList['Title'], $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
          UserFixtures::class,
        ];
    }

}
