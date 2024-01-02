<?php

namespace App\Twig\Components;

use App\Repository\CategoryRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class Navbar
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
        $this->categoryRepository=$categoryRepository;
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->findBy([], ['name' => 'ASC']);
    }
}